<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/HelpMetadata.php';

class HelpCommand extends Command{

    // Define here the metadata class to use in this command class
    protected function set_metadata(){
        $this->metadata = new HelpMetadata();
    }

    public function execute(){  
        $this->help();
    }

    protected function validate_params($params){
        // Do nothing in help command
    }
}