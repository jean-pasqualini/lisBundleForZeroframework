<?php

namespace Exceptions;

class LisException extends \Exception
{
    private $Application;

    private $trace;
    
    public function __construct($message, $file = "", $line = "", $trace = "")
    {
        if(!empty($file)) { $this->SetFile($file); }
        if(!empty($line)) { $this->SetLine($line); }
        if(!empty($trace)) { $this->SetTrace($trace); }
		
		$this->Application = \core::GetInstance();
		
        parent::__construct($message,0);
        $this->showError();
    }
    
    public function SetFile($value)
    {
        $this->file = $value;
    }
    
    public function SetLine($value)
    {
        $this->line = $value;
    }
    
    public function SetMessage($value)
    {
        $this->message = $value;
    }
    
    public function SetTrace($value)
    {
        $this->trace = $value;
    }
    
    public function GetPartieCode()
    {
        $retour = "";
        
        $file = fopen($this->getFile(), "r");
        
        if($file)
        {
            $i = 1;
            while(!feof($file))
            {
                $buffer = fgets($file);
                if($i==$this->getLine()) $retour = $buffer;
                $i++;
            }
            
            fclose($file);
        }
        
        return $retour;
    }
    
    public function showError()
    {
 /*
          $information = array(
                                "fichier" => $this->getFile(),
                                "line" => $this->getLine(),
                                "message" => $this->getMessage(),
                                "traces" => $this->getTrace(),
                                "partie_code" => $this->GetPartieCode()
                            );
	*/
	
	$ÎnfoApplication = new \ReflectionObject($this->Application);

	echo "=============================="."\r\n";
	echo get_class($this)." | ".date("d/m/y h:i")." : ".$this->getFile()." (".$this->getLine().") \r\n";
	echo "Message d'erreur : ".$this->getMessage()."\r\n";
	echo "Nom de l'application : ".$ÎnfoApplication->getName()."\r\n";
	echo "Fichier main de l'application : ".$ÎnfoApplication->getFileName()."\r\n";
	//echo "Adresse d'écoute de l'applicaiton : ".$this->Application->getIp().":".$this->Application->getPort()."\r\n";
	//echo "Modules chargées : ".implode(", ", $this->Application->)."\r\n\r\n";
	echo "Partie de code : "."\r\n";
	echo $this->GetPartieCode()."\r\n";
	echo "==============================";
	echo "\r\n\r\n";
	
    }
    
    public static function handleException(Exception $e)
    {
        throw new LisException($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
        exit();
    }
	
	public function getDetailsComment($comment)
	{
		if($comment !== false)
		{
			$expr = "/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/"; 
			
			echo $comment;
			
		}
		else {
			echo "Aucune information";
		}
	}
}


?>