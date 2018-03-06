<?php

namespace wpps\models;

class Model {

	/**
	* implement here your SQL-Querys
	* @return string
	*/
	public function getAnyData() {

		$query = "
			        SELECT *
			        FROM YOUR_TABLE 
			        ORDER BY id DESC
			      ";

      	return $query;
      	
	}
	
}
