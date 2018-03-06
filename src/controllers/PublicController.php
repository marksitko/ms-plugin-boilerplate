<?php

namespace wpps\controllers;
use wpps\libraries\Controller;

class PublicController extends Controller {

	public function __construct() {

		parent::__construct();

	}

	public function entry() {

		$data = array(
			'say' => 'Hello World',
		);
		
		$this->view('public', $data);
	}

} 