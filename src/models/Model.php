<?php

namespace mspb\models;

class Model 
{

	/**
	* implement here your SQL-Querys
	* @return string
	*/
	public static function fetchAnyData() {
		$query = "
			        SELECT *
			        FROM YOUR_TABLE 
			        ORDER BY id DESC
			      ";
      	return $query;
	}
	
}
