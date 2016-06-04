<?php

require_once 'Metadata.php';

class CreateMetadata extends Metadata{

    const QUANTITY_OF_PARAMS = 1;

    public function __construct(){
        parent::__construct(self::QUANTITY_OF_PARAMS);
    }

    public function help(){

        $help = "\n\tCreate command HELP\n";
        $help .= "\nUsage: create <class_name> \n"; 
        $help .= "create | -c |  creates a test class\n\n";

        echo $help;
    }
}