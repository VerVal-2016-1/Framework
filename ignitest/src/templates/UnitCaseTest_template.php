<?php

require_once APPPATH.'/tests/ignitest/src/exception/TestException.php';

abstract class UnitCaseTest extends PHPUnit_Framework_TestCase{

    protected $ci;
    protected $testClass;

    private function classUnderTest($child){
        $className = get_class($child);

        $name = str_replace("Test", "", $className);
        $capitalizeName = ucfirst($name);

        $file_path = $this->search_class_file($capitalizeName);

        if (!empty($file_path)) {
            require_once $file_path;
        }
        else{
            throw new TestException("File could not be found", 0);
        }
    }

    public function search_class_file($class_name){
        $file_path = "";

        $it = new RecursiveDirectoryIterator(DOMAINPATH);
        foreach (new RecursiveIteratorIterator($it) as $file) {
            $file_name = $file->getFileName();
            if($file_name == $class_name.".php"){
                $file_path = $file->getPathName();
                break; 
            }
        }

        return $file_path;
    }
    
    public function setUp() {   

        $this->classUnderTest($this);
        $this->ci =& get_instance();
    }
}
