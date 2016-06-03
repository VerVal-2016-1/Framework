<?php
define("FILE_NAME_PATTERN", "Test");

/* Positions of argv array */
define("TARGET_POSITION", 1);
define("ARG_POSITION", 2);

/* TARGETS */
# create
define("CREATE", "create");
define("CREATE_SHORTCUT", "-c");

# help
define("HELP", "help");
define("HELP_SHORTCUT", "-h");

/* File modes */
define('WRITE', 'w');

$has_parameter = count($argv) > TARGET_POSITION;

if ($has_parameter){
	
	$target = $argv[TARGET_POSITION];
	
	switch ($target) {
        case CREATE:
		case CREATE_SHORTCUT:
			create($argv);
			break;
		
		case HELP:
		case HELP_SHORTCUT:
			help();
			break;

		default:
			help();
			break;
	}

}

else{

	help();

}

function create($argv){
	
	$has_class_name = count($argv) > ARG_POSITION;
	
	if ($has_class_name){
		
		$class_name = $argv[ARG_POSITION];
		$class_test_name = $class_name.FILE_NAME_PATTERN;
		
		create_file($class_test_name);

	}
	else{
		help();
	}

}

function create_file($file_name){
	
	$file = fopen($file_name.".php", WRITE);

	$content = "<?php\n\n";

    $content .= "require_once('UnitCaseTest');\n";
    
    $content .= "\nclass ".$file_name." extends UnitCaseTest {\n";
	
    $content .= "}";

	fwrite($file, $content);

	fclose($file);

	echo $file_name." successfully created!\n";	
}


function help(){

	echo "\n\n\t\t\t TEST MANAGER HELP \n";

	echo ("Usage:\n");
	echo ("php test_manager.php [target] [arguments]*\n");
	echo ("* (optional)\n\n");
	
	echo ("| Examples:\n");
	echo ("$ php test_manager.php create Book\n");
	echo ("$ php test_manager.php -c Book\n\n\n");

	echo ("| Available Commands:\n");
	echo ("| Command Name                          Command Description\n");
	echo ("--------------------------------------------------------------------------------------\n");
	echo ("create | -c <class under test name>      Creates a class test for given class \n");
	echo ("help |-h                                 Prints help information about the test manager\n");

	echo "\n\n";
} 
