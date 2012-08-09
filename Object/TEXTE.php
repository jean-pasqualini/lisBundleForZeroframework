<?php 
namespace Object;

use \lib\Object2D;

/**
 Objet 2D : Un texte
 * @author Jean pasqualini <jpasqualini75@gmail.com>
 * @license GPL
 * @version InDev
*/
Class TEXTE extends Object2D
{
  /**
   * @access private
   * @var string Contenu du texte
  */
  private $text;
  
  /**
   * @access private
   * @var int La taille du texte en pixel
  */
  private $size;
  
  /**
   * @access private
   * @var string La police du texte
  */
  private $font;
  
  /**
   * @access public
   * @staticvar string Le type de retour a la ligne
  */
  const ReturnLine = "\r\n";
  
  /**
   * Modifie la taille du texte
   * @access public
   * @param int $value La taille du texte en pixel
   * @return TEXTE Retourne l'instance du texte
  */
  public function SetSize($value)
  {
    $this->size = $value;
    return $this;
  }
  
  /**
   * Modifie la police du texte
   * @access public
   * @param string $value La police du texte
   * @return TEXTE Retourne l'instance du texte
  */
  public function SetFont($value)
  {
    $this->font = $value;
    return $this;
  }
  
  /**
   * Modifie le contenu du texte
   * @access public
   * @param string $text Le contenu du texte
   * @return TEXTE Retourne l'instance du texte
  */
  public function SetText($text)
  {
    $this->text = $text;
    return $this;
  }
  
  /**
   * Ajoute du contenu au contenu courant
   * @access public
   * @param string $text Le contenu à ajouter
   * @return TEXTE Retourne l'instance du texte
  */
  public function AddText($text)
  {
	$this->text .= $text;
	return $this;
  }
  
  /**
   * Ajoute une ligne de texte au contenu courant
   * @access public
   * @param stirng $text Le contenu de la ligne de texte à ajouter
   * @return TEXTE Retourne l'instance du texte
  */
  public function AddTextL($text)
  {
	// Ajoute le texte plus un retour à la ligne
	return $this->AddText($text.TEXTE::ReturnLine);
  }
  
  /**
   * Modifie la position du texte
   * @access public
   * @param int $x La position en X du texte
   * @param int $y La position en Y du texte
   * @return TEXTE Retourne l'instance du texte
  */
  public function Set($x,$y)
  {
    //On informe de la mise a jour de l'objet
    $this->SetUpdated(true);
        
	// On modifie la position
        $this->PositionX=$x;
        $this->PositionY=$y;
        
	// On retourne l'instance du texte
        return $this;
  }
  
  /**
    * Déssine le texte
    * @access public
  */
  public function DrawnObject()
  {
    // On parametre la police
    ApplicationLIS::GetModule("Canvas")->SetFont($this->size,$this->font);
    
    // On écrit le contenu du texte à la position don,ée
    ApplicationLIS::GetModule("Canvas")->TextFill($this->text,$this->GetAbsolutePositionX(),$this->GetAbsolutePositionY());
  }
}


?>