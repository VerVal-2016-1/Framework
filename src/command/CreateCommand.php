<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/CreateMetadata.php';

class CreateCommand extends Command{

    const FILE_NAME_PATTERN = "Test";

    /* Params order */
    const CLASS_NAME_PARAM = 0;

    /* File modes */
    const WRITE = 'w';  

    public function __construct($params){
        $this->params = $params;
    }

    // Define here the metadata class to use in this command class
    public static function get_metadata(){
        return new CreateMetadata();
    }

    private function create_file($file_name){
        
        $file = fopen($file_name.".php", self::WRITE);

        $content = "<?php\n\n";

        $content .= "require_once('UnitCaseTest');\n";
        
        $content .= "\nclass ".$file_name." extends UnitCaseTest {\n";
        
        $content .= "}";

        fwrite($file, $content);

        fclose($file);

    }

    public function execute(){  

        $has_class_name = isset($this->params[self::CLASS_NAME_PARAM]);

        if ($has_class_name){

            $class_name = $this->params[self::CLASS_NAME_PARAM];
            $class_test_name = $class_name.self::FILE_NAME_PATTERN;
            
            echo "\nCreating $class_name test class...\n";

            $this->create_file($class_test_name);
            
            echo "\n".$class_test_name." successfully created!\n";
        }
        else{
            self::get_metadata()->help();
        }
    }
}