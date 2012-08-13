<?php

namespace Service;

use \Exceptions\SocketException;

use Interfaces\IService;

class socket implements IService {
		
	private $adresse;
	private $port;
	private $socket_server; 
	private $socket_client;
	
	public function __construct()
	{   
	    //On crée la socket
	    if(($this->socket_server = \socket_create(AF_INET, SOCK_STREAM, 0)) === false)
	    {
		    // Si elle ne se charge pas alors on affiche une erreur indiquant que la socket n'a pas pu étre crée
		    throw new SocketException($this->socket_server, 'La création de la socket a échoué : '.socket_strerror($socket)."\n<br />");
	    }

	}
	
	public function set($adresse, $port)
	{
		$this->adresse = $adresse;
		$this->port = $port;
		
		return $this;
	}
	
	public function getAdresse()
	{
		return $this->adresse;
	}
	
	public function getPort()
	{
		return $this->port;
	}

	public function bind($adresse = null, $port = null)
	{
		if(empty($adresse)) $adresse = $this->getAdresse();
		if(empty($port)) $port = $this->getPort();
		
		//On assigne la socket é une adresse et é un port, que l'on va écouter par la suite.
	    if(($assignation = socket_bind($this->socket_server, $adresse, $port)) < 0)
	    {
		    // Si elle ne s'assigne pas alors on affiche une erreur indiquant que l'assignation é échoué
		    throw new SocketException($this->socket_server, "L'assignation de la socket a échoué : ".socket_strerror($assignation)."\n<br />");
	    }
	}
	
	public function listen()
	{
				        
	    //On prépare l'écoute.
	    if(($ecoute = socket_listen($this->socket_server)) === false)
	    {
		    throw new SocketException($this->socket_server, "L'écoute de la socket a échoué : ".socket_strerror($ecoute)."\n<br />");
		  
		  // Si le client n'a pas pu se connecter alors...
	          if(($this->socket_client = socket_accept($this->socket_server)) === false)
	          {
		    // On affiche un message d'information pour dire que le client n'a pas pu se connecter
	            throw new SocketException($this->socket_client, "Le client n'a pas pu se connecter : ".socket_strerror($client)."\n<br />");
	            
	            $this->disconnect();
	            
	            return false;
	          }
	          
		  // On strocke la ressource socket cliente dans la propriété $instance

	            /**
		      On declare que les handle de reception de traitement évenementiel
		      seront appelée tous 5 appel d'instruction php (tick)
		      
		      Cela permet de faire une sorte de setInterval pour ceux qui connaisse javascript
		      Cette fonction est désormait depreaced et c'est bien domage
		    */
		    	    
		    declare(ticks=5);
		    register_tick_function(array(&$this, 'handle_event'), true);
		    register_tick_function(array(&$this, 'handle_recv'), true);  
	          
	            return true;
		}
		else 
		{
			throw new SocketException($socket, "Aucune client ne s'est rattaché à l'application");
		}
	}
		
	public static function getServiceName()
	{
		return "lis.socket";
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
		return array();
	}
	
	public function recv()
	{
		
	}
	
	public function send($data = array())
	{
		
	}
}

?>