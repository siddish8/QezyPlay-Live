<?php
class Wli_Popular_Posts extends WP_Widget {
	
	/**
	 * 
	 * Unique identifier for your widget.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * widget file.
	 *
	 * @since    1.0.1
	 *
	 * @var      string
	 */
	protected $widget_slug = 'wli_popular_posts';

	/**
	 *   Wli_Popular_Posts constructor
	 *
	 *  @since    			1.0.1
	 *
	 *  @return             void
	 *  @var                No arguments passed
	 *  @author             weblineindia
	 *
	 */
	public function __construct()
	{
		parent::__construct(
				$this->get_widget_slug(),
				__( 'Popular Posts by Webline', $this->get_widget_slug() ),
				array(
						'classname'     =>  $this->get_widget_slug().'-class',
						'description'   => __('A Simple plugin to show the posts as per the filter applied.',$this->get_widget_slug()),
				)
		);
		if ( ! class_exists( 'Walker_Category_Checklist_Widget' ) ) {
			require_once( 'walker.php' );
		}
	}

	/**
	 * get_widget_slug() is use to get the widget slug.
	 *
	 * @since     1.0.1
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

	/**
	 *  form() is used to generates the administration form for the widget.
	 *
	 *  @since    			1.0.1
	 *
	 *  @return             void
	 *  @var                $instance
	 *  @author             weblineindia
	 *
	 */

