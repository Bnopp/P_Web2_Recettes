<?php
/**
 * ETML
 * Auteur : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the users
 */

include_once 'Entity.php';

require_once 'data/data.php';

class UserRepository implements Entity 
{
    private $_pdoConnection;

    /**
     * Main constructor
     */
    public function __construct()
    {
        $this -> _pdoConnection = Data::getConn();
    }

    /**
     * It returns all the data from the table t_user.
     * 
     * @return array of objects.
     */
    public function getAll() 
    {
        $data = $this -> _pdoConnection -> querySimpleExecute('SELECT * FROM t_user');

        return $this -> _pdoConnection -> formatData($data);
    }

    /**
     * It takes a username and returns the data from the database
     * 
     * @param username the username of the user
     * 
     * @return An array of data from the database.
     */
    public function getOne($username)
    {

        $binds['username'] = ['value' => $username, 'type' => PDO::PARAM_INT];

        $data = $this -> _pdoConnection -> queryPrepareExecute('SELECT * FROM t_user WHERE useUsername = :username', $binds);

        return $this -> _pdoConnection -> formatData($data);
    }
}
?>