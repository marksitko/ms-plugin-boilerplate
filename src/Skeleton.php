<?php

namespace wpps;
use wpps\Loader;
use wpps\controllers\PublicController;
use wpps\controllers\AdminController;
use wpps\controllers\AjaxController;

class Skeleton {

	/**
	* 
	*/
	private static $instance;

	/**
	* 
	*/
	private $loader;

	/**
	* 
	*/
	private $publicController;


	/**
	* 
	*/
	public static function instance() {

		if( !self::$instance  && !self::$instance instanceof Skeleton) {

			self::$instance = new static();
			self::$instance->setup();

		}

		return self::$instance;

	}

	/**
	* 
	*/
	private function setup() {
		$this->load_dependencies();
		$this->define_hooks();
		$this->define_constants();
		$this->run();
	}

	/**
	* 
	*/
	private function load_dependencies() {
		$this->loader = new Loader();
		$this->publicController = new PublicController();
		$this->adminController = new AdminController();
		$this->ajaxController = new AjaxController();
	}

	/**
	* definiert alle WordPress action hooks
	*/
	private function define_hooks() {

		// init scripts & styles
		$this->loader->add_action( 'wp_enqueue_scripts', $this->loader, 'init_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->loader, 'init_backend_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->loader, 'init_ajax_scripts' );

		// init ajax functions
		$this->loader->add_action( 'wp_ajax_nopriv_yourAjaxFunc', $this->ajaxController, 'yourAjaxFunc' );
		$this->loader->add_action( 'wp_ajax_yourAjaxFunc', $this->ajaxController, 'yourAjaxFunc' );

		// init shortcodes
		$this->loader->add_shortcode( 'wpSkeletonEntry', $this->publicController, 'entry' );
		$this->loader->add_shortcode( 'wpSkeletonAdminEntry', $this->adminController, 'adminEntry' );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function define_constants() {

		// Plugin version
		if ( ! defined( 'WPPS_VERSION' ) ) {
			define( 'WPPS_VERSION', '0.0.1' );
		}

		// Plugin Slug
		if ( ! defined( 'WPPS_SLUG' ) ) {
			define( 'WPPS_SLUG', 'wpps_' );
		}

		// Plugin Folder Path
		if ( ! defined( 'WPPS_PLUGIN_DIR' ) ) {
			define( 'WPPS_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'WPPS_PLUGIN_URL' ) ) {
			define( 'WPPS_PLUGIN_URL', plugin_dir_url( __DIR__ ) );
		}

		// Public Template Folder Path
		if ( ! defined( 'WPPS_PUBLIC_VIEW' ) ) {
			define( 'WPPS_PUBLIC_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/public/' );
		}

		// Admin Templates Folder Path
		if ( ! defined( 'WPPS_ADMIN_VIEW' ) ) {
			define( 'WPPS_ADMIN_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/admin/' );
		}

		// Component Template Folder Path
		if ( ! defined( 'WPPS_COMPONENT_VIEW' ) ) {
			define( 'WPPS_COMPONENT_VIEW', plugin_dir_path( __DIR__ ) . 'src/views/component/' );
		}

		// Form Action Folder Path
		if ( ! defined( 'WPPS_FORM_ACTION' ) ) {
			define( 'WPPS_FORM_ACTION', plugin_dir_path( __DIR__ ) . 'src/actions/' );
		}

		// Plugin Functions Folder Path
		if ( ! defined( 'WPPS_FUNC_DIR' ) ) {
			define( 'WPPS_FUNC_DIR', plugin_dir_path( __DIR__ ) . 'src/plugin-functions/');
		}

		// Assets Folder Path
		if ( ! defined( 'WPPS_ASSETS_DIR' ) ) {
			define( 'WPPS_ASSETS_DIR', plugin_dir_path( __DIR__ ) . 'assets/' );
		}

		// Assets Folder URL
		if ( ! defined( 'WPPS_ASSETS_URL' ) ) {
			define( 'WPPS_ASSETS_URL', plugin_dir_url( __DIR__ ) . 'assets/' );
		}

		// CSS Folder URL
		if ( ! defined( 'WPPS_CSS_URL' ) ) {
			define( 'WPPS_CSS_URL', plugin_dir_url( __DIR__ ) . 'assets/dist/css/' );
		}

		// JavaScript Folder URL
		if ( ! defined( 'WPPS_JS_URL' ) ) {
			define( 'WPPS_JS_URL', plugin_dir_url( __DIR__ ) . 'assets/dist/js/' );
		}

		// Images Folder URL
		if ( ! defined( 'WPPS_IMG_URL' ) ) {
			define( 'WPPS_IMG_URL', plugin_dir_url( __DIR__ ) . 'assets/img/' );
		}

	}

	/**
	* 
	*/
	private function run() {
		$this->loader->run();
	}

}
