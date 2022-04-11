<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 04.04.2022
 * Contrôleur principal
 */
require_once('../data/data.php');
class Controller 
{
    //Variables
    private $_dataHandler;
    
    public function InitiateData()
    {
        $_dataHandler = new Data();
    }
}
?>