<?php
    /**
     * Auteur : Serghei Diulgherov
     * Date: 04.04.2022
     * Contrôleur principal
     */

    require_once("../resources/config.php");

    class Data {

        //Variables
        private $_dbConnection;

        /**
         * Main constructor
         */
        public function __construct()
        {
            $this -> DBConnection();
        }

        /**
         * Method attempts to establish a connection with a database
         *
         * @return mixed
         */
        public function DBConnection() {

            $this -> _dbConnection = null;
            try
            {
                $this -> _dbConnection = new PDO(
                    "mysql:host=" . $this -> CONFIG['host'] . 
                    ";dbname=" . $this -> CONFIG['dbname'], 
                    $this -> CONFIG['username'], 
                    $this -> CONFIG['password']);
            }
            catch(PDOException $exception)
            {
                echo "Connection error : " . $exception ->getMessage();
            }

            return $this -> _dbConnection;
        }
    }
?>