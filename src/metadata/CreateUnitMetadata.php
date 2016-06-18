<?php

require_once 'Metadata.php';

class CreateUnitMetadata extends CreateMetadata{

    public function __construct(){
        parent::__construct();
    }

    public function help(){
        $help = "\n\tCreate Unit Test command HELP\n";
        $help .= "\nUsage: create_unit <class_name> \n\n"; 
        echo $help;
        $this->commands_help();
    }

    public function commands_help(){
        $help = "create_unit | -ut |                         Creates a unit test class\n";
        $help .= "create_unit -force| -f |                  Overwrite a existent unit test class\n";

        echo $help;
    }
}
