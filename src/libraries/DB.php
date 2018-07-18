<?php

namespace mspb\libraries;

class DB 
{

	private static $connection;
	private static $instance;

	private function __construct() 
	{
		global $wpdb;
		self::makeConnection($wpdb);
	}

	/**
	 * @return self
	 */
	public static function instance()
	{
		if (!self::$instance && !self::$instance instanceof DB) {

			self::$instance = new static();
		}

		return self::$instance;
	}

	private function makeConnection($connection)
	{
		self::$connection = $connection;
	}

	public static function select($query, $output = "OBJECT") 
	{
		return self::$connection->get_results($query, $output);
	}

	public static function selectRow($query, $output = "OBJECT")
	{
		return self::$connection->get_row($query, $output);
	}

	public static function lastid()
	{
		return self::$connection->insert_id;
	}

	public static function lastError()
	{
		return self::$connection->last_error;
	}

	public static function insert($table, $data, $format = null)
	{
		if (!is_null($format)) {
			self::$connection->insert($table, $data, $format);
		} else {
			self::$connection->insert($table, $data);
		}
	}

	public static function update($table, $data, $where)
	{
		self::$connection->update($table, $data, $where);
	}

	public static function delete($table, $where)
	{
		self::$connection->delete($table, $where);
	}

	public static function countRows($table, $where = null)
	{
		$query = "SELECT COUNT(*) FROM " . $table;
		if (!is_null($where)) {
			$query .= " WHERE " . $where;
		}
		return self::$connection->get_var($query);
	}

	public static function count($query)
	{
		return self::$connection->get_var($query);
	}

}