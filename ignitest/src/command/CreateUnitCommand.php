<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/CreateMetadata.php';
require_once dirname(__FILE__).'/../exception/MetadataException.php';

class CreateUnitCommand extends Command{

    const FILE_NAME_PATTERN = "Test";
    const UNIT_TESTS_PATH = "../unit_tests/";
 
    /* Params order */
    const CLASS_NAME_PARAM = 0;
    const OVERWRITE_PARAM = 1;

    /* File modes */
    const WRITE = 'w';

    private $valid_param = TRUE;
    private $has_params = FALSE;

    // Define here the metadata class to use in this command class
    protected function set_metadata(){
        $this->metadata = new CreateUnitMetadata();
    }

    protected function validate_params($params){

        $this->has_params = count($params) > CreateMetadata::MIN_QUANTITY_OF_PARAMS;
        if($this->has_params){        
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
        } 
    }

    public function execute(){  

        $has_class_name = isset($this->params[self::CLASS_NAME_PARAM]);

        if ($has_class_name){


            $class_name = ucfirst($this->params[self::CLASS_NAME_PARAM]);

            
            $class_file = $this->search_class_file($class_name);

            if(!empty($class_file)){
                $class_test_name = $class_name.self::FILE_NAME_PATTERN;
                
                $dir_exists = file_exists(self::UNIT_TESTS_PATH); 

                if(!$dir_exists){
                    mkdir(self::UNIT_TESTS_PATH, 0755, TRUE);
                }

                $file_name = self::UNIT_TESTS_PATH.$class_test_name.".php";

                $test_file_exists = file_exists($file_name); 

                if(!$test_file_exists){

                    echo "\nCreating $class_name test class...\n";
                    $this->create_file($file_name, $class_test_name);

                }
                else if($test_file_exists and $this->has_params){
                    echo "\nOverwriting $class_name test class...\n";
                    $this->create_file($file_name, $class_test_name);

                }
                else if($this->valid_param){
                    echo "\nClasse de Teste já foi criada!\n\n";
                    $this->metadata->help();
                }
            }
            else{
                throw new MetadataException("DOMAIN_CLASS_NOT_FOUND");
            }
        }
    }

    private function create_file($file_name, $class_test_name){

        $file = fopen($file_name, self::WRITE);

        // Writing class name
        $content = "<?php\n\n";

        $content .= "require_once 'UnitCaseTest.php';\n";
        
        $content .= "\nclass ".$class_test_name." extends UnitCaseTest {\n\n";
        
        // Writing the setUp
        $content .= "\tpublic function setUp(){ \n \t\tparent::setUp(); \n \t}\n\n";
        
        $content .= "}";

        fwrite($file, $content);

        fclose($file);

        echo "\n".$class_test_name." successfully created!\n";

    }


    private function search_class_file($class_name){
        // Load the ignitest configuration file
        include "../config_ignitest.php";
        
        $file_path = "";
        $it = new RecursiveDirectoryIterator(DOMAINPATH);
        foreach (new RecursiveIteratorIterator($it) as $file) {
            $file_name = $file->getFileName();
            if($file_name == $class_name.".php"){
                $file_path = $file->getPathName();
                break; 
            }
        }

        return $file_path;
    }
}