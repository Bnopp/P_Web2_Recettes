<?php

/**
 * 
 * 
 * Auteur : Lucie De Oliveira
 * Date :   18.02.2022
 * Description :Page pour ajouter un enseignant
 */


require_once("database.php"); 

$data = new Database();
$teachers = $data->getAllTeachers();
$section = $data->getAllSection();

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
        <h3>Ajout d'un enseignant</h3>



        <form action="addTeacher.php" class="add" method="post">
            <input type="radio" value="m" name="genre">
            <label for="homme">Homme</label>
            <input type="radio" value="f" name="genre">
            <label for="femme">Femme</label>
            <input type="radio" value="a" name="genre">
            <label for="autre">Autre</label><br>
            <label for="name">Nom :</label>
            <input type="text" name="name"><br>
            <label for="surName">Prénom :</label>
            <input type="text" name="surName"><br>
            <label for="nickName">Surnom :</label>
            <input type="text" name="nickName"><br>
            <label for="origin" class="origin">Origine :</label>
            <textarea name="origin"></textarea><br>

            <select name="section" name="section">
            <option value="0">Section</option>
            <?php foreach($section as $key => $value):?>
                <option value="1"><?php print $value['secName']?></option>

            <?php endforeach?>
            </select>

            <br>
            <br>
            <input type="submit" class="ajouter" name="click" value="Ajouter" onclick="click"/>
            <input type="submit" class="ajouter" name="clickDelete" value="Effacer" onclick="clique">

            

        </form>

        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['click']))
            {
                func();
            }
            function func()
            {
                $db = new Database();
                if(isset($_POST["genre"]) && isset($_POST["name"]) && isset($_POST["surName"]) && isset($_POST["nickName"]) && isset($_POST["origin"]) && isset($_POST["section"])){
                    $db -> addTeacher($_POST["section"], $_POST["surName"], $_POST["name"], $_POST["genre"], $_POST["nickName"], $_POST["origin"]);
                    print "L'ensignant a bien été ajouté";
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