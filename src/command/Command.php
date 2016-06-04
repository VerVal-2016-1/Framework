<?php

require_once dirname(__FILE__).'/../metadata/Metadata.php';

interface Command{

	public function execute();
	public static function get_metadata();
}