	function form( $instance ) {
		$defaults = array(
				'category' 	 	 => array(),
				'title'	   	 	 => 'Popular Posts',
				'no_posts' 	 	 => '3',
				'days_filter'	 =>	'None',
				'sort_by'		 =>	'Comments',
				'no_comments'	 => 'no',
				'views_count'	 => 'no',
				'post_date'		 =>	'no',
				'featured_image' =>	'no',
				'featured_width' =>	'100',
				'featured_height'=>	'100',
                'content'		 =>	'no',
				'content_length' =>	'25'
		);
		
		$instance		= wp_parse_args( (array) $instance, $defaults );
		
		$title			= esc_attr($instance['title'] );
		$no_posts		= esc_attr($instance['no_posts'] );
		$days_filter	= $instance['days_filter'];
		$sort_by		= $instance['sort_by'];
		$category		= $instance['category'];
		$comments 		= $instance['no_comments'];
		$views_count 	= $instance['views_count'];
		$post_date		= $instance['post_date'];
		$featured_image = $instance['featured_image'];
		$featured_width = $instance['featured_width'];
		$featured_height= $instance['featured_height'];
		$content		= $instance['content'];
		$content_length = esc_attr($instance['content_length']);
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', $this->get_widget_slug()); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('no_posts'); ?>"><?php _e('No. of Posts to Show:', $this->get_widget_slug()); ?></label> 
			<input class="widefat" maxlength="4" id="<?php echo $this->get_field_id('no_posts'); ?>" name="<?php echo $this->get_field_name('no_posts'); ?>" type="text" value="<?php echo $no_posts; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('days_filter'); ?>"><?php _e('Show Post Before (Days):', $this->get_widget_slug()); ?></label> 
			<select id="<?php echo $this->get_field_id('days_filter'); ?>" name="<?php echo $this->get_field_name('days_filter'); ?>" class="widefat">
				<?php $filterby=array( 'None', '7', '15', '30', '45' );?>
				<?php foreach($filterby as $post_type) { ?>
				<option <?php selected( $instance['days_filter'], $post_type ); ?> value="<?php echo $post_type; ?>">
					<?php echo $post_type; ?>
				</option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort By:', $this->get_widget_slug()); ?></label> 
			<select id="<?php echo $this->get_field_id('sort_by'); ?>" name="<?php echo $this->get_field_name('sort_by'); ?>" class="widefat">
				<option <?php selected( $instance['sort_by'], 'Comments'); ?> value="Comments">Comments</option>
				<option <?php selected( $instance['sort_by'], 'Post Views Count'); ?> value="Post Views Count">Post Views Count</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('no_comments'); ?>"><?php _e('Show No. of Comments:', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('no_comments'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['no_comments'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('no_comments'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['no_comments'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('views_count'); ?>"><?php _e('Show Post Views Count:', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('views_count'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['views_count'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('views_count'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['views_count'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('post_date'); ?>"><?php _e('Show Post Date:', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('post_date'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['post_date'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('post_date'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['post_date'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('featured_image'); ?>"><?php _e('Show Featured Image:', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('featured_image'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['featured_image'], true ); ?>>Yes &nbsp;&nbsp;			
			<input type="radio" name="<?php echo $this->get_field_name('featured_image'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['featured_image'], true ); ?>>No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('featured_width'); ?>"><?php _e('Featured Image Width:', $this->get_widget_slug()); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('featured_width'); ?>" name="<?php echo $this->get_field_name('featured_width'); ?>" type="text" value="<?php echo $featured_width; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('featured_height'); ?>"><?php _e('Featured Image Height:', $this->get_widget_slug()); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('featured_height'); ?>" name="<?php echo $this->get_field_name('featured_height'); ?>" type="text" value="<?php echo $featured_height; ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Show Excerpt:', $this->get_widget_slug()); ?></label><br>
			<input type="radio" name="<?php echo $this->get_field_name('content'); ?>" value="yes" class="widefat" <?php echo checked( 'yes', $instance['content'], true ); ?>>Yes &nbsp;&nbsp;
			<input type="radio" name="<?php echo $this->get_field_name('content'); ?>" value="no" class="widefat" <?php echo checked( 'no', $instance['content'], true ); ?> >No
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('content_length'); ?>"><?php _e('Excerpt Length:', $this->get_widget_slug()); ?></label><br>
			<input class="widefat" id="<?php echo $this->get_field_id('content_length'); ?>" name="<?php echo $this->get_field_name('content_length'); ?>" type="text" value="<?php echo $content_length;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select Category:', $this->get_widget_slug()); ?></label>
			<?php
			$walker = new Walker_Category_Checklist_Widget(
					$this->get_field_name('category'), $this->get_field_id('category')
			);
			echo '<ul class="categorychecklist">';
			wp_category_checklist( 0, 0, $instance['category'], FALSE, $walker, FALSE);
			echo '</ul>';
			?>
		</p>
<?php
	}

	/**
	 *  update() is used to replace the new value when the Saved button is clicked.
	 *
	 *  @since    1.0.1
	 *
	 *  @return             $instance
	 *  @var                $new_instance,$old_instance
	 *  @author             weblineindia
	 *
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']			= sanitize_text_field($new_instance['title']);
		$instance['no_posts'] 		= sanitize_text_field($new_instance['no_posts']);
		$instance['days_filter']	= $new_instance['days_filter'];
		$instance['sort_by']		= $new_instance['sort_by'];
		$instance['category']		= isset($new_instance['category'])?$new_instance['category'] :array();
		$instance['no_comments']	= isset($new_instance['no_comments'])?$new_instance['no_comments'] :'no';
		$instance['views_count']	= isset($new_instance['views_count'])?$new_instance['views_count'] :'no';
		$instance['post_date']		= isset($new_instance['post_date'])?$new_instance['post_date'] :'no';
		$instance['featured_image'] = isset($new_instance['featured_image'])?$new_instance['featured_image'] :'no';
		$instance['featured_width']	= sanitize_text_field($new_instance['featured_width']);
		$instance['featured_height']= sanitize_text_field($new_instance['featured_height']);
		$instance['content']		= isset($new_instance['content'])?$new_instance['content'] :'no';
		$instance['content_length']	= sanitize_text_field($new_instance['content_length']);
		return $instance;
	}
	
	/**
	 * widget() is used to show the frontend part .
	 *
	 *  @since    1.0.1
	 *
	 *  @return             void
	 *  @var                $args,$instance
	 *  @author             weblineindia
	 *
	 */
	function widget($args, $instance) {
	
		global $content_length;
		
		extract( $args,EXTR_SKIP);
	
		wp_enqueue_style( 'popularposts-style', PP_URL . '/admin/assets/css/popular-posts-style.css' );
		
		$title		 	= apply_filters( 'widget_title', $instance['title'] );
		$no_posts	 	= $instance['no_posts'];
		$days_filter 	= $instance['days_filter'];
		$sort_by		= $instance['sort_by'];
		$category	 	= $instance['category'];
		$comments 		= $instance['no_comments'];
		$views_count 	= $instance['views_count'];
		$post_date		= $instance['post_date'];
		$featured_image = $instance['featured_image'];
		$featured_width = !empty($instance['featured_width'])?$instance['featured_width']:'100';
		$featured_height= !empty($instance['featured_height'])?$instance['featured_height']:'100';
		$content		= $instance['content'];
		$content_length = !empty($instance['content_length'])?$instance['content_length']:'25';
		
		echo $before_widget;
	
		echo $before_title . $title . $after_title;

		if($sort_by == "Comments")
		{
			$args = array(
					'posts_per_page'=>	$no_posts,
					'orderby'		=>	'comment_count',
					'order'			=>  'DESC',
					'category__in'  =>  $category,
					'date_query'    =>  array(
						array(
								'column' => 'post_date_gmt',
								'after'  => $days_filter.'days ago',
						)
					)
			);
		}
		else
		{
			$args = array(
					'posts_per_page'=>	$no_posts,
					'meta_key'		=>  'wli_pp_post_views_count',
					'orderby'		=>	'meta_value_num',
					'category__in'  =>  $category,
					'date_query'    =>  array(
							array(
									'column' => 'post_date_gmt',
									'after'  => $days_filter.'days ago',
							)
					)
			);
		}
	
		$the_query = new WP_Query( $args );
			echo "<div class='row'>";
		if ( $the_query->have_posts() ) {
			add_filter( 'excerpt_length','wli_popular_posts_excerpt_length');
			add_filter( 'excerpt_more','wli_popular_posts_excerpt_more' );
			echo "<ul>";
			while ( $the_query->have_posts() )
			{
				$the_query->the_post();
				?>
					<li>
						<?php 
						if($featured_image =='yes')
						{
						?>
						<div class="col-md-3"><div class="post_thumb">
		                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php 
									if ( has_post_thumbnail() )
									{
										the_post_thumbnail(array($featured_width,$featured_height));
									}
									?>
								</a>
	                        </div></div>
                        <?php
                        }
						?>
                       <!-- <h3>
	                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
							</a>
                        </h3> -->
						<?php 
						if($content == 'yes')
						{
							the_excerpt();
						}
						?>
        				<?php 
        				if($comments == 'yes' || $post_date == 'yes' || $views_count == 'yes')
        				{        				
        				?>
							<div class="bottom_bar">
		                        <p>
			                        <?php
			                        if($views_count == 'yes')
			                        {
			                        	echo "<span><img src='".PP_URL ."/admin/assets/images/view_icon.png'/> ".wli_popular_posts_get_post_views(get_the_ID())."</span>";
			                        }
									if($comments == 'yes')
									{
										$comments_count = wp_count_comments(get_the_ID());
										echo "<span><a href='".get_comments_link( get_the_ID() )."' title='Comments'><img src='".PP_URL ."/admin/assets/images/comment_icon.png'/> ".$comments_count->approved."</a></span>";
									}
									if($post_date == 'yes')
									{
										echo "<span>".get_the_date()."</span>";
									}
									?>
		                        </p>
	                        </div>
						<?php 
        				}
						?>
					</li>
		 		<?php 
				}
				echo '</ul></div>';
			}
				
			wp_reset_postdata();
				
			echo $after_widget;
		}
}
add_action( 'widgets_init', create_function('', 'return register_widget("Wli_Popular_Posts" );'));


if ( ! function_exists ('wli_popular_posts_excerpt_length' ) ) {
	function wli_popular_posts_excerpt_length( $length ) {
		global $content_length;
		return $content_length;
	}
}

if ( ! function_exists ('wli_popular_posts_excerpt_more' ) ) {
	function wli_popular_posts_excerpt_more( $more ) {
		return '<a href="'.get_the_permalink().'">...</a>';
	}
}

function wli_popular_posts_set_post_views($postID) {
	$count_key = 'wli_pp_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 1;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '1');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wli_popular_posts_track_post_views ($post_id) {
	if ( !is_single() ) return;
	if ( empty ( $post_id) ) {
		global $post;
		$post_id = $post->ID;
	}
	wli_popular_posts_set_post_views($post_id);
}
add_action( 'wp_head', 'wli_popular_posts_track_post_views');

function wli_popular_posts_get_post_views($postID){
	$count_key = 'wli_pp_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}