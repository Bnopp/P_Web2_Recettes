<?php
/**
 * ETML
 * Auteur : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the categories
 */

 /**
 * Modified by  : Serghei Diulgherov
 * Date         : 11.04.2022
 * Modifications:
 *      Added   - getAll
 *              - getOneCategory
 */

//To DO
// Complete comments on all methods + params and returns

include_once 'Entity.php';

require_once('../data/data.php');

class CategoryRepository implements Entity 
{

    private $_pdoConnection = new Data();

    /**
     * Get all categories
     *
     * @return array
     */
    public function getAll() 
    {

        $data = $this -> _pdoConnection -> querySimpleExecute('SELECT * FROM t_category');

        return $this -> _pdoConnection -> formatData($data);
    }

    /**
     * Get one recipe
     * 
     * @param $idCategory
     * 
     * @return array
     */
    public function getOneCategory($idCategory)
    {
        
        $binds['idCategory'] = ['value' => $idCategory, 'type' => PDO::PARAM_INT];

        $data = $this -> _pdoConnection -> queryPrepareExecute('SELECT * FROM t_category WHERE idCategory = :idCategory', $binds);

        return $this -> _pdoConnection -> formatData($data);
    }

}
?>