<?php

include "config_ignitest.php";

abstract class IntegrationTestCase extends PHPUnit_Extensions_Database_TestCase{

	static private $pdo = null;
	private $conn = null;

	protected $ci;
    protected $testClass;

    /**
     * @Override
     */
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

	/**
     * @Override
     */
	public function getDataSet(){
		return $this->createMySQLXMLDataSet(DATASET);
	}

	private function classUnderTest($child){
        $className = get_class($child);

        $name = str_replace("Test", "", $className);

        $file_path = $this->search_class_file($name);

        if (!empty($file_path)) {
            require_once $file_path;

            $name = ucfirst($name);
            $this->testClass = new $name();
        }
        else{
            throw new TestException("File could not be found", 0);
        }
    }

    private function search_class_file($class_name){
        $file_path = "";

        $it = new RecursiveDirectoryIterator(CONTROLLERPATH);
        foreach (new RecursiveIteratorIterator($it) as $file) {
            $file_name = $file->getFileName();
            if($file_name == strtolower($class_name).".php" || $file_name == ucfirst($class_name).".php"){
                $file_path = $file->getPathName();
                break; 
            }
        }

        return $file_path;
    }

	public function setUp(){
		parent::setUp();
		$this->classUnderTest($this);
        $this->ci =& get_instance();
	}
}