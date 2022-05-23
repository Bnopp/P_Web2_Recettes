<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 09.05.2022
 * Recipes 
 */
include_once 'model/CategoryRepository.php';
include_once 'model/RecipeRepository.php';
include_once 'model/RatingRepository.php';
include_once 'model/CommentRepository.php';

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
        $categoryRepository = new CategoryRepository();
        define('CATEGORIES', $categoryRepository->getAll());

        $recipeRepository = new RecipeRepository();
        define('RECIPE', $recipeRepository->getOne($_GET['id']));

        $ratingRepository = new RatingRepository();
        define('RATINGS', $ratingRepository->getOne($_GET['id']));

        
        /* A function that allows the user to rate a recipe. */
        if (isset($_GET['setRating']))
        {
            $ratingRepository->addOne($_GET['id'], $_GET['setRating']);

            $uri = parse_url($_SERVER['REQUEST_URI']);
            parse_str($uri['query'], $uriVar);
            unset($uriVar['setRating']);
            $uriQuery = http_build_query($uriVar);
            $url = "index.php?$uriQuery";
            header("Location: $url");
            die();
        }

        $commentRepository = new CommentRepository();

        /* A function that allows the user to comment a recipe. */
        if (isset($_GET['comment']) && $_GET['comment'] == TRUE)
        {
            $commentRepository->addOne($_GET['id'], $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $uri = parse_url($_SERVER['REQUEST_URI']);
            parse_str($uri['query'], $uriVar);
            unset($uriVar['comment']);
            $uriQuery = http_build_query($uriVar);
            $url = "index.php?$uriQuery";
            header("Location: $url");
            die();
        }

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

    private function addAction(){

        if (isset($_GET['add']) && $_GET['add'] == TRUE)
        {
            include 'resources\php\upload.php';
            $recipeRepository = new RecipeRepository();
            $recipeRepository->addOne($_POST['title'], $_POST['ingredients'], $_POST['preparation'], $_FILES["fileToUpload"]['name'], $_POST['select']);
        }

        $categoryRepository = new CategoryRepository();
        define('CATEGORIES', $categoryRepository->getAll());

        $view = file_get_contents('view/page/recipe/add.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    private function modifyAction()
    {
        $categoryRepository = new CategoryRepository();
        define('CATEGORIES', $categoryRepository->getAll());

        $recipeRepository = new RecipeRepository();
        define('RECIPE', $recipeRepository->getOne($_GET['id']));

        if(isset($_GET['update']) && $_GET['update'] == 1)
        {
            $recipeRepository->updateOne($_GET['id'], $_POST['title'], $_POST['ingredients'], $_POST['preparation'], $_POST['select']);
        }

        $view = file_get_contents('view/page/recipe/modify.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
?>