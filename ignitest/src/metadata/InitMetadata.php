<?php

require_once 'Metadata.php';

class InitMetadata extends Metadata{

    const MAX_QUANTITY_OF_PARAMS = 1;

    public function __construct(){
        parent::__construct(self::MAX_QUANTITY_OF_PARAMS);
    }

    public function help(){

        $help = "\n\tInit command HELP\n";
        $help .= "\nUsage: init \n\n"; 
        echo $help;
        $this->commands_help();
    }

    public function commands_help(){

        $help = "init | -i                                 Initialize default configuration\n";
        $help .= "init -force|init -f                      Overwrite configuration files if they exist\n";

        echo $help;
    }

    public function get_command_args($all_params, $cmd_index){

        $params = array();
        $params_quantity = $this->get_params_num();

        $quantity_all_params = count($all_params) - 2;

        if($quantity_all_params == self::MAX_QUANTITY_OF_PARAMS){
            
            for($i=1; $i <= $params_quantity; $i++){

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