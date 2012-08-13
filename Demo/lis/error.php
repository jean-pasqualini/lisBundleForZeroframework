<?php
/**
 * Gestionaire d'erreur
 * @author internet
 * @license GPL
 * @version InDev
 * @package FrameworkLis
*/

// UN test de modification depuis cloud9ide

//set_exception_handler(array("LisException","handleException"));
//set_error_handler("errorToException");
//register_shutdown_function("FatalerrorToException");

function FatalerrorToException()
{
    $error = error_get_last();
    if($error != null)
    {
        chdir($_SERVER["DOCUMENT_ROOT"]."/");
        
        throw new LisException($error['message'],$error["file"],$error["line"]);
        exit();
    }
}

function errorToException($code, $msg, $file, $line, $context)
{
    throw new LisException($msg, $file, $line);
    exit();
}

?>
