<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/HelpMetadata.php';

class HelpCommand extends Command{

    // Define here the metadata class to use in this command class
    public static function get_metadata(){
        return new HelpMetadata();
    }

    public function execute(){  
        self::get_metadata()->help();
    }

    protected function validate_params(){
        // Do nothing in help command
    }
}