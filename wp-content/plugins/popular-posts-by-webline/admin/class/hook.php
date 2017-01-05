<?php
class wliPopularPosts {
	
	public function __construct() {
		register_activation_hook(PP_PATH . PP_PLUGIN_FILE, array($this,'wli_popular_posts_default_option_value'));
		register_uninstall_hook(PP_PATH . PP_PLUGIN_FILE,array(__CLASS__,'wli_popular_posts_delete_option_value'));
	}

	/**
	 *  wli_popular_posts_default_option_value() is called when the plugin is activated.
	 *
	 *  @return             void
	 *  @var                No arguments passed
	 *  @author             Weblineindia
	 *
	 */
	public function wli_popular_posts_default_option_value() {
		$default_values=array(
				'version'=>WLIPOPULARPOSTS_VERSION,
		);
		add_option('wli_popular_posts_settings',$default_values);
	
	}

	/**
	 *   wli_popular_posts_delete_option_value() is called when when the plugin is deleted.
	 *
	 *  @return             void
	 *  @var                No arguments passed
	 *  @author             Weblineindia
	 *
	 */
	public static function wli_popular_posts_delete_option_value() {
		delete_option('wli_popular_posts_settings');
	}
}

new wliPopularPosts();
?>
