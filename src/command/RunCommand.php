<?php

require_once 'Command.php';
require_once dirname(__FILE__).'/../metadata/RunMetadata.php';

class RunCommand extends Command{

    const TEST_TYPE_INDEX = 0;

    const UNIT_PARAM = "units";
    const INTEGRATION_PARAM = "integrations";

    private $test_type;

    // Define here the metadata class to use in this command class
    protected function set_metadata(){
        $this->metadata = new RunMetadata();
    }

    protected function validate_params($params){

        $has_params = !empty($params);
        if($has_params){        
            $test_type = $params[self::TEST_TYPE_INDEX];
            switch ($test_type) {
                case self::UNIT_PARAM:
                    $this->test_type = self::UNIT_PARAM;
                    break;

                case self::INTEGRATION_PARAM:
                    $this->test_type = self::INTEGRATION_PARAM;
                    break;

                default:
                    $this->valid_param = FALSE;
                    throw new CommandException("UNKNOWN_COMMAND", $test_type);
                    break;
            }
        }
                
    }

    public function execute(){  

        include '../bootstrap.php';
    
        if($this->test_type == self::UNIT_PARAM){
            $unitspath = APPPATH."tests/unit_tests";
            $dir_exists = file_exists($unitspath);
            if($dir_exists){
                $result = shell_exec("phpunit ".$unitspath);
                echo $result;
                
            }
            else{
                echo "Não existem testes unitários implementados\n";
            }
        }
        else if($this->test_type == self::INTEGRATION_PARAM){
            $integrationspath = APPPATH."tests/integration_tests";
            $dir_exists = file_exists($integrationspath);
            if($dir_exists){
                $result = shell_exec("phpunit ".$integrationspath);
                echo $result;
            }
            else{
                echo "Não existem testes de integração implementados\n";
            }
        }
        else{
            echo "Não foi possível rodar os testes. Tente novamente.";
        }

    }

}