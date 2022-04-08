<?php

/**
 * 
 * 
 * Auteur : Lucie De Oliveira
 * Date :   18.02.2022
 * Description : Classe qui contient les données d'accèes de la BD
 */


require_once("database.php"); 
$data = new Database();
$teachers = $data->getOneTeacher($_GET["idTeacher"]);
$section = $data->getSection($teachers[0]["fkSection"]);

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
        <h3>Détail : <?php print $teachers[0]['teaFirstname'] . " " . $teachers[0]['teaName'] . "  "; ?> 
        <?php  if($teachers[0]['teaGender'] == "m"):?>
            <img class="icon" src="../../ressources/images/male.jpg">
            <?php else: ?>
            <img class="icon" src="../../ressources/images/female.png">
        <?php endif ?>
          
        <?php print $section[0]["secName"] ?>

        <input class="edit" type="image" src="../../ressources/images/edit.png">
        <input class="delete" type="image" src="../../ressources/images/delete.png">
        </h3>
        <br>

        <p>Surnom : <?php  print $teachers[0]['teaNickname']?></p>
        <p><?php  print $teachers[0]['teaOrigine']?></p>

        <br>
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