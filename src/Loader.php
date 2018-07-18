<?php

namespace mspb;

class Loader {

	protected $actions = array();
	protected $filters = array();
	protected $shortcodes = array();

	/**
	 * @param string $hook name of the WordPress hook
	 * @param object $obj class for callable
	 * @param string $callback the callback function
	 */
	public function add_action( $hook, $obj, $callback ) {
		$this->actions = $this->add( $this->actions, $hook, $obj, $callback );
	}


	/**
	 * @param string $hook name of the WordPress hook
	 * @param object $obj class for callable
	 * @param string $callback the callback function
	 */
	public function add_filter( $hook, $obj, $callback ) {
		$this->filters = $this->add( $this->filters, $hook, $obj, $callback );
	}


	/**
	 * @param string $hook name of the WordPress hook
	 * @param object $obj class for callable
	 * @param string $callback the callback function
	 */
	public function add_shortcode( $hook, $obj, $callback ) {
		$this->shortcodes = $this->add( $this->shortcodes, $hook, $obj, $callback );
	}

	/**
	 * @param array $hooks 
	 * @param string $hook name of the WordPress hook
	 * @param object $obj class for callable
	 * @param string $callback the callback function
	 */
	private function add( $hooks, $hook, $obj, $callback ) {

		$hooks[] = array(
			'hook'      => $hook,
			'obj' => $obj,
			'callback'  => $callback
		);

		return $hooks;

	}


	/**
	* initialized all plugin styles and scripts
	*/
	public function initScripts() {

		/*
		if( !wp_style_is( 'font-awesome', 'enqueued' ) ) {
			wp_enqueue_style( 'font-awesome', MSPB_CSS_URL . 'font-awesome.min.css?v=' . MSPB_VERSION);
		}
		*/

		wp_enqueue_style( MSPB_SLUG . 'style', MSPB_CSS_URL . MSPB_SLUG . 'style.css?v=' . MSPB_VERSION);
	}

	/**
	 * initialized all plugin styles and scripts for the WordPress Backend
	 */
	public function initBackendScripts() {

		/*
		wp_enqueue_script( MSPB_SLUG . 'backend-script', MSPB_JS_URL . MSPB_SLUG . 'backend-script.min.js?v=' . MSPB_VERSION, array('jquery'), '', true);
		*/
	 	

	}

	/**
	 * initialized ajax scripts
	 */
	public function initAjaxScripts() {

		/*
	 	wp_enqueue_script( MSPB_SLUG . 'ajax-script', MSPB_JS_URL . MSPB_SLUG . 'ajax-script.min.js', array('jquery'), '', false);

	 	wp_localize_script( MSPB_SLUG . 'ajax-script', 'YOUR_UNIQUE_AJAX_KEY', array(
    		'ajaxurl' => admin_url( 'admin-ajax.php' ),
    		'your_custom_data' => 'send this data with a ajax request',
    		)
		);
		*/

	}

	public function loadPluginFunctions() {
		require_once MSPB_FUNC_DIR . 'mspb-functions.php';
	}

	/**
	 * initialized all action hooks and filters
	 */
	public function run() {

		foreach ($this->actions as $hook) {
			add_action( $hook['hook'], array( $hook['obj'], $hook['callback'] ) );
		}

		foreach ($this->filters as $hook) {
			add_filter( $hook['hook'], array( $hook['obj'], $hook['callback'] ) );
		}

		foreach ($this->shortcodes as $hook) {
			add_shortcode( $hook['hook'], array( $hook['obj'], $hook['callback'] ) );
		}

		$this->loadPluginFunctions();

	}

}