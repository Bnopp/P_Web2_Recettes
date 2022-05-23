<?php
/**
 * ETML
 * Auteur : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the recipes
 */

 /**
 * Modified by  : Serghei Diulgherov
 * Date         : 11.04.2022
 * Modifications:
 *      Added   - getAll
 *              - getOneRecipe
 */

//To DO

include_once 'Entity.php';

require_once 'data/data.php';

class RecipeRepository implements Entity 
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
     * Getting all the data from the table t_recipe
     *
     * @return array
     */
    public function getAll() 
    {
        $data = $this -> _pdoConnection -> querySimpleExecute('SELECT * FROM t_recipe');

        return $this -> _pdoConnection -> formatData($data);
    }

    /**
     * It takes a search term, and returns all the recipes that have that search term in their title.
     * 
     * @param search the search term
     * 
     * @return array
     */
    public function getAllBySearch($category, $search) 
    {
        $type = $category;

        if ($type == "0")
        {
            $data = $this -> _pdoConnection -> querySimpleExecute("SELECT * FROM t_recipe WHERE recTitle LIKE '%" . $search . "%'");
        }
        else
        {
            $data = $this -> _pdoConnection -> querySimpleExecute("SELECT * FROM t_recipe WHERE fkCategory = $type AND recTitle LIKE '%" . $search . "%'");
        }

        return $this -> _pdoConnection -> formatData($data);
    }

    /**
     * Get one recipe
     * 
     * @param $idRecipe     => the id of the recipe as found in the Database
     * 
     * @return array    
     */
    public function getOne($idRecipe)
    {

        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];

        $data = $this -> _pdoConnection -> queryPrepareExecute('SELECT * FROM t_recipe WHERE idRecipe = :idRecipe', $binds);

        return $this -> _pdoConnection -> formatData($data);
    }

    /**
     * It adds a recipe to the database
     * 
     * @param title
     * @param ingredients 
     * @param preparation
     * @param image
     * @param category
     * 
     * @return array
     */
    public function addOne($title, $ingredients, $preparation, $image, $category)
    {
        $binds['title'] = ['value' => $title, 'type' => PDO::PARAM_STR];
        $binds['ingredients'] = ['value' => $ingredients, 'type' => PDO::PARAM_STR];
        $binds['preparation'] = ['value' => $preparation, 'type' => PDO::PARAM_STR];
        $binds['image'] = ['value' => $image, 'type' => PDO::PARAM_STR];
        $binds['category'] = ['value' => $category, 'type' => PDO::PARAM_INT];

        $data = $this -> _pdoConnection -> queryPrepareExecute('INSERT INTO t_recipe (recTitle, recIngredients, recPreparation, recImage, fkCategory) VALUES (:title, :ingredients, :preparation, :image, :category)', $binds);

        return $this -> _pdoConnection -> formatData($data);
    }

    public function getLatestOne()
    {
        $data = $this -> _pdoConnection -> queryPrepareExecute('SELECT * FROM `t_recipe` ORDER BY `t_recipe`.`idRecipe` DESC');

        return $this -> _pdoConnection -> formatData($data);
    }

    public function updateOne($idRecipe, $title, $ingredients, $preparation, $category)
    {
        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];
        $binds['title'] = ['value' => $title, 'type' => PDO::PARAM_STR];
        $binds['ingredients'] = ['value' => $ingredients, 'type' => PDO::PARAM_STR];
        $binds['preparation'] = ['value' => $preparation, 'type' => PDO::PARAM_STR];
        $binds['category'] = ['value' => $category, 'type' => PDO::PARAM_INT];

        $data = $this -> _pdoConnection -> queryPrepareExecute('UPDATE t_recipe SET recTitle = :title, recIngredients = :ingredients, recPreparation = :preparation, fkCategory = :category WHERE idRecipe = :idRecipe', $binds);

        return $this -> _pdoConnection -> formatData($data);
    }
}
?>