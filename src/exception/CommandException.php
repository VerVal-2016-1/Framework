<?php

require_once 'ErrorCode.php';

class CommandException extends Exception{
    
    public function __construct($error_label, $arg_number=-1){

        try{

            $error = ErrorCode::error($error_label);
            foreach ($error as $code => $msg){
                // There is only one error registry
                // Foreach used to get the key
                $message = $msg;
                $error_code = $code;
                break;
            }

            if($arg_number !== -1){
                $message .= $arg_number.".";
            }

            parent::__construct($message, $error_code);

        }catch(Exception $e){
            // In this case the error was not found on ErrorCode class

            echo $e->getMessage()."\n";
            echo $e->getTraceAsString();
            echo "\nTip: Check if the label '$error_label' is registered on ErrorCode class.";

            exit;
        }
    }
}