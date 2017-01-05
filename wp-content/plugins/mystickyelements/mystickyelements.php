<?php     
   /*
    Plugin Name: myStickyElements
    Plugin URI: http://wordpress.transformnews.com/plugins/mystickyelements-simple-sticky-side-elements-for-wordpress-504
    Description: myStickyElements is simple yet very effective plugin. It is perfect to fill out usually unused side space on webpages with some additional messages, videos, social widgets ...
    Version: 1.0
    Author: m.r.d.a
    License: GPLv2 or later
    */
// Block direct acess to the file
defined('ABSPATH') or die("Cannot access pages directly.");

// Add plugin admin settings by Otto
class MyStickyElementsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
		add_action( 'admin_init', array( $this, 'mysticky_elements_default_options' ) );
		add_action( 'admin_enqueue_scripts',  array( $this, 'mw_enqueue_color_picker' ) );
		
    }


    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
		
        add_options_page(
            'Settings Admin', 
            'myStickyElements', 
            'manage_options', 
            'my-sticky-elements-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
	 
    public function create_admin_page()
    
    {
		
		
		
		
        // Set class property
   // $all_options = array (  
	$this->options = get_option( 'mysticky_elements_options');
	$this->options0 = get_option( 'mysticky_elements_options0');
	$this->options1 = get_option( 'mysticky_elements_options1');
	$this->options2 = get_option( 'mysticky_elements_options2');
	$this->options3 = get_option( 'mysticky_elements_options3');
	$this->options4 = get_option( 'mysticky_elements_options4');
	$this->options5 = get_option( 'mysticky_elements_options5');
	$this->options6 = get_option( 'mysticky_elements_options6');
	$this->options7 = get_option( 'mysticky_elements_options7');
	$this->options8 = get_option( 'mysticky_elements_options8');
	$this->options9 = get_option( 'mysticky_elements_options9');
	
	
	 
	 
		 
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>myStickyElements Settings</h2>
            
           <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';  ?> 
            
            <h2 class="nav-tab-wrapper">
                <a href="?page=my-sticky-elements-settings&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General Settings</a>  
                <a href="?page=my-sticky-elements-settings&tab=element_1" class="nav-tab <?php echo $active_tab == 'element_1' ? 'nav-tab-active' : ''; ?>">E1</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_2" class="nav-tab <?php echo $active_tab == 'element_2' ? 'nav-tab-active' : ''; ?>">E2</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_3" class="nav-tab <?php echo $active_tab == 'element_3' ? 'nav-tab-active' : ''; ?>">E3</a>
                <a href="?page=my-sticky-elements-settings&tab=element_4" class="nav-tab <?php echo $active_tab == 'element_4' ? 'nav-tab-active' : ''; ?>">E4</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_5" class="nav-tab <?php echo $active_tab == 'element_5' ? 'nav-tab-active' : ''; ?>">E5</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_6" class="nav-tab <?php echo $active_tab == 'element_6' ? 'nav-tab-active' : ''; ?>">E6</a>
                <a href="?page=my-sticky-elements-settings&tab=element_7" class="nav-tab <?php echo $active_tab == 'element_7' ? 'nav-tab-active' : ''; ?>">E7</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_8" class="nav-tab <?php echo $active_tab == 'element_8' ? 'nav-tab-active' : ''; ?>">E8</a> 
                <a href="?page=my-sticky-elements-settings&tab=element_9" class="nav-tab <?php echo $active_tab == 'element_9' ? 'nav-tab-active' : ''; ?>">E9</a>
                <a href="?page=my-sticky-elements-settings&tab=element_10" class="nav-tab <?php echo $active_tab == 'element_10' ? 'nav-tab-active' : ''; ?>">E10</a>
            </h2>
            <form method="post" action="options.php">
             <?php
	 
                if( $active_tab == 'general' ) {  

                    settings_fields( 'mysticky_elements_option_group' );
                    do_settings_sections( 'my-sticky-elements-settings' );

                } else if( $active_tab == 'element_1' )  {

                    settings_fields( 'mysticky_elements_option_group9' );
                    do_settings_sections( 'my-sticky-elements-settings9' );

                
				 } else if( $active_tab == 'element_2' )  {

                    settings_fields( 'mysticky_elements_option_group8' );
                    do_settings_sections( 'my-sticky-elements-settings8' );

                } else if( $active_tab == 'element_3' )  {

                    settings_fields( 'mysticky_elements_option_group7' );
                    do_settings_sections( 'my-sticky-elements-settings7' );
					
				} else if( $active_tab == 'element_4' )  {

                    settings_fields( 'mysticky_elements_option_group6' );
                    do_settings_sections( 'my-sticky-elements-settings6' );
					
				} else if( $active_tab == 'element_5' )  {

                    settings_fields( 'mysticky_elements_option_group5' );
                    do_settings_sections( 'my-sticky-elements-settings5' );
				
				} else if( $active_tab == 'element_6' )  {

                    settings_fields( 'mysticky_elements_option_group4' );
                    do_settings_sections( 'my-sticky-elements-settings4' );
					
				} else if( $active_tab == 'element_7' )  {

                    settings_fields( 'mysticky_elements_option_group3' );
                    do_settings_sections( 'my-sticky-elements-settings3' );
					
				} else if( $active_tab == 'element_8' )  {

                    settings_fields( 'mysticky_elements_option_group2' );
                    do_settings_sections( 'my-sticky-elements-settings2' );
					
				} else if( $active_tab == 'element_9' )  {

                    settings_fields( 'mysticky_elements_option_group1' );
                    do_settings_sections( 'my-sticky-elements-settings1' );
					
				} else if( $active_tab == 'element_10' )  {

                    settings_fields( 'mysticky_elements_option_group0' );
                    do_settings_sections( 'my-sticky-elements-settings0' );








                }			
           
                // This prints out all hidden setting fields
           //     settings_fields( 'mysticky_elements_option_group' );   
             //   do_settings_sections( 'my-sticky-elements-settings' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }
	
    /**
     * Register and add settings
     */
    public function page_init()
    {   
		global $id, $title, $callback, $page;     
        register_setting(
            'mysticky_elements_option_group', // Option group
            'mysticky_elements_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group9', // Option group
            'mysticky_elements_options9', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		
		register_setting(
            'mysticky_elements_option_group8', // Option group
            'mysticky_elements_options8', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group7', // Option group
            'mysticky_elements_options7', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group6', // Option group
            'mysticky_elements_options6', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group5', // Option group
            'mysticky_elements_options5', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group4', // Option group
            'mysticky_elements_options4', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group3', // Option group
            'mysticky_elements_options3', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group2', // Option group
            'mysticky_elements_options2', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group1', // Option group
            'mysticky_elements_options1', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		register_setting(
            'mysticky_elements_option_group0', // Option group
            'mysticky_elements_options0', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		
		add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() );

	    //** General Settings **//
	    add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-sticky-elements-settings' // Page
        );
		
		add_settings_field(
            'myfixed_disable_small_screen', 
            'Disable at Small Screen Sizes', 
            array( $this, 'myfixed_disable_small_screen_callback' ), 
            'my-sticky-elements-settings', 
            'setting_section_id'
        );
		
	/*	add_settings_field(
            'mysticky_active_on_height', 
            'Make visible when scroled', 
            array( $this, 'mysticky_active_on_height_callback' ), 
            'my-sticky-elements-settings', 
            'setting_section_id'
        );*/
		
		add_settings_field(
            'myfixed_click', 
            'Change on Event', 
            array( $this, 'myfixed_click_callback' ), 
            'my-sticky-elements-settings', 
            'setting_section_id'
        );	
		
		add_settings_field(
            'myfixed_cssstyle', 
            'CSS style', 
            array( $this, 'myfixed_cssstyle_callback' ), 
            'my-sticky-elements-settings', 
            'setting_section_id'
			 
        );
		
	
		   //** First element 9  **//
	
		 add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info9' ), // Callback
            'my-sticky-elements-settings9' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element9_enable_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
        add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element9_side_position_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element9_top_position_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element9_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element9_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element9_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element9_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );	
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element9_content_width_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element9_content_padding_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element9_content_callback' ), // Callback
            'my-sticky-elements-settings9', // Page
            'setting_section_id' // Section         
        );
		
		
		
		
		
		 //** Second element 8  **//	
		
		 add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info8' ), // Callback
            'my-sticky-elements-settings8' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element8_enable_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element8_side_position_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element8_top_position_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element8_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element8_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element8_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element8_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element8_content_width_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element8_content_padding_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element8_content_callback' ), // Callback
            'my-sticky-elements-settings8', // Page
            'setting_section_id' // Section         
        );
		
		
		
		//** Third element 7  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info7' ), // Callback
            'my-sticky-elements-settings7' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element7_enable_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element7_side_position_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element7_top_position_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element7_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element7_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element7_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element7_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element7_content_width_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element7_content_padding_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element7_content_callback' ), // Callback
            'my-sticky-elements-settings7', // Page
            'setting_section_id' // Section         
        );
		
		
		
		
		//** Fourth element 6  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info6' ), // Callback
            'my-sticky-elements-settings6' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element6_enable_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element6_side_position_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element6_top_position_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element6_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element6_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element6_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element6_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element6_content_width_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element6_content_padding_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element6_content_callback' ), // Callback
            'my-sticky-elements-settings6', // Page
            'setting_section_id' // Section         
        );
		
		
		
			
		
		//** Fifth element 5  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info5' ), // Callback
            'my-sticky-elements-settings5' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element5_enable_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element5_side_position_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element5_top_position_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element5_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element5_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element5_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element5_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element5_content_width_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element5_content_padding_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element5_content_callback' ), // Callback
            'my-sticky-elements-settings5', // Page
            'setting_section_id' // Section         
        );
		
			
		
		//** Sixth element 4  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info4' ), // Callback
            'my-sticky-elements-settings4' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element4_enable_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element4_side_position_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element4_top_position_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element4_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element4_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element4_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element4_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element4_content_width_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element4_content_padding_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element4_content_callback' ), // Callback
            'my-sticky-elements-settings4', // Page
            'setting_section_id' // Section         
        );
		
		
		
			
		
		//** Sevnth element 3  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info3' ), // Callback
            'my-sticky-elements-settings3' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element3_enable_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element3_side_position_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element3_top_position_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element3_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element3_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element3_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element3_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element3_content_width_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element3_content_padding_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element3_content_callback' ), // Callback
            'my-sticky-elements-settings3', // Page
            'setting_section_id' // Section         
        );
		
		
		
		
			
		
		//** Eight element 2  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info2' ), // Callback
            'my-sticky-elements-settings2' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element2_enable_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element2_side_position_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element2_top_position_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element2_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element2_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element2_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element2_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element2_content_width_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element2_content_padding_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element2_content_callback' ), // Callback
            'my-sticky-elements-settings2', // Page
            'setting_section_id' // Section         
        );
		
		
		
		
			
		
		//** Ninth element 1  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info1' ), // Callback
            'my-sticky-elements-settings1' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element1_enable_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element1_side_position_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element1_top_position_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element1_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element1_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element1_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element1_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element1_content_width_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element1_content_padding_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element1_content_callback' ), // Callback
            'my-sticky-elements-settings1', // Page
            'setting_section_id' // Section         
        );
		
		
		
		
			
		
		//** Tenth element 0  **//
		
		add_settings_section(
            'setting_section_id', // ID
            'myStickyElements Options', // Title
            array( $this, 'print_section_info0' ), // Callback
            'my-sticky-elements-settings0' // Page
        );
		add_settings_field(
            'myfixed_element_enable', // ID
            'Enable Element', // Title 
            array( $this, 'myfixed_element0_enable_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		
		
		add_settings_field(
            'myfixed_element_side_position', // ID
            'Horizontal Position', // Title 
            array( $this, 'myfixed_element0_side_position_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_top_position', // ID
            'Vertical Position', // Title 
            array( $this, 'myfixed_element0_top_position_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_color', // ID
            'Icon bg Color', // Title 
            array( $this, 'myfixed_element0_icon_bg_color_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_icon_bg_img', // ID
            'Icon bg Image', // Title 
            array( $this, 'myfixed_element0_icon_bg_img_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_bg_color', // ID
            'Content bg Color', // Title 
            array( $this, 'myfixed_element0_content_bg_color_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_txt_color', // ID
            'Content Text Color', // Title 
            array( $this, 'myfixed_element0_content_txt_color_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_width', // ID
            'Content Width', // Title 
            array( $this, 'myfixed_element0_content_width_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content_padding', // ID
            'Content Padding', // Title 
            array( $this, 'myfixed_element0_content_padding_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );
		add_settings_field(
            'myfixed_element_content', // ID
            'Content', // Title 
            array( $this, 'myfixed_element0_content_callback' ), // Callback
            'my-sticky-elements-settings0', // Page
            'setting_section_id' // Section         
        );


      
    }
	
	
	
	
	
	
	
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
		
		
        $new_input = array();
        if( isset( $input['myfixed_element_enable'] ) )
            $new_input['myfixed_element_enable'] = sanitize_text_field( $input['myfixed_element_enable'] );
			
		if( isset( $input['myfixed_element_side_position'] ) )
            $new_input['myfixed_element_side_position'] = sanitize_text_field( $input['myfixed_element_side_position'] );
			
		if( isset( $input['myfixed_element_top_position'] ) )
            $new_input['myfixed_element_top_position'] = absint( $input['myfixed_element_top_position'] );
		
		if( isset( $input['myfixed_element_icon_bg_color'] ) )
            $new_input['myfixed_element_icon_bg_color'] = sanitize_text_field( $input['myfixed_element_icon_bg_color'] );
		
		if( isset( $input['myfixed_element_icon_bg_img'] ) ) 
		    $new_input['myfixed_element_icon_bg_img'] = sanitize_text_field( $input['myfixed_element_icon_bg_img'] );
			
		if( isset( $input['myfixed_element_content_bg_color'] ) )
            $new_input['myfixed_element_content_bg_color'] =  sanitize_text_field( $input['myfixed_element_content_bg_color'] );	
			
		if( isset( $input['myfixed_element_content_txt_color'] ) )
            $new_input['myfixed_element_content_txt_color'] =  sanitize_text_field( $input['myfixed_element_content_txt_color'] );	
			
		if( isset( $input['myfixed_element_content_width'] ) )
            $new_input['myfixed_element_content_width'] =  absint( $input['myfixed_element_content_width'] );	
			
		if( isset( $input['myfixed_element_content_padding'] ) )
            $new_input['myfixed_element_content_padding'] =  absint( $input['myfixed_element_content_padding'] );	
			
		if( isset( $input['myfixed_element_content'] ) )
			$new_input['myfixed_element_content'] =  wp_kses($input['myfixed_element_content'], 
			
			array( 
				'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array(),
						'rel' => array()
						),
				'br' => array(),
				'h1' => array(),
				'h2' => array(),
				'h3' => array(),
				'h4' => array(),
				'h5' => array(),
				'h6' => array(),
				'&nbsp;' => array(),
				'hr' => array(),
				'p' => array(),
				'em' => array(),
				'strong' => array(),
				'ul' => array(),
				'ol' => array(),
				'li' => array(),
				'blockquote' => array(),
				'iframe' => array(
						'src' => array(),
						'width' => array(),
						'height' => array(),
						'frameborder' => array(),
						'allowfullscreen' => array(),
						'scrolling' => array(),
						'style' => array(),
						'allowtransparency' => array()
						),
				'img' => array(
						'src' => array(),
						'alt' => array(),
						'class' => array(),
						'width' => array(),
						'height' => array(),
						'rel' => array()
						),
				'span' => array(
						'style' => array(),
						'class' => array()
						)

				) 
			);
	
		/*	
	echo wp_kses( $text, array( 
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
) );
*/	

        if( isset( $input['myfixed_zindex'] ) )
            $new_input['myfixed_zindex'] = absint( $input['myfixed_zindex'] );
			
		if( isset( $input['myfixed_disable_small_screen'] ) )
            $new_input['myfixed_disable_small_screen'] = absint( $input['myfixed_disable_small_screen'] );
			
		/*if( isset( $input['mysticky_active_on_height'] ) )
            $new_input['mysticky_active_on_height'] = absint( $input['mysticky_active_on_height'] );*/
			
		if( isset( $input['myfixed_click'] ) )
            $new_input['myfixed_click'] = sanitize_text_field( $input['myfixed_click'] ); 
		
		if( isset( $input['myfixed_cssstyle'] ) )
            //$new_input['myfixed_cssstyle'] = esc_textarea( $input['myfixed_cssstyle'] );
             $new_input['myfixed_cssstyle'] = sanitize_text_field( $input['myfixed_cssstyle'] );
			 
			 
        return $new_input;
    }
	
	 /**
     * Load Defaults
     */ 	
	public function mysticky_elements_default_options() {
		
		global $options;
		
		$default = array(
		
				'myfixed_disable_small_screen' => '767',
				/*'mysticky_active_on_height' => '120',*/
				'myfixed_click' => 'click',
				'myfixed_cssstyle' => '.mysticky-block-left, .mysticky-block-right { position: fixed; top: 220px; z-index: 9999; } .mysticky-block-icon { cursor: pointer; cursor: hand; width: 50px; height: 50px; background-position: center; background-repeat: no-repeat; } .mysticky-block-content p { margin: 0; } .mysticky-block-content > div { position: relative; width: 100%; height: 100%; } .mysticky-block-left .mysticky-block-icon { position: absolute; top: 0; right: -50px; } .mysticky-block-right .mysticky-block-icon { position: absolute; top: 0; left: -50px; } .mysticky-block-content hr { margin-bottom: 7px; } .mysticky-block-content img { margin: 5px 0; } .mysticky-block-content a {}'	
				
			);
		
		$default9 = array(
		

				'myfixed_element_enable' => 'enable',
				'myfixed_element_side_position' => 'left',
				'myfixed_element_top_position' => '290',
				'myfixed_element_icon_bg_color' => '#F39A30',
				'myfixed_element_icon_bg_img' => '/img/white/info.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'myStickyElements is simple yet very effective plugin. It is perfect to fill out usually unused side space on webpages with some additional messages, videos, social widgets ...
<a href="http://wordpress.transformnews.com/plugins/mystickyelements-simple-sticky-side-elements-for-wordpress-504">more about plugin</a>'
	
			);
			
			
		$default8 = array(

				'myfixed_element_enable' => 'enable',
				'myfixed_element_side_position' => 'left',
				'myfixed_element_top_position' => '350',
				'myfixed_element_icon_bg_color' => '#1bb6ec',
				'myfixed_element_icon_bg_img' => '/img/white/vimeo.png',
				'myfixed_element_content_bg_color' => '',
				'myfixed_element_content_txt_color' => '',
				'myfixed_element_content_width' => '500',
				'myfixed_element_content_padding' => '0',
				'myfixed_element_content' => '<iframe src="//player.vimeo.com/video/59049515" width="500" height="281" frameborder="0" allowfullscreen="allowfullscreen"></iframe>'
				
			);
			
		$default7 = array(

				'myfixed_element_enable' => 'enable',
				'myfixed_element_side_position' => 'left',
				'myfixed_element_top_position' => '410',
				'myfixed_element_icon_bg_color' => '#f6400e',
				'myfixed_element_icon_bg_img' => '/img/white/soundcloud.png',
				'myfixed_element_content_bg_color' => '',
				'myfixed_element_content_txt_color' => '',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '0',
				'myfixed_element_content' => '<iframe width="100%" height="250" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/8251512&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>'

			);
			
		$default6 = array(

				'myfixed_element_enable' => 'enable',
				'myfixed_element_side_position' => 'left',
				'myfixed_element_top_position' => '470',
				'myfixed_element_icon_bg_color' => '#48ad45',
				'myfixed_element_icon_bg_img' => '/img/white/chat.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'You can add up to 10 elements, position them left or right, change vertical position, change icon img, background color and more...'

			);
			
		$default5 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'left',
				'myfixed_element_top_position' => '530',
				'myfixed_element_icon_bg_color' => '#5f44af',
				'myfixed_element_icon_bg_img' => '/img/white/mail.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '300',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => '<a href="http://wordpress.transformnews.com/contact">myStickyElements Contact</a>'

			);
			
			
		$default4 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'right',
				'myfixed_element_top_position' => '290',
				'myfixed_element_icon_bg_color' => '#cd332d',
				'myfixed_element_icon_bg_img' => '/img/white/youtube.png',
				'myfixed_element_content_bg_color' => '',
				'myfixed_element_content_txt_color' => '',
				'myfixed_element_content_width' => '560',
				'myfixed_element_content_padding' => '0',
				'myfixed_element_content' => '<iframe width="560" height="315" src="//www.youtube.com/embed/kBXnJiQwMVc" frameborder="0" allowfullscreen></iframe>'

			);
			
			
		$default3 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'right',
				'myfixed_element_top_position' => '350',
				'myfixed_element_icon_bg_color' => '#5eaade',
				'myfixed_element_icon_bg_img' => '/img/white/twitter.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'twitter content here'

			);
			
			
		$default2 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'right',
				'myfixed_element_top_position' => '410',
				'myfixed_element_icon_bg_color' => '#3b5998',
				'myfixed_element_icon_bg_img' => '/img/white/facebook.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'facebook content here'

			);
			
			
		$default1 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'right',
				'myfixed_element_top_position' => '470',
				'myfixed_element_icon_bg_color' => '#ca1f25',
				'myfixed_element_icon_bg_img' => '/img/white/pinterest.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'pintrest content here'

			);
			
			
		$default0 = array(

				'myfixed_element_enable' => 'disable',
				'myfixed_element_side_position' => 'right',
				'myfixed_element_top_position' => '530',
				'myfixed_element_icon_bg_color' => '#0063db',
				'myfixed_element_icon_bg_img' => '/img/white/flickr.png',
				'myfixed_element_content_bg_color' => '#eaeaea',
				'myfixed_element_content_txt_color' => '#16100e',
				'myfixed_element_content_width' => '400',
				'myfixed_element_content_padding' => '20',
				'myfixed_element_content' => 'flickr content here'

			);
			


		if ( get_option('mysticky_elements_options') == false )  {	

			update_option( 'mysticky_elements_options', $default );		

		} 
		 
		if ( get_option('mysticky_elements_options9') == false )  {	
		
			update_option( 'mysticky_elements_options9', $default9 );		

		}

		if ( get_option('mysticky_elements_options8') == false )  {	
			
			update_option( 'mysticky_elements_options8', $default8 );		
		}
		
		if ( get_option('mysticky_elements_options7') == false )  {	
	
			update_option( 'mysticky_elements_options7', $default7 );		
		}
		
		if ( get_option('mysticky_elements_options6') == false )  {	
	
			update_option( 'mysticky_elements_options6', $default6 );		
		}
		
		if ( get_option('mysticky_elements_options5') == false )  {	
	
			update_option( 'mysticky_elements_options5', $default5 );		
		}
		
		if ( get_option('mysticky_elements_options4') == false )  {	
	
			update_option( 'mysticky_elements_options4', $default4 );		
		}
		
		if ( get_option('mysticky_elements_options3') == false )  {	
	
			update_option( 'mysticky_elements_options3', $default3 );		
		}
		
		if ( get_option('mysticky_elements_options2') == false )  {	
	
			update_option( 'mysticky_elements_options2', $default2 );		
		}
		
		if ( get_option('mysticky_elements_options1') == false )  {	
	
			update_option( 'mysticky_elements_options1', $default1 );		
		}
		
		if ( get_option('mysticky_elements_options0') == false )  {	
	
			update_option( 'mysticky_elements_options0', $default0 );		
		}

}
		/*
  foreach ( $options as $option => $default_value ) {
    if ( ! get_option( $option ) ) {
        add_option( $option, $default_value );
    } else {
        update_option( $option, $default_value );
    }
  }		
		*/	
		
	public  function mw_enqueue_color_picker(  ) 
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugins_url('js/iris-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}


	 
	 /* ***** GENERAL ***** */
	 
    public function print_section_info()
    {
        print 'Add sticky elements to your blog.';
    }
    /** 
     * Get the settings option array and print one of its values
     */
	
	public function myfixed_disable_small_screen_callback()
	{
		printf(
		'<p class="description">less than <input type="text" size="4" id="myfixed_disable_small_screen" name="mysticky_elements_options[myfixed_disable_small_screen]" value="%s" />px width, 0  to disable.</p>',
            isset( $this->options['myfixed_disable_small_screen'] ) ? esc_attr( $this->options['myfixed_disable_small_screen']) : ''
		);
	}
	
	/*public function mysticky_active_on_height_callback()
	{
		printf(
		'<p class="description">after <input type="text" size="4" id="mysticky_active_on_height" name="mysticky_elements_options[mysticky_active_on_height]" value="%s" />px</p>',
            isset( $this->options['mysticky_active_on_height'] ) ? esc_attr( $this->options['mysticky_active_on_height']) : ''
		);
	}*/
	
	
	public function myfixed_click_callback()
	{
		printf(
		'<select id="myfixed_click" name="mysticky_elements_options[myfixed_click]" selected="%s">',
			isset( $this->options['myfixed_click'] ) ? esc_attr( $this->options['myfixed_click']) : '' 
		);
		if ($this->options['myfixed_click'] == 'click') {
		printf(
		'<option name="click" value="click" selected>click</option>
		<option name="hover" value="hover">hover</option>
		</select>'
		);	
		}
		if ($this->options['myfixed_click'] == 'hover') {
		printf(
		'<option name="click" value="click">click</option>
		<option name="hover" value="hover" selected >hover</option>
		</select>'
		);	
		}
		if ($this->options['myfixed_click'] == '') {
		printf(
		'<option name="click" value="click" selected>click</option>
		<option name="hover" value="hover">hover</option>
		</select>'
		);	
		}			
	} 
	
   public function myfixed_cssstyle_callback()
   
    {
        printf(
            '
			<p class="description">Add/Edit css to manage advanced elements style.</p>  <textarea type="text" rows="4" cols="60" id="myfixed_cssstyle" name="mysticky_elements_options[myfixed_cssstyle]">%s</textarea> <br />
		' ,
            isset( $this->options['myfixed_cssstyle'] ) ? esc_attr( $this->options['myfixed_cssstyle']) : ''
        );
		echo '</p>';
    }
	
	
	/* ***** ELEMENT 1 ***** */
	
	public function print_section_info9()
    {
        print 'Element 1 Settings.';
    }
	
	 
	 public function myfixed_element9_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options9[myfixed_element_enable]" selected="%s">',
			isset( $this->options9['myfixed_element_enable'] ) ? esc_attr( $this->options9['myfixed_element_enable']) : '' 
		);
		if ($this->options9['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options9['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options9['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	 
	 
	 
	 
	 
	public function myfixed_element9_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options9[myfixed_element_side_position]" selected="%s">',
			isset( $this->options9['myfixed_element_side_position'] ) ? esc_attr( $this->options9['myfixed_element_side_position']) : '' 
		);
		if ($this->options9['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options9['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options9['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	
	public function myfixed_element9_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options9[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options9['myfixed_element_top_position'] ) ? esc_attr( $this->options9['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element9_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options9[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options9['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options9['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element9_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options9[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options9['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options9['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element9_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options9[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options9['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options9['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element9_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options9[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options9['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options9['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element9_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options9[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options9['myfixed_element_content_width'] ) ? esc_attr( $this->options9['myfixed_element_content_width']) : '' 
        );
    }
	
	
	public function myfixed_element9_content_padding_callback()
    {
			
		
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options9[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options9['myfixed_element_content_padding'] ) ? esc_attr( $this->options9['myfixed_element_content_padding']) : '' 
        );
		
		
		}
		

	
   public function myfixed_element9_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options9['myfixed_element_content'] ) ? esc_textarea( $this->options9['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options9[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	

    /* ***** ELEMENT 2 ***** */

	public function print_section_info8()
    {
        print 'Element 2 Settings.';
    }
	
     public function myfixed_element8_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options8[myfixed_element_enable]" selected="%s">',
			isset( $this->options8['myfixed_element_enable'] ) ? esc_attr( $this->options8['myfixed_element_enable']) : '' 
		);
		if ($this->options8['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options8['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options8['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }






	
	public function myfixed_element8_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options8[myfixed_element_side_position]" selected="%s">',
			isset( $this->options8['myfixed_element_side_position'] ) ? esc_attr( $this->options8['myfixed_element_side_position']) : '' 
		);
		if ($this->options8['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options8['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options8['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	
	public function myfixed_element8_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options8[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options8['myfixed_element_top_position'] ) ? esc_attr( $this->options8['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element8_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options8[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options8['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options8['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element8_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options8[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options8['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options8['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element8_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options8[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options8['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options8['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element8_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options8[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options8['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options8['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element8_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options8[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options8['myfixed_element_content_width'] ) ? esc_attr( $this->options8['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element8_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options8[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options8['myfixed_element_content_padding'] ) ? esc_attr( $this->options8['myfixed_element_content_padding']) : '' 
        );
    }
	
	
	 public function myfixed_element8_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options8['myfixed_element_content'] ) ? esc_textarea( $this->options8['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options8[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
    /* ***** ELEMENT 3 ***** */
	
	
		public function print_section_info7()
    {
        print 'Element 3 Settings.';
    }
	
	
	 public function myfixed_element7_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options7[myfixed_element_enable]" selected="%s">',
			isset( $this->options7['myfixed_element_enable'] ) ? esc_attr( $this->options7['myfixed_element_enable']) : '' 
		);
		if ($this->options7['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options7['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options7['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element7_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options7[myfixed_element_side_position]" selected="%s">',
			isset( $this->options7['myfixed_element_side_position'] ) ? esc_attr( $this->options7['myfixed_element_side_position']) : '' 
		);
		if ($this->options7['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options7['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options7['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element7_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options7[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options7['myfixed_element_top_position'] ) ? esc_attr( $this->options7['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element7_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options7[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options7['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options7['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element7_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options7[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options7['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options7['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element7_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options7[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options7['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options7['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element7_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options7[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options7['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options7['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element7_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options7[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options7['myfixed_element_content_width'] ) ? esc_attr( $this->options7['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element7_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options7[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options7['myfixed_element_content_padding'] ) ? esc_attr( $this->options7['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element7_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options7['myfixed_element_content'] ) ? esc_textarea( $this->options7['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options7[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	
	/* ***** ELEMENT 4 ***** */
	
	
		public function print_section_info6()
    {
        print 'Element 4 Settings.';
    }
	
	
	 public function myfixed_element6_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options6[myfixed_element_enable]" selected="%s">',
			isset( $this->options6['myfixed_element_enable'] ) ? esc_attr( $this->options6['myfixed_element_enable']) : '' 
		);
		if ($this->options6['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options6['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options6['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element6_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options6[myfixed_element_side_position]" selected="%s">',
			isset( $this->options6['myfixed_element_side_position'] ) ? esc_attr( $this->options6['myfixed_element_side_position']) : '' 
		);
		if ($this->options6['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options6['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options6['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element6_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options6[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options6['myfixed_element_top_position'] ) ? esc_attr( $this->options6['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element6_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options6[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options6['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options6['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element6_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options6[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options6['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options6['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element6_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options6[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options6['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options6['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element6_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options6[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options6['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options6['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element6_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options6[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options6['myfixed_element_content_width'] ) ? esc_attr( $this->options6['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element6_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options6[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options6['myfixed_element_content_padding'] ) ? esc_attr( $this->options6['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element6_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options6['myfixed_element_content'] ) ? esc_textarea( $this->options6['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options6[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	/* ***** ELEMENT 5 ***** */
	
	
		public function print_section_info5()
    {
        print 'Element 5 Settings.';
    }
	
	
	 public function myfixed_element5_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options5[myfixed_element_enable]" selected="%s">',
			isset( $this->options5['myfixed_element_enable'] ) ? esc_attr( $this->options5['myfixed_element_enable']) : '' 
		);
		if ($this->options5['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options5['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options5['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element5_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options5[myfixed_element_side_position]" selected="%s">',
			isset( $this->options5['myfixed_element_side_position'] ) ? esc_attr( $this->options5['myfixed_element_side_position']) : '' 
		);
		if ($this->options5['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options5['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options5['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element5_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options5[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options5['myfixed_element_top_position'] ) ? esc_attr( $this->options5['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element5_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options5[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options5['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options5['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element5_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options5[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options5['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options5['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element5_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options5[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options5['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options5['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element5_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options5[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options5['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options5['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element5_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options5[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options5['myfixed_element_content_width'] ) ? esc_attr( $this->options5['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element5_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options5[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options5['myfixed_element_content_padding'] ) ? esc_attr( $this->options5['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element5_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options5['myfixed_element_content'] ) ? esc_textarea( $this->options5['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options5[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	
	/* ***** ELEMENT 6 ***** */
	
	
		public function print_section_info4()
    {
        print 'Element 6 Settings.';
    }
	
	
	 public function myfixed_element4_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options4[myfixed_element_enable]" selected="%s">',
			isset( $this->options4['myfixed_element_enable'] ) ? esc_attr( $this->options4['myfixed_element_enable']) : '' 
		);
		if ($this->options4['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options4['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options4['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element4_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options4[myfixed_element_side_position]" selected="%s">',
			isset( $this->options4['myfixed_element_side_position'] ) ? esc_attr( $this->options4['myfixed_element_side_position']) : '' 
		);
		if ($this->options4['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options4['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options4['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element4_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options4[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options4['myfixed_element_top_position'] ) ? esc_attr( $this->options4['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element4_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options4[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options4['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options4['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element4_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options4[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options4['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options4['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element4_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options4[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options4['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options4['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element4_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options4[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options4['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options4['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element4_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options4[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options4['myfixed_element_content_width'] ) ? esc_attr( $this->options4['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element4_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options4[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options4['myfixed_element_content_padding'] ) ? esc_attr( $this->options4['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element4_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options4['myfixed_element_content'] ) ? esc_textarea( $this->options4['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options4[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	/* ***** ELEMENT 7 ***** */
	
	
		public function print_section_info3()
    {
        print 'Element 7 Settings.';
    }
	
	
	 public function myfixed_element3_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options3[myfixed_element_enable]" selected="%s">',
			isset( $this->options3['myfixed_element_enable'] ) ? esc_attr( $this->options3['myfixed_element_enable']) : '' 
		);
		if ($this->options3['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options3['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options3['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element3_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options3[myfixed_element_side_position]" selected="%s">',
			isset( $this->options3['myfixed_element_side_position'] ) ? esc_attr( $this->options3['myfixed_element_side_position']) : '' 
		);
		if ($this->options3['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options3['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options3['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element3_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options3[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options3['myfixed_element_top_position'] ) ? esc_attr( $this->options3['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element3_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options3[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options3['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options3['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element3_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options3[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options3['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options3['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element3_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options3[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options3['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options3['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element3_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options3[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options3['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options3['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element3_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options3[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options3['myfixed_element_content_width'] ) ? esc_attr( $this->options3['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element3_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options3[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options3['myfixed_element_content_padding'] ) ? esc_attr( $this->options3['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element3_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options3['myfixed_element_content'] ) ? esc_textarea( $this->options3['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options3[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	/* ***** ELEMENT 8 ***** */
	
	
		public function print_section_info2()
    {
        print 'Element 8 Settings.';
    }
	
	
	 public function myfixed_element2_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options2[myfixed_element_enable]" selected="%s">',
			isset( $this->options2['myfixed_element_enable'] ) ? esc_attr( $this->options2['myfixed_element_enable']) : '' 
		);
		if ($this->options2['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options2['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options2['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element2_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options2[myfixed_element_side_position]" selected="%s">',
			isset( $this->options2['myfixed_element_side_position'] ) ? esc_attr( $this->options2['myfixed_element_side_position']) : '' 
		);
		if ($this->options2['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options2['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options2['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element2_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options2[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options2['myfixed_element_top_position'] ) ? esc_attr( $this->options2['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element2_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options2[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options2['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options2['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element2_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options2[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options2['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options2['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element2_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options2[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options2['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options2['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element2_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options2[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options2['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options2['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element2_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options2[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options2['myfixed_element_content_width'] ) ? esc_attr( $this->options2['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element2_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options2[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options2['myfixed_element_content_padding'] ) ? esc_attr( $this->options2['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element2_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options2['myfixed_element_content'] ) ? esc_textarea( $this->options2['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options2[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	
	/* ***** ELEMENT 9 ***** */
	
	
		public function print_section_info1()
    {
        print 'Element 9 Settings.';
    }
	
	
	 public function myfixed_element1_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options1[myfixed_element_enable]" selected="%s">',
			isset( $this->options1['myfixed_element_enable'] ) ? esc_attr( $this->options1['myfixed_element_enable']) : '' 
		);
		if ($this->options1['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options1['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options1['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element1_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options1[myfixed_element_side_position]" selected="%s">',
			isset( $this->options1['myfixed_element_side_position'] ) ? esc_attr( $this->options1['myfixed_element_side_position']) : '' 
		);
		if ($this->options1['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options1['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options1['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element1_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options1[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options1['myfixed_element_top_position'] ) ? esc_attr( $this->options1['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element1_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options1[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options1['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options1['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element1_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options1[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options1['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options1['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element1_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options1[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options1['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options1['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element1_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options1[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options1['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options1['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element1_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options1[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options1['myfixed_element_content_width'] ) ? esc_attr( $this->options1['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element1_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options1[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options1['myfixed_element_content_padding'] ) ? esc_attr( $this->options1['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element1_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options1['myfixed_element_content'] ) ? esc_textarea( $this->options1['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options1[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	/* ***** ELEMENT 10 ***** */
	
	
		public function print_section_info0()
    {
        print 'Element 10 Settings.';
    }
	
	
	 public function myfixed_element0_enable_callback()
	{	
		printf(
		'<select id="myfixed_element_enable" name="mysticky_elements_options0[myfixed_element_enable]" selected="%s">',
			isset( $this->options0['myfixed_element_enable'] ) ? esc_attr( $this->options0['myfixed_element_enable']) : '' 
		);
		if ($this->options0['myfixed_element_enable'] == 'enable') {
			printf(
		'<option name="enable" value="enable" selected>enable</option>
		<option name="disable" value="disable">disable</option>
		</select>'
		);	
		}
		if ($this->options0['myfixed_element_enable'] == 'disable') {
			printf(
		'<option name="enable" value="enable">enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}	
		if ($this->options0['myfixed_element_enable'] == '') {
			printf(
		'<option name="enable" value="enable" >enable</option>
		<option name="disable" value="disable" selected >disable</option>
		</select>'
		);	
		}		
    }
	
	
	
	public function myfixed_element0_side_position_callback()
	{	
		printf(
		'<select id="myfixed_element_side_position" name="mysticky_elements_options0[myfixed_element_side_position]" selected="%s">',
			isset( $this->options0['myfixed_element_side_position'] ) ? esc_attr( $this->options0['myfixed_element_side_position']) : '' 
		);
		if ($this->options0['myfixed_element_side_position'] == 'left') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}
		if ($this->options0['myfixed_element_side_position'] == 'right') {
			printf(
		'<option name="left" value="left">left</option>
		<option name="right" value="right" selected >right</option>
		</select>'
		);	
		}	
		if ($this->options0['myfixed_element_side_position'] == '') {
			printf(
		'<option name="left" value="left" selected>left</option>
		<option name="right" value="right">right</option>
		</select>'
		);	
		}	
    }
	public function myfixed_element0_top_position_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_top_position" name="mysticky_elements_options0[myfixed_element_top_position]" value="%s" /> px (top position of an element). Please note that Element 1 must be on top of element 2 and so on, otherwise elements will overlap...</p>',
            isset( $this->options0['myfixed_element_top_position'] ) ? esc_attr( $this->options0['myfixed_element_top_position']) : '' 
        );
    }
	public function myfixed_element0_icon_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_icon_bg_color" name="mysticky_elements_options0[myfixed_element_icon_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options0['myfixed_element_icon_bg_color'] ) ? esc_attr( $this->options0['myfixed_element_icon_bg_color']) : '' 
        );
    }
	public function myfixed_element0_icon_bg_img_callback()
    {
        printf(
            '<p class="description"><input type="text" size="28" id="myfixed_element_icon_bg_img" name="mysticky_elements_options0[myfixed_element_icon_bg_img]" value="%s" />  Icon Image.</p>',
            isset( $this->options0['myfixed_element_icon_bg_img'] ) ? esc_attr( $this->options0['myfixed_element_icon_bg_img']) : '' 
        );
    }
	public function myfixed_element0_content_bg_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_bg_color" name="mysticky_elements_options0[myfixed_element_content_bg_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options0['myfixed_element_content_bg_color'] ) ? esc_attr( $this->options0['myfixed_element_content_bg_color']) : '' 
        );
    }
	public function myfixed_element0_content_txt_color_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_element_content_txt_color" name="mysticky_elements_options0[myfixed_element_content_txt_color]" value="%s" class="my-color-field" /></p>',
            isset( $this->options0['myfixed_element_content_txt_color'] ) ? esc_attr( $this->options0['myfixed_element_content_txt_color']) : '' 
        );
    }
	public function myfixed_element0_content_width_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_width" name="mysticky_elements_options0[myfixed_element_content_width]" value="%s" />px</p>',
            isset( $this->options0['myfixed_element_content_width'] ) ? esc_attr( $this->options0['myfixed_element_content_width']) : '' 
        );
    }
	public function myfixed_element0_content_padding_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_element_content_padding" name="mysticky_elements_options0[myfixed_element_content_padding]" value="%s" />px</p>',
            isset( $this->options0['myfixed_element_content_padding'] ) ? esc_attr( $this->options0['myfixed_element_content_padding']) : '' 
        );
    }
	
	
   public function myfixed_element0_content_callback()
   
    {
		$content_id = 'myfixed_element_content';
		$content =  (isset( $this->options0['myfixed_element_content'] ) ? esc_textarea( $this->options0['myfixed_element_content']) : '');
		 
		wp_editor( html_entity_decode($content), $content_id, 
			 array(
			'textarea_name' => 'mysticky_elements_options0[myfixed_element_content]',
			//'teeny' => true,
			//'tinymce' => true,
			'textarea_rows' => get_option('default_post_edit_rows', 8)
			)  
		);	
    }
	
	
	
	
	
	
	
}

	if( is_admin() )
    $my_settings_page = new MyStickyElementsPage();

	// end plugin admin settings
	
	
	


	// Create style from options

	function mysticky_element_build_stylesheet_content() {
	
		$mysticky_options = get_option( 'mysticky_elements_options' );
	
	
    echo
'<style type="text/css">';
	if (  $mysticky_options['myfixed_cssstyle'] == "" )  {
	echo '';
	}
	echo
	  $mysticky_options ['myfixed_cssstyle'] ;
	
	if  ($mysticky_options ['myfixed_disable_small_screen'] > 0 ){
    echo
		'
		@media only screen and (max-width: ' . $mysticky_options ['myfixed_disable_small_screen'] . 'px) { .mysticky-block-left, .mysticky-block-right { display: none; } }
	';
	
	}
	echo 
'</style>
	';
	}
	
	add_action('wp_head', 'mysticky_element_build_stylesheet_content');
	
	
	function insert_my_footerrr() {
		
		$mysticky_options0 = get_option( 'mysticky_elements_options0' );
		$mysticky_options1 = get_option( 'mysticky_elements_options1' );
		$mysticky_options2 = get_option( 'mysticky_elements_options2' );
		$mysticky_options3 = get_option( 'mysticky_elements_options3' );
		$mysticky_options4 = get_option( 'mysticky_elements_options4' );
		$mysticky_options5 = get_option( 'mysticky_elements_options5' );
		$mysticky_options6 = get_option( 'mysticky_elements_options6' );
		$mysticky_options7 = get_option( 'mysticky_elements_options7' );
		$mysticky_options8 = get_option( 'mysticky_elements_options8' );
		$mysticky_options9 = get_option( 'mysticky_elements_options9' );
		
		$mysticky_options_arr = array($mysticky_options0, $mysticky_options1, $mysticky_options2, $mysticky_options3, $mysticky_options4, $mysticky_options5, $mysticky_options6, $mysticky_options7, $mysticky_options8, $mysticky_options9);
		
	foreach ($mysticky_options_arr as &$mysticky_option) {
   
		//$mysticky_option
	if ($mysticky_option ['myfixed_element_enable'] == "enable") {
		
	$plugins_url = plugins_url();
	//background:' . $mysticky_option ['myfixed_element_content_bg_color'] . ';
    echo '
	<div class="mysticky-block-' . $mysticky_option ['myfixed_element_side_position'] . '" style="width: ' . $mysticky_option ['myfixed_element_content_width'] . 'px; ' . $mysticky_option ['myfixed_element_side_position'] . ': -' . $mysticky_option ['myfixed_element_content_width'] . 'px; top: ' . $mysticky_option ['myfixed_element_top_position'] . 'px; position: fixed; ">
	<div class="mysticky-block-icon" style="background-color:' . $mysticky_option ['myfixed_element_icon_bg_color'] . ' !important; background-image: url(' . home_url( ''. $mysticky_option ['myfixed_element_icon_bg_img'] . '', __FILE__ ) . ') !important;height : 100px ; width :198px ; left: -144px ;"></div> 
	 <div id="stickycontent" class="mysticky-block-content" style="min-height: 50px; color:' . $mysticky_option ['myfixed_element_content_txt_color'] . '; padding: ' . $mysticky_option ['myfixed_element_content_padding'] . 'px;">' . $mysticky_option ['myfixed_element_content'] . ' 

</div>
	
	</div>
';	
       }; // endif
	   
	   
	  if ($mysticky_option ['myfixed_element_enable'] == "disable") {
		
    echo '';	
       }; // endif


		}	
		
	unset($mysticky_options_arr); // break the reference with the last element

}

add_action('wp_footer', 'insert_my_footerrr');
	
	
	function mystickyelements_script() {
		
		$mysticky_options = get_option( 'mysticky_elements_options' );
		
		// Register scripts
			wp_register_script('mystickyelements', WP_PLUGIN_URL. '/mystickyelements/js/mystickyelements.js', false,'1.0.0', true);
			wp_enqueue_script( 'mystickyelements' );
			wp_enqueue_script( 'jquery' );

		// Localize mystickyelements.js script with myStickyElements options
		$mysticky_translation_array = array( 
		    'myfixed_click_string' => $mysticky_options['myfixed_click'] ,
		/*	'mysticky_active_on_height_string' => $mysticky_options['mysticky_active_on_height'],*/
			'mysticky_disable_at_width_string' => $mysticky_options['myfixed_disable_small_screen'],
			
		);
		
			wp_localize_script( 'mystickyelements', 'mysticky_element', $mysticky_translation_array );
	}

	add_action( 'wp_enqueue_scripts', 'mystickyelements_script' );
	
?>