<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 09.05.2022
 * Recipes 
 */
include_once 'model/CategoryRepository.php';
include_once 'model/RecipeRepository.php';
include_once 'model/RatingRepository.php';

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
        $recipeRepository = new RecipeRepository();
        define('RECIPE', $recipeRepository->getOne($_GET['id']));

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
        $categoryRepository = new CategoryRepository();
        define('CATEGORIES', $categoryRepository->getAll());

        $recipeRepository = new RecipeRepository();

        if (count($_POST)> 0)
        {
            $search = preg_replace('/\s+/', ' ', $_POST["search"]);
            if (preg_match("/^((\p{L}{1,})\s{0,1})*$/u", $search))
                define('RECIPES', $recipeRepository->getAllBySearch($_POST["select"], $_POST["search"]));
            else
                define('RECIPES', array());
        }
        else
        {
            define('RECIPES', $recipeRepository->getAll());
        }

        $ratingRepository = new RatingRepository();
        $ratings = array();
        foreach (RECIPES as $recipe)
        {
            $ratings += array($recipe['idRecipe']=>$ratingRepository->getOne($recipe['idRecipe']));
        }
        define('RATINGS', $ratings);

        $view = file_get_contents('view/page/recipe/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    } 
}
?>