<?php

namespace Exceptions;

/**
 * Exception de communication avec le client
 * @author jean pasqualini <jpasqualini75@gmail.com>
 * @version InDev
 * @license GPL
 */
class SocketException extends  LisException {
	
	/**
	 * Le constructeur de l'exeception de communication avec le licent
	 * @access public
	 * @param ApplicationLIS $instance Instance de l'application 
	 * @param string $message Message d'erreur
	 * @return SocketException Instance de l'exeception de comunication avec le client
	 */
	public function __construct($instance, $message)
	{
		parent::__construct($message);
	}
}

?>