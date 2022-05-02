<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 11.04.2022
 * Interface grouping all the methods needed in every repository
 */

/**
 * Modified by  : Serghei Diulgherov
 * Date         : 11.04.2022
 * Modifications:
 *      Added   - getAll
 */

interface Entity 
{
    public function getAll();

    public function getOne($id);
}
?>