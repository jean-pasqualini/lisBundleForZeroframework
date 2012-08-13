<?php

namespace Exceptions;

/**
 * Exception de parse des fichier css
 * @author jean pasqualini <jpasqualini75@gmail.com>
 * @version InDev
 * @license GPL
 */
class CssParseException extends LisException {
	
	/**
	 * Le constructeur de l'execption de parse des fichiers css
	 * @access public
	 * @param CssParseur $instance Instance du parseur css 
	 * @param string $message Message d'erreur
	 * @return CssParseException Instance de l'execoption de parse des fichier css
	 */
	public function __construct($instance, $message)
	{
		$this->SetFile($instance->getFile());
		$this->SetLine($instance->getLine());
		
		parent::__construct($message);
	}
}

?>