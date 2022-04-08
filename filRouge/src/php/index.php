<!--
    Auteur: Lucie De Oliveira
    Date: 18.02.22
    Lieu: ETML
    Description: Page d'acceuil
-->
<?php 
require_once("database.php"); 
$data = new Database();
$teachers = $data->getAllTeachers();
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
        <h3 class="liste">Liste des enseignants</h3>

        <table>
            <tr>
                <th>Nom</th>
                <th>Surnom</th>
                <th>Options</th>
            </tr>
            <?php foreach($teachers as $key => $value):?>
            <tr>
            <td><?php print $value['teaFirstname'] . " ".  $value['teaName']?></td>
            <td><?php print $value['teaNickname']?></td>
            <td>
            <a href="updateTeacher.php?idTeacher=<?php print $value['idTeacher'];?>"><input class="btn" type="image" src="../../ressources/images/edit.png"></a>
            <input class="btn" type="image" src="../../ressources/images/delete.png">
                <a href="detail.php?idTeacher=<?php print $value['idTeacher'];?>"><input class="btn" type="image" src="../../ressources/images/loupe.png"> </a>
            </td>
            <?php endforeach?>
            </tr>
        </table>
        <a class="return" href="addTeacher.php">Ajouter un ensigant</a>
        <footer>
            <div class="copyright">
            <hr>
            <p>Copyright Lucie De Oliveira - 2022</p>
            </div>
        </footer>
    </body>
</html> 