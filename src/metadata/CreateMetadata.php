<?php

require_once 'Metadata.php';

class CreateMetadata extends Metadata{

    const MAX_QUANTITY_OF_PARAMS = 2;
    const MIN_QUANTITY_OF_PARAMS = 1;

    public function __construct(){
        parent::__construct(self::MAX_QUANTITY_OF_PARAMS);
    }

    public function help(){

        $help = "\n\tCreate command HELP\n";
        $help .= "\nUsage: create <class_name> \n\n"; 
        echo $help;
        $this->commands_help();
    }

    public function commands_help(){

        $help = "create | -c |                         Creates a test class\n";
        $help .= "create -force| -f |                  Overwrite a existent test class\n";

        echo $help;
    }

    public function get_command_args($all_params, $cmd_index){

        $params = array();

        $quantity_all_params = count($all_params) - 2;

        $correct_quantity_params = $quantity_all_params <= self::MAX_QUANTITY_OF_PARAMS && $quantity_all_params >= self::MIN_QUANTITY_OF_PARAMS;

        if($correct_quantity_params){
            
            for($i=1; $i <= $quantity_all_params; $i++){

                $arg_exists = isset($all_params[$cmd_index + $i]);
                if($arg_exists){
                    $params[] = $all_params[$cmd_index + $i];
                }
                else{
                    throw new CommandException("MISSING_ARGUMENT", $i);
                }
            }
                
        }

        return $params;
    }
}