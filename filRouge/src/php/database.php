<?php

/**
 * 
 * 
 * Auteur : Lucie De Oliveira
 * Date :   18.02.2022
 * Description : Classe qui gère la BD
 */
require_once("config.php");

 class Database {

    private $config;

    // Variable de classe
    private $connector;

    /**
     * Créer un nouvel objet PDO et se connecter à la BD
     */
    public function __construct(){

        // TODO: Se connecter via PDO et utilise la variable de classe $connector
        try
        {
            $this -> config = new Config();
            $this -> connector = new PDO("mysql:host=" .$this->config->getHost() . 
            ";dbname=" . $this->config->getName() . 
            ";charset=" .$this->config->getCharset() , 
            $this->config->getUser(), 
            $this->config->getPwd());
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Permet de préparer et d'exécuter une requête de type simple (sans Where)
     */
    private function querySimpleExecute($query){

        // TODO: permet de préparer et d’exécuter une requête de type simple (sans where)
        if(isset($this->connector))
            return $this->connector ->query($query);
    }

    /**
     * Permet de préparer, de binder et d'exécuter une requête (select avec WHERE ou Insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds = null){
        
        try{
            // TODO: permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
            $req = $this->connector->prepare($query);
            if($binds != null){
                foreach($binds as $key => $value){
                    $req->bindValue($key, $value["value"], $value["type"]);
                }
            }
            
            $req->execute();

            return $req;
        }
        catch(PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Traite les données pour les retourner par exrmple en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req){

        // TODO: traiter les données pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    /**
     * Vide ée jeu de l'enregistrement
     */
    private function unsetData($req){

        // TODO: vider le jeu d’enregistrement
        $req->closeCursor();
    }

    /**
     * Récupère la liste de tous les enseignants de la BD
     */
    public function getAllTeachers(){

        // TODO: récupère la liste de tous les enseignants de la BD
        // TODO: avoir la requête sql
        // TODO: appeler la méthode pour executer la requête
        // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
        // TODO: retour tous les enseignants
        $liste = $this-> queryPrepareExecute('SELECT * FROM t_teacher');
        return $this-> formatData($liste);
    }

    /**
     * Récupère la liste des informations pour 1 enseignant
     */
    public function getOneTeacher($id){

        // TODO: récupère la liste des informations pour 1 enseignant
        // TODO: avoir la requête sql pour 1 enseignant (utilisation de l'id)
        // TODO: appeler la méthode pour executer la requête
        // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
        // TODO: retour l'enseignant

        $binds["varId"] = ["value" => $id, "type" => PDO::PARAM_INT];

        $liste = $this-> queryPrepareExecute("SELECT * FROM t_teacher WHERE idTeacher = :varId", $binds);
        return $this-> formatData($liste);
    }


    // + tous les autres méthodes dont vous aurez besoin pour la suite (insertTeacher ... etc)



    /**
     * Ràcupère le nom de la section d'un prof
     */

    public function getSection($id){
        $binds["varId"] = ["value" => $id, "type" => PDO::PARAM_INT];

        $liste = $this-> queryPrepareExecute("SELECT * FROM t_section WHERE idSection = :varId", $binds);
        return $this->formatData($liste);
    }

     /**
      * Récupère toutes les sections
      */

    public function getAllSection(){
        $liste = $this-> queryPrepareExecute("SELECT * FROM t_section");
        return $this->formatData($liste);
    }

    /**
     * Ajout d'un enseignant en fonction des données entrées par l'utilisateur
     */
    public function addTeacher($fkSection, $fn, $name, $gender, $nickname,$origin ){
        $binds["fn"] = ["value" => $fn, "type" => PDO::PARAM_STR];
        $binds["fname"] = ["value" => $name, "type" => PDO::PARAM_STR];
        $binds["fgender"] = ["value" => $gender, "type" => PDO::PARAM_STR];
        $binds["nickname"] = ["value" => $nickname, "type" => PDO::PARAM_STR];
        $binds["origin"] = ["value" => $origin, "type" => PDO::PARAM_STR];
        $binds["fSection"] = ["value" => $fkSection, "type" => PDO::PARAM_INT];

        return $this->queryPrepareExecute("INSERT INTO t_teacher(idTeacher, teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) VALUES (null, :fn, :fname, :fgender, :nickname, :origin, :fSection)", $binds);
    }


    /**
     * Supprime un enseignant en fonction des données entrées par l'utilisateur
     */
    public function deleteTeacher($fkSection, $fn, $name, $gender, $nickname,$origin ){

        $binds["fn"] = ["value" => $fn, "type" => PDO::PARAM_STR];
        $binds["fname"] = ["value" => $name, "type" => PDO::PARAM_STR];
        $binds["fgender"] = ["value" => $gender, "type" => PDO::PARAM_STR];
        $binds["nickname"] = ["value" => $nickname, "type" => PDO::PARAM_STR];
        $binds["origin"] = ["value" => $origin, "type" => PDO::PARAM_STR];
        $binds["fSection"] = ["value" => $fkSection, "type" => PDO::PARAM_INT];

        foreach ($binds as $key => $value){
            print $key . " " . $value["value"] . "<br>";
        }
    }
    /**
     * Modifie l'enseignant aves les données entrées par l'utilisateur
     */

    public function updateTeacher($fkSection, $fn, $name, $gender, $nickname,$origin, $idTeacher){

        $binds["fn"] = ["value" => $fn, "type" => PDO::PARAM_STR];
        $binds["fname"] = ["value" => $name, "type" => PDO::PARAM_STR];
        $binds["fgender"] = ["value" => $gender, "type" => PDO::PARAM_STR];
        $binds["nickname"] = ["value" => $nickname, "type" => PDO::PARAM_STR];
        $binds["origin"] = ["value" => $origin, "type" => PDO::PARAM_STR];
        $binds["fSection"] = ["value" => $fkSection, "type" => PDO::PARAM_INT];
        $binds["idTeacher"] = ["value" => $idTeacher, "type" => PDO::PARAM_INT];
        
        return $this->queryPrepareExecute("UPDATE `t_teacher` SET `teaFirstname` = :fn, `teaName` = :fname, `teaGender` = :fgender, `teaNickname` = :nickname, `teaOrigine` = :origin, `fkSection` = :fSection WHERE `t_teacher`.`idTeacher` = :idTeacher", $binds);
    }
}
?>