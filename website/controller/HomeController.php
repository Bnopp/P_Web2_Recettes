<?php
/**
 * Auteur   : Serghei Diulgherov
 * Date     : 06.05.2022
 * Home 
 */

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'resources/library/PHPMailer-master/src/Exception.php';
 require 'resources/library/PHPMailer-master/src/PHPMailer.php';
 require 'resources/library/PHPMailer-master/src/SMTP.php';

class HomeController extends Controller 
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
     * @return content of the view file.
     */
    private function indexAction()
    {
        $view = file_get_contents('view/page/home/index.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * It takes a file, evaluates it, and returns the content.
     * 
     * @return content of the contact page.
     */
    private function contactAction()
    {
        $view = file_get_contents('view/page/home/contact.php');

        if (isset($_GET['send']) && $_GET['send'] == TRUE)
        {
            $config = require_once 'resources/config.php';

            $mail = new PHPMailer();

            try
            {
                //server settings
                $mail->SMTPDebug    = 0;
                $mail->isSMTP();
                $mail->Host         = $config['smtpServer'];
                $mail->SMTPAuth     = true;
                $mail->Username     = $config['smtpUsername'];
                $mail->Password     = $config['smtpPassword'];
                $mail->SMTPSecure   = $config['smtpSecure'];
                $mail->Port         = $config['smtpPort'];

                //recipient
                $mail->setFrom($_POST['email'], $_POST['name']);
                $mail->addAddress($config['smtpReciever']);

                //content
                $mail->Subject      = $_POST['subject'];
                $mail->Body         = $_POST['message'];

                $mail->send();
                echo 'Message sent';
            }
            catch (Exception $e)
            {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
            
            $uri = parse_url($_SERVER['REQUEST_URI']);
            var_dump($uri);
            /*parse_str($uri['query'], $uriVar);
            unset($uriVar['send']);
            $uriQuery = http_build_query($uriVar);
            $url = "index.php?$uriQuery";
            header("Location: $url");
            die();*/
        }

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
?>