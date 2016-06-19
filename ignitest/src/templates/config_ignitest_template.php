<?php
/*
 *************************************************************
 Configuration for ignite test
 
 * Content:
 	* Controllers Path
 	* Domains Path
*/


/*************** PATH SETTINGS *****************/

	/****************************************************
	 * This is the CodeIgniter /application folder path.
	 * 
	 * The default configuration of ignitest is placed inside 
	 * application/tests as config_ignitest.php.
	 *
	 * If your config_ignitest.php file is not inside application/tests,
	 * change it to your correct path.
	*****************************************************/
	define("APPPATH", "../../");

	/**
	 * Set here your controllers path
	 */
	$controllersPath = APPPATH."controllers/";
	define("CONTROLLERPATH", $controllersPath);

	/**
	 * Set here your domains path
	 */
	$domainsPath = APPPATH."data_types/";
	define("DOMAINPATH", $domainsPath);

/***********************************************/


/*************** DATABASE SETTINGS ***********************
 * 
 * Set here your database settings for integration tests
 * 
 * In the moment, Ignitest is only working with MySQL.
 *********************************************************/
	define("HOST",  "");
	define("USERNAME", "");
	define("PASSWORD", "");
	define("DATABASE_NAME", "");

	/**************************************************
	 *
	 * Set here the path to your dataset
	 * 
	 * By default, Ignitest use PHPUnit MySQLXML as dataset.
	 * If you want to use a different dataset, you need to implement your own getDataSet function
	 * on your integrations test cases. See the available options on PHPUnit manual:
	 *  https://phpunit.de/manual/current/en/database.html#database.understanding-datasets-and-datatables
	 */
	define("DATASET", "");
