<?php
include('../header2.php');
require('../datenbank.php');
session_start();
$id_andere = $_GET["andere"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
//$email = $_SESSION["email"];
//Posts in Datenbank schreiben


echo ($Informationen); //von riemke


$sql = "INSERT INTO profil (User, Informationen) VALUES ( ?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array("$User", "$Informationen"));
$statement->bindParam(':Informationen', $_POST["Informationen"]);
$statement->bindParam(':User', $_POST["User"]);
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Profilseite</title>
    <link rel="stylesheet" type="text/css" href="Main.css" media="screen"/>
</head>
<body>

<div id="profilseite">
    <div class="col-4">
        <div class="hintergrund">
            <h1>Herzlich Willkommen auf deiner Profilseite</h1>

            <h4>Hüge ein Profilbild von dir hinzu</font></h4>

            <form method="post" action="Bild2.php" enctype="multipart/form-data">
            </form>

            <!-- Bilddatei:<br /> -->

            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Bild hochladen">

        </div>
        <div class="info">
            <h3>Infos über dich: </h3>
            <form method="post" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
                <!-- <p><label>Meine Infos:<br></label</p> -->
                <textarea name="Informationen">Schreibe etwas über dich...</textarea>
                <input type="submit" value="speichern">


            </form>
        </div>

        <div class="posts">
            <h3>Deine Posts:</h3>

            <form method="get" action="postrauslesen.php" id="posts" enctype="multipart/form-data">
            </form>
        </div>
    </div>
</div>
</body>
