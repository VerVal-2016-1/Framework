<?php

require_once dirname(__FILE__).'/command/AvailableCommand.php';
require_once dirname(__FILE__).'/command/CreateUnitCommand.php';
require_once dirname(__FILE__).'/command/HelpCommand.php';
require_once dirname(__FILE__).'/command/InitCommand.php';
require_once dirname(__FILE__).'/command/RunCommand.php';
require_once dirname(__FILE__).'/exception/CommandException.php';
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
			try {
				$command->execute();
			}
			catch (Exception $e) {
				echo $e->getMessage()."\n";
			}
		}
	}

	private function check_commands(){

		$args = $this->args;
    
	    $commands = AvailableCommand::get_available_commands();

	    // cmd is a short name for command
	    $no_args = 0;
	    foreach($commands as $cmd => $shortcut){
	        if(array_key_exists($cmd, $args)){
	            $this->check_command($cmd, $args[$cmd]);
	            $no_args++;
	        }
	        elseif(array_key_exists($shortcut, $args)){
	            $this->check_command($shortcut, $args[$shortcut]);
	            $no_args++;
	        }
	        else{
	            continue;
	        }
	    }

	    if($no_args == 0){
	    	(new HelpCommand($this->argv, 1))->help();
	    }
	}

	private function check_command($cmd, $cmd_index){

		$command = TRUE;
		switch ($cmd){
			case AvailableCommand::CREATE_UNIT:
			case AvailableCommand::CREATE_UNIT_SHORTCUT:
				$command = new CreateUnitCommand($this->argv, $cmd_index);
				break;

			// case AvailableCommand::CREATE_INTEGRATION:
			// case AvailableCommand::CREATE_INTEGRATION_SHORTCUT:
			// 	$command = new CreateIntegrationCommand($this->argv, $cmd_index);
			// 	break;
			
			case AvailableCommand::HELP:
			case AvailableCommand::HELP_SHORTCUT:
				$command = new HelpCommand($this->argv, $cmd_index);
				break;

			case AvailableCommand::INIT:
			case AvailableCommand::INIT_SHORTCUT:
				$command = new InitCommand($this->argv, $cmd_index);
				break;

			case AvailableCommand::RUN:
				$command = new RunCommand($this->argv, $cmd_index);
				break;
					
			default:
				$command = FALSE;
				break;
		}

		// Get the command arguments and then add the command to the queue to be executed
		if($command){
			try{	
				$this->exec_commands[] = $command;
			}catch(CommandException $e){
				echo $e->getMessage();
				echo "\n";
				$cmd_metadata->help();
			}
		}
	}

	private function get_args($argv){

	    // If there are arguments passed on command line
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
	        $args = array();
	    }

	    return $args;
	}
} 