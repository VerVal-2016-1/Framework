<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/InitMetadata.php';

class InitCommand extends Command{

    const PHPUNIT_CONFIG_FILE = "phpunit.xml";
    const CONFIG_FILE_PATH = "application/tests";

    /* Params order */
    const OVERWRITE_PARAM = 0;

    /* File modes */
    const WRITE = 'w';

    // Define here the metadata class to use in this command class
    public static function get_metadata(){
        return new InitMetadata();
    }

    protected function validate_params($params){

    }

    public function execute(){  

        $this->create_phpunit_config_file();

    }

    private function create_phpunit_config_file(){
        
        $dir_exists = file_exists(self::CONFIG_FILE_PATH); 


        if(!$dir_exists){
            mkdir(self::CONFIG_FILE_PATH, 0755, TRUE);
        }

        $config_file_exists = file_exists(self::CONFIG_FILE_PATH."/".self::PHPUNIT_CONFIG_FILE); 

        // $overwrite = $this->params[self::OVERWRITE_PARAM];
        
        // if(!$config_file_exists){
        // }
            $file = fopen(self::CONFIG_FILE_PATH."/".self::PHPUNIT_CONFIG_FILE, self::WRITE);
    

        $content = "<phpunit bootstrap=\"bootstrap.php\"\n";
        $content .= "colors=\"true\"\n"; 
        $content .= "convertErrorsToExceptions=\"true\"\n";
        $content .= "convertNoticesToExceptions=\"true\"\n"; 
        $content .= "convertWarningsToExceptions=\"true\"\n";
        $content .= "processIsolation=\"false\"\n";
        $content .= "stopOnFailure=\"false\"\n"; 
        $content .= "syntaxCheck=\"false\"\n";
        $content .= "verbose=\"true\">\n"; 
        $content .= "</phpunit>\n";

        fwrite($file, $content);

        fclose($file);

    }
}