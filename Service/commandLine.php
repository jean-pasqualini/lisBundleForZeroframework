<?php

namespace Service;

use Interfaces\IService;

class commandLine implements IService {
	
	private $_SERVER;
	
	public function __construct()
	{
		if(!empty($_SERVER["SERVER_NAME"])) {
			header('Content-Type: text/html; charset=utf-8');
		
			exit("Cette application doit être appelée en ligne de commande.");
		}
		
		\EventProxy::addEventsManager("onCommand");
		
		$this->_SERVER = $_SERVER;
	}
	
	public static function getServiceName()
	{
		return "lis.commandline";
	}
	
	public static function isAutoload()
	{
		return true;
	}
	
	public static function getDependances()
	{
		return array();
	}
	
	public static function isReceiveUpdate()
	{
		return true;
	}
	
	public static function getTags()
	{
		return array("event.onReady");
	}
	
	public function getArguments()
	{
		return $this->_SERVER["argv"];
	}
	
	public function updateOnReady()
	{
		echo "Le systeme est 100% opérationel.";
		
		call_user_func_array(array(\EventProxy::getEventsManager("onCommand"), "notify"), $this->getArguments());
	}
}

?>