<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getAll()
* - getOne()
* - addOne()
* Classes list:
* - RatingRepository
*/
/**
 * ETML
 * @author : Serghei Diulgherov
 * Date: 5.17.2022
 * Group of methods allowing to retrieve data for the ratings
 */

include_once 'Entity.php';

require_once 'data/data.php';

class RatingRepository implements Entity
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
     * Getting all the data from the table t_rating
     *
     * @return array
     */
    public function getAll()
    {
        $data = $this
            ->_pdoConnection
            ->querySimpleExecute('SELECT * FROM t_rating');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It gets the ratings of a recipe
     *
     * @param idRecipe =>  the id of the recipe
     *
     * @return array => Arraw of the ratings for a recipe.
     */
    public function getOne($idRecipe)
    {
        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT ratRating FROM t_rating WHERE fkRecipe = :idRecipe', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It adds a rating to a recipe
     *
     * @param idRecipe => the id of the recipe
     * @param rating => 1-5
     *
     * @return array => data is being returned in an array.
     */
    public function addOne($idRecipe, $rating)
    {
        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];
        $binds['rating'] = ['value' => $rating, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('INSERT INTO t_rating (ratRating, fkRecipe) VALUES (:rating, :idRecipe)', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

}
?>
