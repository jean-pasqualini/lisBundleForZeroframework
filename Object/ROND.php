<?php

namespace Object;

use \lib\Object2D;

/**
  * Objet 2D primaire : Le rond
  * @author Jean pasqualini <jpasqualini75@gmail.com>
  * @license GPL
  * @version InDev
*/
Class ROND extends Object2D {
  
  /**
   * Déssine le rond
   * @access public
  */
  public function DrawnObject()
  {
    // Parametre la couleur de remplisage
    ApplicationLIS::GetModule("Canvas")->FillStyle($this->Background);
    
    // Déssine un arc qui se rejoint pour faire un rond
    ApplicationLIS::GetModule("Canvas")->Arc($this->GetAbsolutePositionX(), $this->GetAbsolutePositionY(),20,0,2*pi());
  }
}

?>