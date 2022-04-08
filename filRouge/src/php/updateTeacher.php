<?php

/**
 * 
 * 
 * Auteur : Lucie De Oliveira
 * Date :   18.02.2022
 * Description :Page pour ajouter un enseignant
 */


session_start();

require_once("database.php"); 

$data = new Database();

$_SESSION["idTeacher"] = $_GET["idTeacher"];
$teacher = $data->getOneTeacher($_GET["idTeacher"]);
$section = $data->getSection($teacher[0]["fkSection"]);
$sections = $data->getAllSection();
 ?>
 <!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../../ressources/css/index.css">
    <meta charset="utf-8">
    </head>
    <header>
    <h1>Surnom des enseignants</h1>

    <div class="menu">
    <h3>Zone pour le menu</h3>
    </div>
    </header>
    <body>
        <h3>Modification d'un enseignant</h3>



        <form action="updateTeacher.php" class="add" method="post">
            <input type="radio" value="m" name="genre" <?php print ($teacher[0]['teaGender'] == "m")?'checked':'' ?>>
            <label for="homme">Homme</label>
            <input type="radio" value="f" name="genre"  <?php print ($teacher[0]['teaGender'] == "f")?'checked':'' ?>>
            <label for="femme">Femme</label>
            <input type="radio" value="a" name="genre" <?php print ($teacher[0]['teaGender'] == "a")?'checked':'' ?>>
            <label for="autre">Autre</label><br>


            <label for="name">Nom :</label>
            <input type="text" name="name" value='<?php print ($teacher[0]["teaName"])?>'><br>
            <label for="surName">Prénom :</label>
            <input type="text" name="surName" value='<?php print ($teacher[0]["teaFirstname"])?>'><br>
            <label for="nickName">Surnom :</label>
            <input type="text" name="nickName" value='<?php print ($teacher[0]["teaNickname"])?>'><br>
            <label for="origin" class="origin">Origine :</label>
            <textarea name="origin"><?php print ($teacher[0]["teaOrigine"])?></textarea><br>

            <select name="section" name="section">
            <option value="1">Section</option>
            <?php foreach($sections as $key => $value):?>
                <option value="1" <?php print ($value['secName'] == $section[0]['secName'])?'selected':'' ?>><?php print $value['secName']?></option>

            <?php endforeach?>
            </select>

            <br>
            <br>
            <input type="submit" class="ajouter" name="click" value="Modifier">

            

        </form>

        <?php
            print $_SESSION["idTeacher"];
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['click']))
            {
                func();
            }
            function func()
            {
                $db = new Database();
                if(isset($_POST["genre"]) && isset($_POST["name"]) && isset($_POST["surName"]) && isset($_POST["nickName"]) && isset($_POST["origin"]) && isset($_POST["section"])){
                    $db -> updateTeacher($_POST["section"], $_POST["surName"], $_POST["name"], $_POST["genre"], $_POST["nickName"], $_POST["origin"], $_SESSION["idTeacher"]);
                    print "L'ensignant a bien été modifié";
                }else{
                    print "Veuillez rentrer tous les champs";
                }
            }
        ?>
        <br>

        <a class="return" href="index.php">Retour à la page d'acceuil</a>

        <br>
        <footer>
            <div class="copyright">
            <hr>
            <p>Copyright Lucie De Oliveira - 2022</p>
            </div>
        </footer>

    </body>
</html>