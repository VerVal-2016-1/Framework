<?php

class AvailableCommand{

	// Create command
	const CREATE = "create";
	const CREATE_SHORTCUT = "-c";

	// Help command
	const HELP = "help";
	const HELP_SHORTCUT = "-h";

    // Init command
    const INIT = "init";
    const INIT_SHORTCUT = "-i";

    // Force command - Depends of previous command 
    const FORCE = "-force";
    const FORCE_SHORTCUT = "-f";
	
    // Pattern: command => shortcut
    private static $AVAILABLE_COMMANDS = array(
        self::CREATE => self::CREATE_SHORTCUT,
        self::HELP => self::HELP_SHORTCUT,   
        self::INIT => self::INIT_SHORTCUT,
        self::FORCE => self::FORCE_SHORTCUT	

        // Add new commands here and implement its metadata and command classes
    );

    public static function get_available_commands(){
    	return self::$AVAILABLE_COMMANDS;
    }
}