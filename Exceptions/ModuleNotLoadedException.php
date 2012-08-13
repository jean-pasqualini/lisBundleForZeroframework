<?php

namespace Exceptions;

/**
 * Exception de module non chargé
 * @author jean pasqualini <jpasqualini75@gmail.com>
 * @version InDev
 * @license GPL
 */
class ModuleNotLoadedException extends LisException {
	
	private $instanceModule;
	
	/**
	 * Le constructeur de l'exeception de module non chargé
	 * @access public
	 * @param ApplicationLIS $instance Instance de l'application 
	 * @param string $message Message d'erreur
	 * @return SocketException Instance de l'exeception de module non chargé
	 */
	public function __construct($file, $instance, $message)
	{
		$this->instanceModule = $instance;
		if(file_exists("module/".$file.".php")) $this->setFile("module/".$file.".php");
		parent::__construct($message);
	}
}

?>