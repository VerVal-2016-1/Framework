<?php

require_once dirname(__FILE__).'/src/CommandChecker.php';

define("TARGET_POSITION", 1);

$has_parameter = count($argv) > TARGET_POSITION;

if ($has_parameter){
    
    $checker = new CommandChecker($argv);
    $checker->execute_commands();
}
else{
    help();
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