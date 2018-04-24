<?php

namespace mspb\libraries;

class Database {

	/**
	*
	*/
	private $connection;

	/**
	*
	*/
	public function __construct() {
		global $wpdb;
		$this->connection = $this->connect($wpdb);
	}


	/**
	* 
	*/
	protected function connect($connection) {
		return $connection;
	}

	/**
	*
	*/
	public function select($query, $output = "OBJECT") {

		$select = $this->connection->get_results($query, $output);

		return $select;

	}

	/**
	*
	*/
	public function selectRow($query) {

		$select = $this->connection->get_row($query);

		return $select;

	}

	/**
	*
	*/
	public function lastid() {
		return $this->connection->insert_id;
	}


	/**
	*
	*/
	public function insert($table, $data, $format = null) {

		if($format != null) {
			$this->connection->insert($table, $data, $format);
		} else {
			$this->connection->insert($table, $data);
		}

	}


	/**
	*
	*/
	public function update($table, $data, $where) {
		$this->connection->update($table, $data, $where);
	}


	/**
	*
	*/
	public function delete($table, $where) {
		$this->connection->delete( $table, $where );
	}


	/**
	*
	*/
	public function countRows($table, $where = null) {

		$query = "SELECT COUNT(*) FROM ".$table;

		if($where != null) {
			$query .= " WHERE ".$where;			
		}

		$count = $this->connection->get_var($query);

		return $count;

	}

	/**
	*
	*/
	public function count($query) {
		return $this->connection->get_var($query);
	}


}