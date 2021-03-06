<?php

require_once 'Metadata.php';
require_once 'CreateUnitMetadata.php';

class HelpMetadata extends Metadata{

    const QUANTITY_OF_PARAMS = 0;

    public function __construct(){
        parent::__construct(self::QUANTITY_OF_PARAMS);
    }

    public function help(){

        $createUnitMetadata = new CreateUnitMetadata();
        // $createMetadata = new CreateIntegrationMetadata();
        $initMetadata = new InitMetadata();
        $runMetadata = new RunMetadata();

        echo "\n\n\t\t\t TEST MANAGER HELP \n";

        echo "Usage:\n";
        echo "php test_manager.php [target] [arguments]*\n";
        echo "* (optional)\n\n";
        
        echo "| Examples:\n";
        echo "$ php test_manager.php create Book\n";
        echo "$ php test_manager.php -c Book\n\n\n";

        echo "| Available Commands:\n";
        echo "| Command Name                          Command Description\n";
        echo "--------------------------------------------------------------------------------------\n";
        echo "help |-h                                 Prints help information about the test manager\n";
        $createUnitMetadata->commands_help();
        $initMetadata->commands_help();
        $runMetadata->commands_help();
        echo "\n\n";
    }
}