<?php 
/**
 * IgniTest - Test framework to integrate PHPUnit and CodeIgniter
 * PHP Version 5
 * @package ignitest
 * @link https://github.com/VerVal-2016-1/Framework The IgniteTest GitHub project
 * @author Italo Paiva (italopaiva) <italo.paiva.b@gmail.com>
 * @author Emilie Morais (emiliemorais) <emilie.morais.t@gmail.com>
 * @author Brenddon Gontijo Furtado <brenddongontijo@msn.com>
 * @author Leonardo ()  <@gmail.com>
 * @copyright 2016 Italo Paiva
 */

require_once dirname(__FILE__).'/src/CommandChecker.php';

$checker = new CommandChecker($argv);
$checker->execute_commands();

