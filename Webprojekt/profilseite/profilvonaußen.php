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
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Profilseite</title>
</head>
<body>

<div id="profilseite">
    <div class="col-4">
        <div class="hintergrund">
            <h1>Herzlich Willkommen auf der Profilseite von <?php echo $id_andere?> </h1>

            <h4>Das ist <?php echo $id_andere?> </h4>

            <form method="get" action="Bild2.php" enctype="multipart/form-data">
            </form>


        </div>
        <div class="info">
            <h3>Infos über <?php echo $id_andere?>: </h3>
            <form method="get" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
                <!-- <p><label>Meine Infos:<br></label</p> -->
                <textarea name="Informationen"></textarea>
                <?php
                session_start();
                $sql = "SELECT Informationen FROM profil";
                foreach ($pdo->query($sql) as $row) {
                    echo $row['Informationen'] . "<br />";
                }
                ?>

            </form>
        </div>

        <div class="posts">
            <h3>:</h3>

            <form method="get" action="postrauslesen.php" id="posts" enctype="multipart/form-data">
            </form>
        </div>
    </div>
</div>
</body>
