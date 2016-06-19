<?php

require_once dirname(__FILE__).'/../metadata/Metadata.php';
require_once dirname(__FILE__).'/../exception/CommandException.php';

abstract class Command{

    protected $params;
    protected $metadata;

    public function __construct($all_params, $cmd_index){
        $this->set_metadata();

        try{
            $params = $this->metadata->get_command_args($all_params, $cmd_index);
            $this->validate_params($params);
            $this->params = $params;
        }
        catch(CommandException $e){
            echo $e->getMessage();
            echo "\n";
            $this->help();
        }
    }

    protected abstract function set_metadata();
    public abstract function execute();

    /**
     * Validate the params of the command
     * @throws CommandException in case of error in params
     */
    protected abstract function validate_params($params);

    public function help(){
        $this->metadata->help();
    }
}