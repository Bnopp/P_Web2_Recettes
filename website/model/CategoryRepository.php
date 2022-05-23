<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getAll()
* - getOne()
* Classes list:
* - CategoryRepository
*/
/**
 * ETML
 * @author : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the categories
 */

include_once 'Entity.php';

require_once 'data/data.php';

class CategoryRepository implements Entity
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
     * Get all recipe categories
     *
     * @return array
     */
    public function getAll()
    {

        $data = $this
            ->_pdoConnection
            ->querySimpleExecute('SELECT * FROM t_category');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * Get one recipe category
     *
     * @param idCategory   => the id of the category as found in the Database
     *
     * @return array
     */
    public function getOne($idCategory)
    {

        $binds['idCategory'] = ['value' => $idCategory, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT * FROM t_category WHERE idCategory = :idCategory', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

}
?>
