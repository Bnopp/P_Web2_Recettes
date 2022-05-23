<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getAll()
* - getAllBySearch()
* - getOne()
* - addOne()
* - getLatestOne()
* - updateOne()
* Classes list:
* - RecipeRepository
*/
/**
 * ETML
 * @author : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the recipes
 */

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
        $this->_pdoConnection = Data::getConn();
    }

    /**
     * Getting all the data from the table t_recipe
     *
     * @return array => An array of objects
     */
    public function getAll()
    {
        $data = $this
            ->_pdoConnection
            ->querySimpleExecute('SELECT * FROM t_recipe');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It's a function that gets all recipes from the database by searching for a specific word in the
     * title of the recipe.
     * 
     * @param category => the category id
     * @param search =>  the search term
     * 
     * @return array => The data from the database.
     */
    public function getAllBySearch($category, $search)
    {
        $type = $category;

        if ($type == "0")
        {
            $data = $this
                ->_pdoConnection
                ->querySimpleExecute("SELECT * FROM t_recipe WHERE recTitle LIKE '%" . $search . "%'");
        }
        else
        {
            $data = $this
                ->_pdoConnection
                ->querySimpleExecute("SELECT * FROM t_recipe WHERE fkCategory = $type AND recTitle LIKE '%" . $search . "%'");
        }

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It gets one recipe with the idRecipe
     * 
     * @param idRecipe => the id of the recipe as found in the Database
     * 
     * @return array => data from the database.
     */
    public function getOne($idRecipe)
    {

        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT * FROM t_recipe WHERE idRecipe = :idRecipe', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It adds a recipe to the database
     * 
     * @param title => string
     * @param ingredients => text
     * @param preparation =>text
     * @param image => ex. test.png
     * @param category => int
     * 
     * @return array => data is being returned in an array.
     */
    public function addOne($title, $ingredients, $preparation, $image, $category)
    {
        $binds['title'] = ['value' => $title, 'type' => PDO::PARAM_STR];
        $binds['ingredients'] = ['value' => $ingredients, 'type' => PDO::PARAM_STR];
        $binds['preparation'] = ['value' => $preparation, 'type' => PDO::PARAM_STR];
        $binds['image'] = ['value' => $image, 'type' => PDO::PARAM_STR];
        $binds['category'] = ['value' => $category, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('INSERT INTO t_recipe (recTitle, recIngredients, recPreparation, recImage, fkCategory) VALUES (:title, :ingredients, :preparation, :image, :category)', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It gets the latest recipe from the database.
     * 
     * @return array => An array of objects.
     */
    public function getLatestOne()
    {
        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT * FROM `t_recipe` ORDER BY `t_recipe`.`idRecipe` DESC');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It updates a recipe in the database
     * 
     * @param idRecipe => int
     * @param title => string
     * @param ingredients => text
     * @param preparation => text
     * @param category => int
     * 
     * @return array => An array of objects
     */
    public function updateOne($idRecipe, $title, $ingredients, $preparation, $category)
    {
        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];
        $binds['title'] = ['value' => $title, 'type' => PDO::PARAM_STR];
        $binds['ingredients'] = ['value' => $ingredients, 'type' => PDO::PARAM_STR];
        $binds['preparation'] = ['value' => $preparation, 'type' => PDO::PARAM_STR];
        $binds['category'] = ['value' => $category, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('UPDATE t_recipe SET recTitle = :title, recIngredients = :ingredients, recPreparation = :preparation, fkCategory = :category WHERE idRecipe = :idRecipe', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }
}
?>
