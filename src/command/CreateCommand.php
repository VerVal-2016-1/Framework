<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/CreateMetadata.php';

class CreateCommand extends Command{

    const FILE_NAME_PATTERN = "Test";

    /* Params order */
    const CLASS_NAME_PARAM = 0;

    /* File modes */
    const WRITE = 'w';

    // Define here the metadata class to use in this command class
    protected function set_metadata(){
        $this->metadata = new CreateMetadata();   
    }

    protected function validate_params($params){

    }

    public function execute(){  

        $has_class_name = isset($this->params[self::CLASS_NAME_PARAM]);

        if ($has_class_name){

            $class_name = ucfirst($this->params[self::CLASS_NAME_PARAM]);

            $class_test_name = $class_name.self::FILE_NAME_PATTERN;
            
            echo "\nCreating $class_name test class...\n";

            $this->create_file($class_test_name);
            
            echo "\n".$class_test_name." successfully created!\n";
        }
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
}