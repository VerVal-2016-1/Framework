<?php

require_once 'Metadata.php';

class CreateIntegrationMetadata extends CreateMetadata{

    public function __construct(){
        parent::__construct();
    }

    public function help(){
        $help = "\n\tCreate Integration Test command HELP\n";
        $help .= "\nUsage: create_integration <class_name> \n\n"; 
        echo $help;
        $this->commands_help();
    }

    public function commands_help(){
        $help = "create_integration | -it |                         Creates a integration test class\n";
        $help .= "create_integration -force| -f |                  Overwrite a existent integration test class\n";

        echo $help;
    }
}
