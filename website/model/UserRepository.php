<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getAll()
* - getOne()
* Classes list:
* - UserRepository
*/
/**
 * ETML
 * @author : Serghei Diulgherov
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
        $this->_pdoConnection = Data::getConn();
    }

    /**
     * It returns all the data from the table t_user.
     *
     * @return array => An array of objects.
     */
    public function getAll()
    {
        $data = $this
            ->_pdoConnection
            ->querySimpleExecute('SELECT * FROM t_user');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It takes a username, queries the database for the user, and returns the user's data.
     * 
     * @param username =>  the username of the user you want to get
     * 
     * @return array => An array of data from the database.
     */
    public function getOne($username)
    {

        $binds['username'] = ['value' => $username, 'type' => PDO::PARAM_STR];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT * FROM t_user WHERE useUsername = :username', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }
}
?>
