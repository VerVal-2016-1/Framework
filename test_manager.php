<?php 

require_once dirname(__FILE__).'/src/CommandChecker.php';
    
$checker = new CommandChecker($argv);
$checker->execute_commands();
