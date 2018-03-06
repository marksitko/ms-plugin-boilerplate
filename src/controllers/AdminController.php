<?php

namespace wpps\controllers;
use wpps\libraries\Controller;

class AdminController extends Controller {

	public function __construct() {

		parent::__construct();

	}

	public function adminEntry() {

		$data = array(
			'say' => 'Welcome to the Admin Entry',
		);
		
		$this->adminView('admin', $data);
	}


} 