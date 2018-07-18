<?php

namespace mspb\controllers;
use mspb\libraries\Controller;
use mspb\libraries\ActionHandler;
use mspb\models\Model;
use mspb\helpers\Utilities;
use mspb\helpers\Guard;
use mspb\controllers\ActionController;

class AdminController extends Controller 
{

	public $actionController;

	public function __construct() 
	{
		parent::__construct();
		$this->actionController = new ActionController();
	}

	public function adminEntry() 
	{
		if (Guard::isAuthenticated()) {
			$this->loadMethodByUrlParam($this);
		} else {
			Guard::goHome();
		}
	}

	public function admin() 
	{
		$data = array(
			'say' => 'Welcome to the Admin Entry',
		);

		$this->adminView('admin', $data);
	}

	public function exampleFormSubmit()
	{
		if (Utilities::isPostRequest()) {
			$_POST = Utilities::sanitizePost();
			$this->actionController->makeAnyAction($_POST);
			$actionNotification = ActionHandler::getNotification();
		}

		$data = array(
			'title' => 'Example form submit',
			'actionNotification' => $actionNotification,
		);

		$this->adminView('example-form-submit', $data);
	}


} 