<?php

namespace mspb;
use mspb\Loader;
use mspb\controllers\PublicController;
use mspb\controllers\AdminController;
use mspb\controllers\AjaxController;

class MSPluginBoilerplate {

	private static $instance;
	private $loader;
	private $publicController;


	/**
	* @return self
	*/
	public static function instance() 
	{
		if( !self::$instance  && !self::$instance instanceof MSPluginBoilerplate) {
			self::$instance = new static();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * build the plugin 
	 */
	private function setup() {
		$this->loadDependencies();
		$this->defineHooks();
		$this->defineConstans();
		$this->run();
	}

	private function loadDependencies() {
		$this->loader = new Loader();
		$this->publicController = new PublicController();
		$this->adminController = new AdminController();
		$this->ajaxController = new AjaxController();
	}

	private function defineHooks() {

		// init scripts & styles
		$this->loader->add_action( 'wp_enqueue_scripts', $this->loader, 'initScripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->loader, 'initBackendScripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->loader, 'initAjaxScripts' );

		// init ajax functions
		$this->loader->add_action( 'wp_ajax_nopriv_yourAjaxFunc', $this->ajaxController, 'yourAjaxFunc' );
		$this->loader->add_action( 'wp_ajax_yourAjaxFunc', $this->ajaxController, 'yourAjaxFunc' );

		// init shortcodes
		$this->loader->add_shortcode( 'mspbMSPluginBoilerplateEntry', $this->publicController, 'entry' );
		$this->loader->add_shortcode( 'mspbMSPluginBoilerplateAdminEntry', $this->adminController, 'adminEntry' );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function defineConstans() {

		// Plugin version
		if ( ! defined( 'MSPB_VERSION' ) ) {
			define( 'MSPB_VERSION', '0.0.1' );
		}

		// Plugin Slug
		if ( ! defined( 'MSPB_SLUG' ) ) {
			define( 'MSPB_SLUG', 'mspb_' );
		}

		// Plugin Folder Path
		if ( ! defined( 'MSPB_PLUGIN_DIR' ) ) {
			define( 'MSPB_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'MSPB_PLUGIN_URL' ) ) {
			define( 'MSPB_PLUGIN_URL', plugin_dir_url( __DIR__ ) );
		}

		// Public Template Folder Path
		if ( ! defined( 'MSPB_PUBLIC_VIEW' ) ) {
			define( 'MSPB_PUBLIC_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/public/' );
		}

		// Admin Templates Folder Path
		if ( ! defined( 'MSPB_ADMIN_VIEW' ) ) {
			define( 'MSPB_ADMIN_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/admin/' );
		}

		// Component Template Folder Path
		if ( ! defined( 'MSPB_COMPONENT_VIEW' ) ) {
			define( 'MSPB_COMPONENT_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/component/' );
		}

		// Form Action Folder Path
		if ( ! defined( 'MSPB_FORM_ACTION' ) ) {
			define( 'MSPB_FORM_ACTION', plugin_dir_path( __DIR__ ) . 'src/actions/' );
		}

		// Plugin Functions Folder Path
		if ( ! defined( 'MSPB_FUNC_DIR' ) ) {
			define( 'MSPB_FUNC_DIR', plugin_dir_path( __DIR__ ) . 'src/plugin-functions/');
		}

		// Assets Folder Path
		if ( ! defined( 'MSPB_ASSETS_DIR' ) ) {
			define( 'MSPB_ASSETS_DIR', plugin_dir_path( __DIR__ ) . 'assets/' );
		}

		// Assets Folder URL
		if ( ! defined( 'MSPB_ASSETS_URL' ) ) {
			define( 'MSPB_ASSETS_URL', plugin_dir_url( __DIR__ ) . 'assets/' );
		}

		// CSS Folder URL
		if ( ! defined( 'MSPB_CSS_URL' ) ) {
			define( 'MSPB_CSS_URL', plugin_dir_url( __DIR__ ) . 'assets/dist/css/' );
		}

		// JavaScript Folder URL
		if ( ! defined( 'MSPB_JS_URL' ) ) {
			define( 'MSPB_JS_URL', plugin_dir_url( __DIR__ ) . 'assets/dist/js/' );
		}

		// Images Folder URL
		if ( ! defined( 'MSPB_IMG_URL' ) ) {
			define( 'MSPB_IMG_URL', plugin_dir_url( __DIR__ ) . 'assets/img/' );
		}

	}

	/**
	 * initialized all action hooks and filters and run the plugin
	 */
	private function run() {
		$this->loader->run();
	}

}
