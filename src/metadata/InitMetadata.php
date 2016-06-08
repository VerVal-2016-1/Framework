<?php

require_once 'Metadata.php';

class InitMetadata extends Metadata{

    const QUANTITY_OF_PARAMS = 0;

    public function __construct(){
        parent::__construct(self::QUANTITY_OF_PARAMS);
    }

    public function help(){

        $help = "\n\tInit command HELP\n";
        $help .= "\nUsage: init \n"; 
        $help .= "init | -i |  Initialize default configuration\n\n";
        $help .= "init -f| -i -f|  Overwrite configuration file if it exists\n\n";

        echo $help;
    }
}