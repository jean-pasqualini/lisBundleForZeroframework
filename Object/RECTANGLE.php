<?php

namespace Object;

use \lib\Object2D;

/**
 Objet 2D primaire : Le rectangle
 * @author Jean pasqualini <jpasqualini75@gmail.com>
 * @license GPL
 * @version InDev
*/
Class RECTANGLE extends Object2D
{
  /**
   Modifie la position et la taille du rectangle
   * @access public
   * @param int $x La position en X
   * @param int $y La position en Y
   * @param int $w La largeur
   * @param int $h La hauteur
   * @return RECTANGLE Retourne l'instance du rectangle
  */
  public function Set($x,$y,$w,$h)
  {
        //On informe de la mise a jour de l'objet
        $this->SetUpdated(true);
        
	// On modifie la position et la taille
        $this->PositionX=$x;
        $this->PositionY=$y;
        $this->Height=$h;
        $this->Width=$w;
	
	// Et on retourne l'instance du rectangle
        return $this;
  }
    
  /**
   Dessine l'objet
   * @access public
  */
  public function DrawnObject()
  {
    // On parametre la couleur de fond
    ApplicationLIS::GetModule("Canvas")->FillStyle($this->Background);
    
    // On désssine le rectangle
    ApplicationLIS::GetModule("Canvas")->FillRect($this->GetAbsolutePositionX(), $this->GetAbsolutePositionY(), $this->Width, $this->Height);
  }
}

?>