<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getAll()
* - getOne()
* - addOne()
* Classes list:
* - CommentRepository
*/
/**
 * ETML
 * @author : Serghei Diulgherov
 * Date: 11.04.2022
 * Group of methods allowing to retrieve data for the categories
 */

include_once 'Entity.php';

require_once 'data/data.php';

class CommentRepository implements Entity
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
     * It returns all the data from the table t_comment.
     *
     * @return array => An array of objects.
     */
    public function getAll()
    {

        $data = $this
            ->_pdoConnection
            ->querySimpleExecute('SELECT * FROM t_comment');

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It returns all the comments of a recipe
     *
     * @param idRecipe the id of the recipe
     *
     * @return array => An array of comments.
     */
    public function getOne($idRecipe)
    {

        $binds['idRecipe'] = ['value' => $idCategory, 'type' => PDO::PARAM_INT];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('SELECT * FROM t_comment WHERE fkRecipe = :idRecipe', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

    /**
     * It adds a comment to the database
     * 
     * @param idRecipe => the id of the recipe
     * @param name => string
     * @param email => ex. test@test.com
     * @param subject => The subject of the comment
     * @param message => text
     * 
     * @return array => data is being returned in an array.
     */
    public function addOne($idRecipe, $name, $email, $subject, $message)
    {
        $binds['idRecipe'] = ['value' => $idRecipe, 'type' => PDO::PARAM_INT];
        $binds['name'] = ['value' => $name, 'type' => PDO::PARAM_STR];
        $binds['email'] = ['value' => $email, 'type' => PDO::PARAM_STR];
        $binds['subject'] = ['value' => $subject, 'type' => PDO::PARAM_STR];
        $binds['message'] = ['value' => $message, 'type' => PDO::PARAM_STR];

        $data = $this
            ->_pdoConnection
            ->queryPrepareExecute('INSERT INTO t_comment (comName, comEmail, comSubject, comMessage, fkRecipe) VALUES (:name, :email, :subject, :message, :idRecipe)', $binds);

        return $this
            ->_pdoConnection
            ->formatData($data);
    }

}
?>
