<?php

namespace mp\controllers;
use mp\libraries\Controller;

class AdminController extends Controller {

	public function __construct() {

		parent::__construct();

	}

	/**
	*
	*/
	public function adminEntry() {
		$this->getTemplate($this);	
	}

	/**
	*
	*/
	public function admin() {

		$data = array(
			'say' => 'Welcome to the Admin Entry',
		);

		$this->adminView('admin', $data);
	}


} 