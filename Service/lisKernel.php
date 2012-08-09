<?php

	namespace Service;

	use Interfaces\IService;

	use Service\commandLine;

    class lisKernel implements IService {
    	
		public function __construct($commandline)
		{
			\EventProxy::addEventsManager("onAppReady");
			
			$commandline->setListenParameters(array(
				"ip" => commandLine::STRING_PARAMETERS,
				"port" => commandLine::INTEGER_PARAMETERS,
			));
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