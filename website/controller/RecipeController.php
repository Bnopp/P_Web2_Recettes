<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 09.05.2022
 * Recipes 
 */


class RecipeController extends Controller 
{
    /**
     * It takes the value of the action parameter in the URL and appends "Action" to it. Then it calls
     * the function with that name.
     * 
     * So if the URL is http://example.com/index.php?action=foo, the function fooAction() will be
     * called.
     * 
     * @return void
     */
    public function display(){

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * It takes a file, evaluates it, and returns the content.
     * 
     * @return content The content of the view detail file.
     */
    private function detailAction()
    {
        $view = file_get_contents('view/page/recipe/detail.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    
    /**
     * It takes a file, evaluates it, and returns the content.
     * 
     * @return content The content of the view list file.
     */
    private function listAction()
    {
        $view = file_get_contents('view/page/recipe/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    } 
}
?>