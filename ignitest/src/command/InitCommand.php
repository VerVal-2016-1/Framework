<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/InitMetadata.php';
require_once dirname(__FILE__).'/../command/AvailableCommand.php';

class InitCommand extends Command{

    const PHPUNIT_CONFIG_FILE = "phpunit.xml";
    const PHPUNIT_BOOTSTRAP_FILE = "bootstrap.php";
    const IGNITEST_CONFIG_FILE = "config_ignitest.php";
    const BASE_UNIT_CLASS_FILE = "UnitCaseTest.php";
    const BASE_UNIT_CLASS_FILE = "UnitCaseTest.php";
    const CONFIG_FILE_PATH = "../";

    /* Params order */
    const OVERWRITE_PARAM = 0;

    /* File modes */
    const WRITE = 'w';
    const APPEND = 'a';

    private $valid_param = TRUE;

    // Define here the metadata class to use in this command class
    protected function set_metadata(){
        $this->metadata = new InitMetadata();
    }

    protected function validate_params($params){
        $has_params = !empty($params);
        if($has_params){        
            $overwrite = $params[self::OVERWRITE_PARAM];
            switch ($overwrite) {
                case AvailableCommand::FORCE:
                case AvailableCommand::FORCE_SHORTCUT:
                    break;

                default:
                    $this->valid_param = FALSE;
                    throw new CommandException("UNKNOWN_COMMAND", $overwrite);
                    break;
        }
        
}    }

    public function execute(){  

        $dir_exists = file_exists(self::CONFIG_FILE_PATH); 


        if(!$dir_exists){
            mkdir(self::CONFIG_FILE_PATH, 0755, TRUE);
        }

        $config_file_exists = file_exists(self::CONFIG_FILE_PATH.self::PHPUNIT_CONFIG_FILE); 

        $has_params = !empty($this->params);
        if(!$config_file_exists){
            $this->set_ignite_config();  
        }
        else if($config_file_exists and $has_params){
            $this->set_ignite_config();  
        }
        else if($this->valid_param){
            echo "\nA configuração já foi realizada!\n\n";
            $this->metadata->help();
        }

    }

    private function set_ignite_config(){
        
        echo "Configurando Ignitest....\n";
        $phpunit_created = $this->create_phphunit_config_file();
        $ignitest_created = $this->create_ignitest_config_file();
        $base_created = $this->create_base_classes();
        $bootstrap_created = $this->create_phphunit_bootstrap_file();

        if($bootstrap_created && $phpunit_created && $ignitest_created && $base_created){
            echo "\nConfiguração realizada com sucesso!\n\n";
        }
    }

    private function create_phphunit_bootstrap_file(){

        $template_file_path = dirname(__FILE__)."/../templates/bootstrap_template.php"; 
        $success = copy($template_file_path, self::CONFIG_FILE_PATH.self::PHPUNIT_BOOTSTRAP_FILE);

        return $success;
    }

    private function create_ignitest_config_file(){

        $template_file_path = dirname(__FILE__)."/../templates/config_ignitest_template.php"; 
        $success = copy($template_file_path, self::CONFIG_FILE_PATH.self::IGNITEST_CONFIG_FILE);

        return $success;
    }

    private function create_phphunit_config_file(){

        $file = fopen(self::CONFIG_FILE_PATH.self::PHPUNIT_CONFIG_FILE, self::WRITE);

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

    private function create_base_classes(){

        $template_file_path = dirname(__FILE__)."/../templates/UnitCaseTest_template.php"; 
       
        $dir_exists = file_exists(self::CONFIG_FILE_PATH."unit_tests/");
        
        if(!$dir_exists){
            mkdir(self::CONFIG_FILE_PATH."unit_tests/");
        }
        
        $success = copy($template_file_path, self::CONFIG_FILE_PATH."unit_tests/".self::BASE_UNIT_CLASS_FILE);

        return $success;

    }


}