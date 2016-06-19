<?php

include "config_ignitest.php";

abstract class IntegrationTestCase extends PHPUnit_Extensions_Database_TestCase{

	static private $pdo = null;

	private $conn = null;

	final public function getConnection(){
		if ($this->conn === null) {
			if (self::$pdo == null) {
				$pdo_data = "mysql:dbname=".DATABASE_NAME.";host=".HOST;
				self::$pdo = new PDO($pdo_data, USERNAME, PASSWORD);
			}

			$this->conn = $this->createDefaultDBConnection(self::$pdo, DATABASE_NAME);
		}
		return $this->conn;
	}

	public function getDataSet(){
		return $this->createMySQLXMLDataSet(DATASET);
	}
}