<?php

require_once 'Metadata.php';

class RunMetadata extends Metadata{

    const QUANTITY_OF_PARAMS = 1;

    public function __construct(){
        parent::__construct(self::QUANTITY_OF_PARAMS);
    }

    public function help(){
        $help = "\n\tRun Tests command HELP\n";
        $help .= "\nUsage: run <tests_type> \n\n"; 
        echo $help;
        $this->commands_help();
    }

    public function commands_help(){
        $help = "run units                                  Run units test class\n";
        $help .= "run integrations                          Run integrations test class\n";
        $help .= "run all                                   Run all tests\n";

        echo $help;
    }
}
