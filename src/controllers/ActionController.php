<?php

namespace mspb\controllers;

use mspb\libraries\DB;
use mspb\libraries\ActionHandler;

class ActionController
{

    public function __construct()
    {

    }

    public function makeAnyAction($data)
    {
        $exampleData = array(
            'yourName' => 'John Doe',
            'comment' => 'What an awesome Plugin Boilerplate'
        );

        DB::insert('your_table', $exampleData);

        if (!DB::lastError()) {
            ActionHandler::setStatus('success');
            ActionHandler::setMsg('Your data was successfully saved');
        } else {
            ActionHandler::setStatus('failed');
            ActionHandler::setMsg('Oops, something went wrong');
        }
    }

} 