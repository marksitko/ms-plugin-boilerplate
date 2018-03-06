<?php

namespace wpps\libraries;
use wpps\libraries\Database;
use wpps\models\Model;

class Controller {

	/**
	*
	*/
	public $db;

	/**
	*
	*/
	public $model;

	/**
	*
	*/
	public function __construct() {
		$this->db = new Database();
		$this->model = new Model();
	}

	/**
	*
	*/
	public function view($template, $data = array()) {
		$this->lock_template( WPPS_PUBLIC_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function adminView($template, $data = array()) {
		$this->lock_template( WPPS_ADMIN_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function component($template, $data = array()) {
		$this->lock_template( WPPS_COMPONENT_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function action($template, $data = array()) {
		$this->lock_template( WPPS_FORM_ACTION, $template, $data );
	}

	/**
	*
	*/
	public function lock_template( $dir, $template, $data = array() )  {
		if( file_exists( $dir . $template . ".php" ) ) {
			include $dir . $template . ".php";
		} else {
			die('View not exist');
		}
	}

}