<?php
/**
 * Auteur   	: w3schools.com
 * Modifié par 	: Serghei Diulgherov
 * Date     	: 22.05.2022
 * tool to upload file to server
 */
$target_dir    = "resources/image/recipes/";
$target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk      = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"]))
{
	$check         = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false)
	{
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	}
	else
	{
		$_SESSION['error']      = "Le fichier n'est pas une image.";
        header("Location: index.php?controller=home&action=error");
        die();
		$uploadOk = 0;
	}
}

// Check if file already exists
if (file_exists($target_file))
{
	$_SESSION['error']          = "L'image existe déja.";
	header("Location: index.php?controller=home&action=error");
	die();
	$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000)
{
	$_SESSION['error']          = "L'image est trop grande.";
	header("Location: index.php?controller=home&action=error");
	die();
	$uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
{
	$_SESSION['error']          = "Seulement les images de type JPG, JPEG & PNG sont autorisées";
	header("Location: index.php?controller=home&action=error");
	die();
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
	$_SESSION['error']          = "Nous sommes désolés, l'image n'a pas pu être importée.";
	header("Location: index.php?controller=home&action=error");
	die();
	// if everything is ok, try to upload file
}
else
{
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
	{
		echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
	}
	else
	{
		$_SESSION['error'] = "Il y a eu une erreur lors de l'importation de l'image";
		header("Location: index.php?controller=home&action=error");
		die();
	}
}
?>
