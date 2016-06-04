<?php

require_once dirname(__FILE__).'/command/AvailableCommand.php';
require_once dirname(__FILE__).'/command/CreateCommand.php';
require_once dirname(__FILE__).'/metadata/Metadata.php';

class CommandChecker{
	
	/**
	 * An array with the arguments passed through the terminal
	 * This array is the array that comes from PHP
	 * Pattern: $argv = array(0 => "file_name", 1 => "arg1", 2 => "arg2", ...);
	 */
	private $argv;

	/**
	 * This array is an associative array with the arguments 
	 *    passed as keys and the index on $argv array as values
	 * Pattern: $args = array("arg1" => 1, "arg2" => 2)
	 */
	private $args;

	// Commands to execute
	private $exec_commands = array();

	public function __construct($argv){
		$this->argv = $argv;
		$this->args = $this->get_args($argv);
		$this->check_commands();
	}

	public function execute_commands(){

		$commands = $this->exec_commands;
		foreach($commands as $command){
			$command->execute();
		}
	}

	private function check_commands(){

		$args = $this->args;
    
	    $commands = AvailableCommand::get_available_commands();

	    // cmd is a short name for command
	    foreach($commands as $cmd => $shortcut){
	        if(array_key_exists($cmd, $args)){
	            $this->check_command($cmd, $args[$cmd]);
	        }
	        elseif(array_key_exists($shortcut, $args)){
	            $this->check_command($shortcut, $args[$shortcut]);
	        }
	        else{
	            continue;
	        }
	    }
	}

	private function check_command($cmd, $cmd_index){
		switch ($cmd){
			case AvailableCommand::CREATE:
			case AvailableCommand::CREATE_SHORTCUT:
				$cmd_metadata = CreateCommand::get_metadata();
				$params = $this->get_command_args($cmd_metadata, $cmd_index);
				$command = new CreateCommand($params);
				break;
			
			case AvailableCommand::HELP:
			case AvailableCommand::HELP_SHORTCUT:
				// $command = new HelpCommand();
				break;

			default:
				$command = FALSE;
				break;
		}

		// Add the command to the queue to be executed
		if($command !== FALSE){
			$this->exec_commands[] = $command;
		}
	}

	private function get_command_args(Metadata $metadata, $cmd_index){

		$params_quantity = $metadata->get_params_num();

		$params = array();

		// Check if there is this much of arguments in argv array
		$thereAreArgs = count($this->argv) > ($cmd_index + $params_quantity);
		if($thereAreArgs){
			for($i=1; $i <= $params_quantity; $i++){
				$params[] = $this->argv[$cmd_index + $i];
			}
		}

		return $params;
	}

	private function get_args($argv){

	    // If there arguments passed on command line
	    if(count($argv) > 1){
	        // Create an array with the args as keys
	        $args = array();
	        foreach ($argv as $index => $value){
	            // The index=0 is the file name, and it is not important to this args array
	            if($index !== 0){
	                $args[$value] = $index;
	            }
	        }
	    }else{
	        $args = NULL;
	    }

	    return $args;
	}
} 