<?php

namespace mspb\libraries;
use mspb\libraries\DB;

class Controller {

	public $db;
	public $urlParam;

	public function __construct() 
	{
		$this->db = DB::instance();
		$this->urlParam = $_GET["site"];
	}

	public function view($template, $data = array()) {
		$this->lock_template( MSPB_PUBLIC_VIEW, $template, $data );
	}

	public function adminView($template, $data = array()) {
		$this->lock_template( MSPB_ADMIN_VIEW, $template, $data );
	}

	public function component($template, $data = array()) {
		$this->lock_template( MSPB_COMPONENT_VIEW, $template, $data );
	}

	public function action($template, $data = array()) {
		$this->lock_template( MSPB_FORM_ACTION, $template, $data );
	}

	public function getTemplate($class)
	{
		$param = $this->getUrlParam();

		if(method_exists( $class, $param ) ) {
			$class->$param();
		} else {
			$this->couldnt_found_template();
		}
	}

	public function lock_template( $dir, $template, $data = array() )  
	{
		if( file_exists( $dir . $template . ".php" ) ) {
			include $dir . $template . ".php";
		} else {
			$this->couldnt_found_template();
		}
	}

	public function getUrlParam() 
	{
		if( !isset($this->urlParam) ) {
			$this->urlParam = 'admin';
		} 
		return $this->urlParam;
	}

	public function loadMethodByUrlParam($class)
	{
		$method = $this->createMethodName();
		if (method_exists($class, $method)) {
			$class->$method();
		} else {
			die('Method does not exist');
		}
	}

	private function couldnt_found_template() {
		die('View does not exist');
	}

	private function createMethodName()
	{
		$method = $this->getUrlParam();
		$method = preg_split('/[-_]/', $method);
		$method = array_map(function ($m) {
			return ucwords($m);
		}, $method);
		$method[0] = strtolower($method[0]);
		return implode('', $method);
	}

}