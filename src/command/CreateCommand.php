<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/CreateMetadata.php';

class CreateCommand implements Command{

	const FILE_NAME_PATTERN = "Test";

	/* Positions of argv array */
	const ARG_POSITION = 2;

	/* File modes */
	const WRITE = 'w';

	public function __construct($params){
	}

	// Define here the metadata class to use in this command class
	public static function get_metadata(){
		return new CreateMetadata();
	}

	function create($argv){
	    
	    $has_class_name = count($argv) > self::ARG_POSITION;
	    
	    if ($has_class_name){
	        
	        $class_name = $argv[self::ARG_POSITION];
	        $class_test_name = $class_name.self::FILE_NAME_PATTERN;
	        
	        create_file($class_test_name);

	    }
	    else{
	        help();
	    }

	}

	function create_file($file_name){
	    
	    $file = fopen($file_name.".php", self::WRITE);

	    $content = "<?php\n\n";

	    $content .= "require_once('UnitCaseTest');\n";
	    
	    $content .= "\nclass ".$file_name." extends UnitCaseTest {\n";
	    
	    $content .= "}";

	    fwrite($file, $content);

	    fclose($file);

	    echo $file_name." successfully created!\n"; 
	}

	public function execute(){
		echo "\nExecuting create command...\n";
	}
}