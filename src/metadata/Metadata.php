<?php

require_once dirname(__FILE__).'/../exception/MetadataException.php';

abstract class Metadata{

    protected $params_num;
    protected $params;

    public function __construct($params_num){
        $this->set_params_num($params_num);
    }

    /**
     * All metadata classes must implement it's own help command
     */
    public abstract function help();

    /**
     * Set the quantity of params of the commmand
     * @param $quantity_of_params - The quantity to set
     * @throws Exception when the quantity of params is less than one
     */
    private function set_params_num($quantity_of_params){

        // A command must have none or more params 
        if($quantity_of_params >= 0){
            $this->params_num = $quantity_of_params;
        }
        else{
            throw new MetadataException("INVALID_QUANTITY_OF_PARAMS");
        }
    }

    public function get_params_num(){
        return  $this->params_num;
    }
}