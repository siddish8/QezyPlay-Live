<?php
/*
Plugin Name: Optimized Dropdown Menus
Plugin URI: 
Description: Use this widget to create dropdown menus that are searchable or "spiderable" by search engine bots.
Author: 
Author URI: 
Version: 1.2.2
Text Domain: optimized_dd
Tags: widget-only, widget, seo
License: GPL2
*/
/*  Copyright 2012 Maor Chasen  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class Optimized_Dropdown_Widget extends WP_Widget {

	function Optimized_Dropdown_Widget() {
		parent::__construct( 'optimzed_dd_widget', __( 'Optimized Dropdown Menu', 'optimized_dd' ), array(
			'classname' => 'optimzed_dd',
			'description' => __( 'Create a search engine optimized dropdown menu.', 'optimized_dd' )
		) );
	}
	

	function form( $instance ) {
		$title 	  = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		$html5 	  = isset( $instance['html5'] ) ? $instance['html5'] : '';
		$newindow = isset( $instance['new_window'] ) ? $instance['new_window'] : '';

		// Get menus
		$menus = get_terms( 
			'nav_menu', array( 'hide_empty' => false ) 
		);

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'optimized_dd' ), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'optimized_dd') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:', 'optimized_dd'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
	<?php
			foreach ( $menus as $menu ) {
				printf( '<option value="%d"%s>%s</option>', 
					absint( $menu->term_id ), 
					selected( $nav_menu, $menu->term_id, false ), 
					esc_html( $menu->name ) 
				);
			}
	?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo ($html5 == 'on') ? 'checked="checked"' : ''; ?> id="<?php echo $this->get_field_id( 'html5' ); ?>" name="<?php echo $this->get_field_name( 'html5' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'html5' ); ?>">&nbsp;<?php echo sprintf( _x( 'Use HTML5 %s element?', '<nav>', 'optimized_dd' ), '<code>&lt;nav&gt;</code>' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo ($newindow == 'on') ? 'checked="checked"' : ''; ?> id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">&nbsp;<?php _e( 'Open links in new window?', 'optimized_dd' ); ?></label>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] 		= $new_instance['title'];
		$instance['nav_menu'] 	= (int) $new_instance['nav_menu'];
		$instance['html5'] 		= $new_instance['html5'];
		$instance['new_window'] = $new_instance['new_window'];
		return $instance;
	}

	function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		// links open in a new tab?
		$link_scope_css_class = ( isset( $instance['new_window'] ) && 'on' == $instance['new_window'] ) ? 'odm-new-window' : 'odm-self-window';

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
//echo "<br />";
		$menu_args = array(
			'fallback_cb' => '',
			'menu' => $nav_menu,
			'container' => (($instance['html5'] == 'on') ? 'nav' : 'div'),
			'container_class' => "odm-widget $link_scope_css_class",
			'menu_id' => "odm-{$nav_menu->term_id}-widget"
		);

		// back compat
		do_action('optimized_dd_menu', $menu_args);

		wp_nav_menu( apply_filters( 'optimized_dd_menu_args', $menu_args ) );

		echo $args['after_widget'];
	}
}

/**
 * @since 1.1
 */
class Optimized_Dropdown_Menu {

	function __construct() {
		add_action( 'widgets_init', array( $this, 'load_widget' ) );
		add_action( 'template_redirect', array( $this, 'setup_frontend_js' ) );
		// i18n
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	function load_textdomain() {
		load_plugin_textdomain( 'optimized_dd', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register our widget.
	 * @since 0.1
	 */
	function load_widget() {
		register_widget( 'Optimized_Dropdown_Widget' );
	}

	function setup_frontend_js() {
		/* If widget is present, load the JS too */
		if ( is_active_widget( false, false, 'optimzed_dd_widget', true ) ) {
			wp_enqueue_script( 'jquery' );
			add_action( 'wp_footer', array( $this, 'print_odm_javascript' ) );
		}
	}

	function print_odm_javascript() {
?>
		<script type="text/javascript">
			
			jQuery(document).ready(function($) {
				var $widget = $('.odm-widget');//:selected').text();

				$('ul', $widget).each(function(){
				  var list = $(this);
				  var select = $(document.createElement('select'))
				          .attr('id',$(this).attr('id'))
				          .insertBefore($(this).hide());
				  $('>li a', this).each( function(){
				    option = $( document.createElement('option') )
				      .appendTo(select)
				      .val(this.href)
				      .html( $(this).html() );
				  });
				  list.remove();
				  $(document.createElement('button'))
				    .attr('onclick',
				    	$widget.hasClass('odm-new-window') 
				    		? 'window.open(jQuery(\'#'+$(this).attr('id')+'\').val(), \'_blank\');'
				    		: 'window.location.href=jQuery(\'#'+$(this).attr('id')+'\').val();')
				    .html('Go')
				    .insertAfter(select);
				});
			});
	    </script>
<?php
	}
}
new Optimized_Dropdown_Menu;