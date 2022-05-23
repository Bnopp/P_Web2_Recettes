<?php
/**
* Class and Function List:
* Function list:
* - getAll()
* - getOne()
* Classes list:
*/
/**
 * ETML
 * @author   : Serghei Diulgherov
 * Date     : 11.04.2022
 * Interface grouping all the methods needed in every repository
 */
interface Entity
{
    /* It's a method that returns all the data from the database. */
    public function getAll();

    /* It's a method that returns one data from the database. */
    public function getOne($id);
}
?>
