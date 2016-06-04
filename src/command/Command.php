<?php

require_once dirname(__FILE__).'/../metadata/Metadata.php';

abstract class Command{

	protected $params;

	public abstract function execute();
	public abstract static function get_metadata();
}