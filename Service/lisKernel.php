<?php

	namespace Service;

	use Interfaces\IService;

    class lisKernel implements IService {
    	
		public function __construct()
		{
			\EventProxy::addEventsManager("onAppReady");
		}
		
    	public static function getDependances()
		{
			return array("lis.commandline");
		}
		
		public static function getTags()
		{
			return array("event.onCommand");
		}
		
		public static function getServiceName()
		{
			return "lis.kernel";
		}
		
		public static function isReceiveUpdate()
		{
			return true;
		}
		
		public static function isAutoload()
		{
			return true;
		}
		
		public function updateOnCommand($eventName, $scriptName, $adresseBind, $portBind)
		{
			\EventProxy::getEventsManager("onAppReady")->notify();
		}
    }
?>