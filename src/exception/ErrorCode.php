<?php

class ErrorCode{

    /** 
      * Error code and message pattern:
      *
      * <error_label> => array(error_code => 'message') as string => array(int => string)
      */

    private static $ERRORS = array(
        "INVALID_QUANTITY_OF_PARAMS" => array(
            1 => "Quantity of a command params must be greater than or equal to 0."
        ),

        "MISSING_ARGUMENT" => array(
            2 => "Missing argument of command. Argument missing number "
        ),
        "UNKNOWN_COMMAND" => array(
            3 => "Unknown command "
        )

        // Add here your errors
    );

    public static function error($error_label){

        $errors = self::$ERRORS;

        if(array_key_exists($error_label, $errors)){
            $error = $errors[$error_label];
            return $error;
        }else{
            throw new Exception("Error label '$error_label' does not exists.");
        }
    }
}