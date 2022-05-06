<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 04.04.2022
 * Contrôleur principal
 */


class Controller 
{
    
    /**
     * Method allowing  to call for an action
     * 
     * @return void
     */
    public function display(){
        $page = $_GET['action'] . "Display";

        $this->$page();
    }
}
?>