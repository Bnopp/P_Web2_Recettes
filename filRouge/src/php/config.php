<?php

/**
 * 
 * 
 * Auteur : Lucie De Oliveira
 * Date :   18.02.2022
 * Description : Classe qui contient les données d'accèes de la BD
 */

class Config{
    private $host = "localhost";
    private $name = "db_nickname_pu06rkz";
    private $charset = "utf8";
    private $user = "dbUser_pu06rkz";
    private $pwd = ".Etml-";
    /*private $user = "root";
    private $pwd = "root";*/

    public function getHost(){
        return $this->host;
    }

    public function getName(){
        return $this->name;
    }

    public function getCharset(){
        return $this->charset;
    }

    public function getUser(){
        return $this->user;
    }

    public function getPwd(){
        return $this->pwd;
    }
}
 ?>