<?php
/**
 * Auteur : Serghei Diulgherov
 * Date: 04.04.2022
 * Contrôleur principal
 */

abstract class Database {

    //Variables
    private $_host = "localhost";
    private $_dbName = "db_recipes";
    private $_username = "root";
    private $_password = "root";
    private $_dbConnection;


    /**
     * Method attempts to establish a connection with a database
     *
     * @return mixed
     */
    public function DBConnection() {

        $this -> _dbConnection = null;
        try
        {
            $this -> _dbConnection = new PDO("mysql:host=" . $this -> _host . ";dbname=" . $this -> _dbName, $this -> _username, $this -> _password);
        }
        catch(PDOException $exception)
        {
            echo "Connection error : " . $exception ->getMessage();
        }

        return $this -> _dbConnection;
    }
}