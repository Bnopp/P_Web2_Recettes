<?php
/**
* Class and Function List:
* Function list:
* - display()
* - indexAction()
* - contactAction()
* - connectAction()
* Classes list:
* - HomeController extends Controller
*/
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 06.05.2022
 * Home Controller
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'resources/library/PHPMailer-master/src/Exception.php';
require 'resources/library/PHPMailer-master/src/PHPMailer.php';
require 'resources/library/PHPMailer-master/src/SMTP.php';

include_once 'model/UserRepository.php';
include_once 'model/RecipeRepository.php';
include_once 'model/RatingRepository.php';

/* This class extends the Controller class and is used to handle requests to the home page. */
class HomeController extends Controller {


	/**
     * It takes the value of the action parameter in the URL and appends "Action" to it. Then it calls the
     * function with that name.
     * 
     * So if the URL is http://example.com/index.php?action=foo, the function fooAction() will be called.
     * 
     * @return mixed The return value of the function call
     */
    public function display() {

		$action = $_GET['action'] . "Action";

		return call_user_func(array(
			$this,
			$action
		));
	}

	/**
     * It gets the latest recipe from the database, gets the rating of that recipe, and then displays it.
     * 
     * @return mixed The content of the view.
     */
    private function indexAction() {
		/* Getting the latest recipe from the database and then getting the rating of that recipe. */
        $recipeRepository = new RecipeRepository();
		define('RECIPE', $recipeRepository->getLatestOne());

		$ratingRepository = new RatingRepository();
		$ratings          = array(
			RECIPE[0]['idRecipe'] => $ratingRepository->getOne(RECIPE[0]['idRecipe'])
		);
		define('RATINGS', $ratings);

        /* Getting the content of the view and then evaluating it. */
        $view             = file_get_contents('view/page/home/index.php');
		ob_start();
		eval('?>' . $view);
		$content = ob_get_clean();

		return $content;
	}

	/**
     * It sends an email to the email address specified in the config file.
     * 
     * @return mixed The content of the page.
     */
    private function contactAction() {
		$view            = file_get_contents('view/page/home/contact.php');

        /* It checks if the send parameter is set and if it is equal to 1. */
        if (isset($_GET['send']) && $_GET['send'] == 1) {

            /* Checking if the input is valid. */
            if (preg_match("/^\p{L}{1,}$/u", $_POST['name']) && 
                preg_match("/^([A-z]{1,}\.{0,1}){1,}@[A-z]{1,}\.{1}[A-z]{1,}$/u", $_POST['email']) && 
                preg_match("/^\p{L}{1,}$/u", $_POST['subject']) &&
                preg_match("/^(\p{L}|[0-9]|\W){1,}$/u", $_POST['message']))
            {
                $config          = require_once 'resources/config.php';
                $mail            = new PHPMailer();

                /* Trying to send an email. */
                try {
                    /* Setting up the SMTP server. */
                    $mail->SMTPDebug  = 0;
                    $mail->isSMTP();
                    $mail->Host       = $config['smtpServer'];
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $config['smtpUsername'];
                    $mail->Password   = $config['smtpPassword'];
                    $mail->SMTPSecure = $config['smtpSecure'];
                    $mail->Port       = $config['smtpPort'];

                    /* Setting the sender and the recipient of the email. */
                    $mail->setFrom($_POST['email'], $_POST['name']);
                    $mail->addAddress($config['smtpReciever']);

                    /* Setting the subject and the body of the email. */
                    $mail->Subject = $_POST['subject'];
                    $mail->Body    = $_POST['message'];

                    $mail->send();
                }
                catch(Exception $e) {
                    /* Redirecting the user to the error page if the email could not be sent. */
                    $_SESSION['error'] = "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
                    header("Location: index.php?controller=home&action=error"); 
                    die(); 
                }

                /* Redirecting the user to the same page without the send parameter. */
                $uri = parse_url($_SERVER['REQUEST_URI']);
                parse_str($uri['query'], $uriVar);
                unset($uriVar['send']);
                $uriQuery = http_build_query($uriVar);
                $url      = "index.php?$uriQuery";
                header("Location: $url");
                die();
            }
            else
            {
                $_SESSION['error'] = "Le format que vous avez utilisé pour entrer vos données n'est pas valide, veuillez reessayer sans charactères spéciaux ou de numéro dans le nom et le sujet ainsi que le format standart pour l'email";
                header("Location: index.php?controller=home&action=error"); 
                die(); 
            }
		}

		ob_start();
		eval('?>' . $view);
		$content = ob_get_clean();

		return $content;
	}

	private function connectAction() {
		$userRepository = new UserRepository();

		if (isset($_GET['connect'])) {
			if ($_GET['connect'] == 0) {
				session_destroy();
				session_start();
			}
			else {
				$userToConnect = $userRepository->getOne($_POST['username']);
				if (count($userToConnect)) {
					if ($_POST['username'] == $userToConnect[0]['useUsername']) {
						if (!password_verify($_POST['password'], $userToConnect[0]['usePassword'])) {
							$_SESSION['isConnected']               = true;
							$_SESSION['connectedUser']               = $_POST['username'];
							$_SESSION['isAdmin']               = $userToConnect[0]['useAdmin'];
						}
					}
				}
			}
		}
        $view           = file_get_contents('view/page/home/connect.php');

		ob_start();
		eval('?>' . $view);
		$content = ob_get_clean();

		return $content;
	}

    private function errorAction()
    {
        $view           = file_get_contents('view/page/home/error.php');

		ob_start();
		eval('?>' . $view);
		$content = ob_get_clean();

		return $content;
    }

}
?>
