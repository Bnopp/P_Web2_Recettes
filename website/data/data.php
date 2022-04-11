<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 04.04.2022
 * Group of methods allowing the connexion and retrieval of data from a database
 */

/**
 * Modified by  : Serghei Diulgherov
 * Date         : 04.04.2022
 * Modifications:
 *      Added   - __construct
 *              - DBConnection
 */

/**
 * Modified by  : Serghei Diulgherov
 * Date         : 11.04.2022
 * Modifications:
 *      Added   - querySimpleExecute
 *              - queryPrepareExecute
 *              - formatData
 *              - unsetData
 */

//To DO

require_once("../resources/config.php");

class Data 
{
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
     * @return PDO_Connection
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

    /**
     * Method prepares executes a simple request (no variables) to the database (ex. no WHERE)
     * 
     * @param $query    => the SQL statement to prepare and execute
     * 
     * @return mixed    => mysqli|false
     */
    public function querySimpleExecute($query){

        try
        {
            if(isset($this->_dbConnection))
            return $this->_dbConnection ->query($query);
        }
        catch(PDOException $e)
        {
            die('Request error : ' . $e->getMessage());
        }
    }

    /**
     * Method allows to prepare, bind and execute a request (SELECT with WHERE, INSERT, UPDATE, DELETE)
     * 
     * @param $query    => the SQL statement to prepare and execute
     * @param $binds    => SQL placeholders
     * 
     * @return mixed    => PDOStatement|PDOException
     */
    public function queryPrepareExecute($query, $binds = null){
        try
        {
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
            die('Request error : ' . $e->getMessage());
        }
    }

    /**
     * Method formats data from the request in an array
     * 
     * @param $req      => PDOStatement to format to an array
     * 
     * @return array
     */
    public function formatData($req)
    {
        $results = $req -> fetchALL(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Method closes the cursor so the statement can be executed again
     * 
     * @param $req      => PDOStatement to format to an array
     * 
     * @return bool
     */
    public function unsetData($req)
    {
        return $req -> closeCursor();
    }
}
?>