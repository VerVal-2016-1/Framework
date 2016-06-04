<?php

require_once dirname(__FILE__).'/../metadata/Metadata.php';

abstract class Command{

    protected $params;

    public function __construct($params){

        $this->validate_params();
        $this->params = $params;
    }

    public abstract function execute();
    public abstract static function get_metadata();

    /**
     * Validate the params of the command
     * @throws CommandException in case of error in params
     */
    protected abstract function validate_params();
}