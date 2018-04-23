<?php

namespace mspb\libraries;
use mspb\libraries\Database;
use mspb\models\Model;

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
	public $urlParam;

	/**
	*
	*/
	public function __construct() {
		$this->db = new Database();
		$this->model = new Model();
		$this->urlParam = $_GET["site"];
	}

	/**
	*
	*/
	public function view($template, $data = array()) {
		$this->lock_template( MSPB_PUBLIC_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function adminView($template, $data = array()) {
		$this->lock_template( MSPB_ADMIN_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function component($template, $data = array()) {
		$this->lock_template( MSPB_COMPONENT_VIEW, $template, $data );
	}

	/**
	*
	*/
	public function action($template, $data = array()) {
		$this->lock_template( MSPB_FORM_ACTION, $template, $data );
	}

	/**
	*
	*/
	public function getTemplate($class) {

		$param = $this->getUrlParam();

		if(method_exists( $class, $param ) ) {
			$class->$param();
		} else {
			$this->couldnt_found_template();
		}

	}

	/**
	*
	*/
	public function lock_template( $dir, $template, $data = array() )  {
		if( file_exists( $dir . $template . ".php" ) ) {
			include $dir . $template . ".php";
		} else {
			$this->couldnt_found_template();
		}
	}

	/**
	*
	*/
	public function getUrlParam() {
		if( !isset($this->urlParam) ) {
			$this->urlParam = 'admin';
		} 
		return $this->urlParam;
	}

	/**
	*
	*/
	private function couldnt_found_template() {
		die('View not exist');
	}

}