<?php

namespace mspb\controllers;
use mspb\libraries\Controller;
use mspb\models\Model;

class PublicController extends Controller 
{

	public function __construct() 
	{
		parent::__construct();
	}

	public function entry() 
	{
		$data = array(
			'say' => 'Hello World',
		);
		
		$this->view('public', $data);
	}

} 