<?php

namespace Service;

use Interfaces\IService;

class commandLine implements IService {
	
	private $_SERVER;
	private $listenParameters = array();
	private $arguments = array();
	
	CONST STRING_PARAMETERS = 1;
	CONST INTEGER_PARAMETERS = 2;
	
	CONST CONSOLE_FOREGROUND_BLACK = '0;30';
	CONST CONSOLE_FOREGROUND_DARK_GRAY = '1;30';
	CONST CONSOLE_FOREGROUND_BLUE = '0;34';
	CONST CONSOLE_FOREGROUND_LIGHT_BLUE = '1;34';
	CONST CONSOLE_FOREGROUND_GREEN = '0;32';
	CONST CONSOLE_FOREGROUND_LIGHT_GREEN = '1;32';
	CONST CONSOLE_FOREGROUND_CYAN = '0;36';
	CONST CONSOLE_FOREGROUND_LIGHT_CYAN = '1;36';
	CONST CONSOLE_FOREGROUND_RED = '0;31';
	CONST CONSOLE_FOREGROUND_LIGHT_RED = '1;31';
	CONST CONSOLE_FOREGROUND_PURPLE = '0;35';
	CONST CONSOLE_FOREGROUND_LIGHT_PURPLE = '1;35';
	CONST CONSOLE_FOREGROUND_BROWN = '0;33';
	CONST CONSOLE_FOREGROUND_YELLOW = '1;33';
	CONST CONSOLE_FOREGROUND_LIGHT_GRAY = '0;37';
	CONST CONSOLE_FOREGROUND_WHITE = '1;37';
 
	CONST CONSOLE_BACKGROUND_BLACK = '40';
	CONST CONSOLE_BACKGROUND_RED = '41';
	CONST CONSOLE_BACKGROUND_GREEN = '42';
	CONST CONSOLE_BACKGROUND_YELLOW = '43';
	CONST CONSOLE_BACKGROUND_BLUE = '44';
	CONST CONSOLE_BACKGROUND_MAGENTA = '45';
	CONST CONSOLE_BACKGROUND_CYAN = '46';
	CONST CONSOLE_BACKGROUND_LIGHT_GRAY = '47';
	
	public function __construct()
	{
		if(!empty($_SERVER["SERVER_NAME"])) {
			header('Content-Type: text/html; charset=utf-8');
		
			exit("Cette application doit être appelée en ligne de commande.");
		}
		
		\EventProxy::addEventsManager("onCommand");
		
		$this->_SERVER = $_SERVER;
		
		for($i=1; $i<count($this->_SERVER["argv"]); $i++)
		{
			list($name,$value) = explode(":", $this->_SERVER["argv"][$i]);
			
			$this->arguments[$name] = $value;
		}
	}
	
	public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";
 
			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}
 
			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";
 
			return $colored_string;
		}
	
	public function getScriptName()
	{
		return $this->_SERVER["argv"][0];
	}
	
	public function setListenParameters($parameters = array())
	{
		$this->listenParameters = $parameters;
	}
	
	private function getListenParameters()
	{
		return $this->listenParameters;
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
		return $this->arguments;
	}
	
	public function updateOnReady()
	{
		echo "Le systeme est 100% opérationel.";
		
		if(count($this->getArguments()) != count($this->getListenParameters()))
		{
			throw new \Exception("Le nombre d'argument requis n'est pas fourni");
		}
		
		foreach($this->getArguments() as $index => $argument)
		{
			switch($this->getListenParameters()[$index])
			{
				case self::STRING_PARAMETERS:
					if(!is_string($argument))
					{
						throw new \InvalidArgumentException("Le paramete ".$index." avec pour valeur ".$argument." doit être une chaine de caractère");
					}
				break;
					
				case self::INTEGER_PARAMETERS:
					if(!is_numeric($argument))
					{
						throw new \InvalidArgumentException("Le paramete ".$index." avec pour valeur ".$argument." doit être une chaine de caractère");
					}
				break;
			}
		}
		
		call_user_func_array(array(\EventProxy::getEventsManager("onCommand"), "notify"), array_merge(array($this->getScriptName()),$this->getArguments()));
	}
}

?>