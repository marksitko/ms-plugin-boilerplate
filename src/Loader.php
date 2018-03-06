<?php

namespace wpps;

class Loader {

	/**
	*
	*/
	protected $actions = array();

	/**
	*
	*/
	protected $filters = array();

	/**
	*
	*/
	protected $shortcodes = array();

	/**
	* fügt ein assoziatives array dem actions array hinzu
	* dient als vorbereitung um es an den WordPress eigenen "add_action" hook zu übergeben und scripte zu inistalisieren
	* @param string $hook enthält den namen des WordPress hooks
	* @param object $obj enthält das Objekt(Klasse) inder die auszuführende callback funktion ist
	* @param string $callback die callback-funktion die auf dem WordPress hook auszuführen ist
	*/
	public function add_action( $hook, $obj, $callback ) {
		$this->actions = $this->add( $this->actions, $hook, $obj, $callback );
	}


	/**
	* fügt ein assoziatives array dem filters array hinzu
	* dient als vorbereitung um es an den WordPress eigenen "add_filter" hook zu übergeben und  zu inistalisieren
	* @param string $hook enthält den namen des WordPress hooks
	* @param object $obj enthält das Objekt(Klasse) inder die auszuführende callback funktion ist
	* @param string $callback die callback-funktion die auf dem WordPress hook auszuführen ist
	*/
	public function add_filter( $hook, $obj, $callback ) {
		$this->filters = $this->add( $this->filters, $hook, $obj, $callback );
	}


	/**
	* fügt ein assoziatives array dem filters array hinzu
	* fügt wordpress shortcodes hinzu
	* @param string $hook enthält den namen des WordPress hooks
	* @param object $obj enthält das Objekt(Klasse) inder die auszuführende callback funktion ist
	* @param string $callback die callback-funktion die auf dem WordPress hook auszuführen ist
	*/
	public function add_shortcode( $hook, $obj, $callback ) {
		$this->shortcodes = $this->add( $this->shortcodes, $hook, $obj, $callback );
	}

	/**
	* erstellt ein mehrdimensionales assoziatives array
	* @param array $hooks das array inder alle vorgesehenen hooks gespeichert werden
	* @param string $hook enthält den namen des WordPress hooks
	* @param object $obj enthält das Objekt(Klasse) inder die auszuführende callback funktion ist
	* @param string $callback die callback-funktion die auf dem WordPress hook auszuführen ist
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
	* initialisiert alle styles und scripts die für das plugin notwending sind
	*/
	public function init_scripts() {
		// EXAMPLE 

		/*
		if( !wp_style_is( 'font-awesome', 'enqueued' ) ) {
			wp_enqueue_style( 'font-awesome', WPPS_CSS_URL . 'font-awesome.min.css?v=' . WPPS_VERSION);
		}

		wp_enqueue_style( WPPS_SLUG . 'style', WPPS_CSS_URL . WPPS_SLUG . 'style.css?v=' . WPPS_VERSION);
		*/
	}

	/**
	* initalisiert styles und scripts für den WP-Backend bereich
	*/
	public function init_backend_scripts() {

		// EXAMPLE 

		/*
		wp_enqueue_script( WPPS_SLUG . 'backend-script', WPPS_JS_URL . WPPS_SLUG . 'backend-script.min.js?v=' . WPPS_VERSION, array('jquery'), '', true);
		*/
	 	

	}

	/**
	* initalisiert ajax scripte
	*/
	public function init_ajax_scripts() {

		// EXAMPLE

		/*
	 	wp_enqueue_script( WPPS_SLUG . 'ajax-script', WPPS_JS_URL . WPPS_SLUG . 'ajax-script.min.js', array('jquery'), '', false);

	 	wp_localize_script( WPPS_SLUG . 'ajax-script', 'YOUR_UNIQUE_AJAX_KEY', array(
    		'ajaxurl' => admin_url( 'admin-ajax.php' ),
    		'your_custom_data' => 'send this data with a ajax request',
    		)
		);
		*/

	}

	/**
	*
	*/
	public function load_plugin_functions() {
		require_once WPPS_FUNC_DIR . 'wpps-functions.php';
	}

	/**
	* durchläuft das actions- und filters array und initalisiert alle add_action und add_filter hooks
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

		$this->load_plugin_functions();

	}

}