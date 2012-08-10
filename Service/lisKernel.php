<?php

	namespace Service;

	use Interfaces\IService;

	use Service\commandLine;

    class lisKernel implements IService {
    	
		private $commandline;
		private $socket;		
		
		public function __construct($commandline, $socket)
		{
			\EventProxy::addEventsManager("onAppReady");
			
			$this->commandline = $commandline;
			$this->socket = $socket;
			
			$this->commandline->setListenParameters(array(
				"ip" => commandLine::STRING_PARAMETERS,
				"port" => commandLine::INTEGER_PARAMETERS,
			));
		}
		
    	public static function getDependances()
		{
			return array("lis.commandline","lis.socket");
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
			$this->socket
				 ->set($adresseBind,$portBind)
				 ->listen();
		
			\EventProxy::getEventsManager("onAppReady")->notify();
		}
    }
?>