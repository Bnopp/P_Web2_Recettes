<?php
/**
 * Class and Function List:
 * Function list:
 * - display()
 * - detailAction()
 * - listAction()
 * - addAction()
 * - modifyAction()
 * Classes list:
 * - RecipeController extends Controller
 */
/**
 * ETML
 * @author   : Serghei Diulgherov
 * Date     : 09.05.2022
 * Recipe Controller
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
    public function display()
    {

        $action = $_GET['action'] . "Action";

        if (method_exists($this, $action))
            return call_user_func(array(
                $this,
                $action
            ));
        else
        {
            $_SESSION['error'] = "La page demandée n'existe pas";
            header("Location: index.php?controller=home&action=error");
            die();
        }
    }

    /**
     * It gets the recipe details, the comments and the ratings of a recipe
     *
     * @return mixed The content of the page.
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

            /* Redirecting the user to the same page without the setRating parameter. */
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
        if (isset($_GET['comment']) && $_GET['comment'] == 1)
        {
            if (preg_match("/^\p{L}{1,}$/u", $_POST['name']) && 
			preg_match("/^([A-z]{1,}\.{0,1}){1,}@[A-z]{1,}\.{1}[A-z]{1,}$/u", $_POST['email']) && 
			preg_match("/^\p{L}{1,}$/u", $_POST['subject']) && 
			preg_match("/^(\p{L}|[0-9]|\W){1,}$/u", $_POST['message']))
            {
                $commentRepository->addOne($_GET['id'], $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            }
            else
            {
                $_SESSION['error'] = "Le format que vous avez utilisé pour entrer vos données n'est pas valide.";
                header("Location: index.php?controller=home&action=error");
                die();
            }

            /* Redirecting the user to the same page without the comment parameter. */
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
     * It gets all the recipes from the database and displays them in a list
     *
     * @return mixed The content of the page.
     */
    private function listAction()
    {
        $categoryRepository = new CategoryRepository();
        define('CATEGORIES', $categoryRepository->getAll());

        $recipeRepository = new RecipeRepository();

        /* It checks if the user has entered a search term. */
        if (count($_POST) > 0)
        {
            /* It replaces all the spaces in the search term with a single space. */
            $search = preg_replace('/\s+/', ' ', $_POST["search"]);

            /* It checks if the search term contains only letters and spaces. */
            if (preg_match("/^((\p{L}{1,})\s{0,1})*$/u", $search)) define('RECIPES', $recipeRepository->getAllBySearch($_POST["select"], $_POST["search"]));
            else define('RECIPES', array());
        }
        else
        {
            define('RECIPES', $recipeRepository->getAll());
        }

        $ratingRepository = new RatingRepository();
        $ratings = array();

        foreach (RECIPES as $recipe)
        {
            /* Adding the ratings of a recipe to an array. */
            $ratings += array(
                $recipe['idRecipe'] => $ratingRepository->getOne($recipe['idRecipe'])
            );
        }
        define('RATINGS', $ratings);

        $view = file_get_contents('view/page/recipe/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * It adds a recipe to the database
     *
     * @return mixed The content of the page.
     */
    private function addAction()
    {
        /* It checks if the user is connected and if he is an admin. */
        if ($_SESSION['isConnected'] && $_SESSION['isAdmin'])
        {
            if (isset($_GET['add']) && $_GET['add'] == 1)
            {
                if (preg_match("/^(\p{L}|\s|\W){1,}$/u", $_POST['title']) && preg_match("/^(\p{L}|,|\s|[0-9]|\W){1,}$/u", $_POST['ingredients']) && preg_match("/^(\p{L}|\.|\s|[0-9]|\W){1,}$/u", $_POST['preparation']))
                {
                    include 'resources\php\upload.php';
                    $recipeRepository = new RecipeRepository();
                    $recipeRepository->addOne($_POST['title'], $_POST['ingredients'], $_POST['preparation'], $_FILES["fileToUpload"]['name'], $_POST['select']);

                    $_SESSION['error'] = "La recette a été ajoutée avec succés.";
                    header("Location: index.php?controller=home&action=error");
                    die();
                }
                else
                {
                    $_SESSION['error'] = "Le format que vous avez utilisé pour entrer vos données n'est pas valide.";
                    header("Location: index.php?controller=home&action=error");
                    die();
                }
            }

            $categoryRepository = new CategoryRepository();
            define('CATEGORIES', $categoryRepository->getAll());

            $view = file_get_contents('view/page/recipe/add.php');

            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }
        else 
        {
            $_SESSION['error'] = "Vous devez être connecté en tand qu'administrateur pour voir cette page.";
            header("Location: index.php?controller=home&action=error");
            die();
        }
        
    }

    /**
     * It gets all the categories from the database, gets the recipe from the database, and if the
     * update button is clicked, it updates the recipe in the database
     *
     * @return mixed The content of the page.
     */
    private function modifyAction()
    {
        /* It checks if the user is connected and if he is an admin. */
        if ($_SESSION['isConnected'] && $_SESSION['isAdmin'])
        {
            $categoryRepository = new CategoryRepository();
            define('CATEGORIES', $categoryRepository->getAll());

            $recipeRepository = new RecipeRepository();
            define('RECIPE', $recipeRepository->getOne($_GET['id']));

            if (isset($_GET['update']) && $_GET['update'] == 1)
            {
                if (preg_match("/^(\p{L}|\s|\W){1,}$/u", $_POST['title']) && preg_match("/^(\p{L}|,|\s|[0-9]|\W){1,}$/u", $_POST['ingredients']) && preg_match("/^(\p{L}|\.|\s|[0-9]|\W){1,}$/u", $_POST['preparation']))
                {
                    $recipeRepository->updateOne($_GET['id'], $_POST['title'], $_POST['ingredients'], $_POST['preparation'], $_POST['select']);

                    $_SESSION['error'] = "La recette a été modifiée avec succés.";
                    header("Location: index.php?controller=home&action=error");
                    die();
                }
                else
                {
                    $_SESSION['error'] = "Le format que vous avez utilisé pour entrer vos données n'est pas valide.";
                    header("Location: index.php?controller=home&action=error");
                    die();
                }

            }

            $view = file_get_contents('view/page/recipe/modify.php');

            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }
        else 
        {
            $_SESSION['error'] = "Vous devez être connecté en tand qu'administrateur pour voir cette page.";
            header("Location: index.php?controller=home&action=error");
            die();
        }
    }
}
?>
