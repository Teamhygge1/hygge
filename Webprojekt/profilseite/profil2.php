

<?php
include('../header2.php');      //Einbinden des Headers
require('../datenbank.php');        //Einbinden der Datenbank mit reqiure, damit ohne sie nichts läuft
session_start();
$email = $_SESSION["email"];
$Informationen = $_POST["Informationen"]; // get oder post

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="profil2_css.css" media="screen" />     <!--Einbinden des Stylesheets-->
    <meta charset="UTF-8">
    <title>Profilseite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<a  href="../logout.php" class="btn btn-outline-danger"> Logout </a>            <!--Einbinden des Logout Buttons-->

<div>
<div id="profilseite">

            <h1>Herzlich Willkommen auf deiner Profilseite</h1>


    <div id="absolute">


    <div class="upload">

        <h4>Füge ein Profilbild von dir hinzu</font></h4>



        <form method="post" action="upload2.php" enctype="multipart/form-data">     <!--Formular zum Hochladen des Bildes mittels "Upload2.php-->

            <input type="file" name="BildZumHochladen" id="BildZumHochladen">
            <input type="submit" value="Bild hochladen" name="submit">

            <?php
            $statement= $pdo->prepare("SELECT bild_id FROM users WHERE email=:email");      //Auslesen der Bildid aus der Datenbank
            $statement->execute(array(":email"=>"$email"));
            $statement->bindParam(':email', $_SESSION["email"]);

            while ($row=$statement->fetch()){
                $profilbild=$row['bild_id'];



                echo " <div class='profilbild'> <img src='upload/$profilbild'> </div>"; //Hochladen des Profilbildes aus dem Ordner Upload mit der passenden ID
            }

            ?>

        </form>

    </div>


    <div class="info">
        <h5>Infos über dich: </h5>



        <form method="post" action="profil2.php">           <!--Formular zum Hochladen der Informationen zum Nutzer-->

            <textarea name="Informationen" placeholder="Schreibe etwas über dich..."></textarea>
            <input name="submit" type="submit" value="speichern">

        </form>

        <?php
        if(isset($_POST["submit"])){                                                //Bei drücken des Sumbit-Buttons wird folgender Befehl ausgeführt
            $sql = "INSERT INTO profil2 (email, Informationen) VALUES ( ?, ?)";     //In Datenbank Informationen einfügen
            $statement = $pdo->prepare($sql);
            $statement->execute(array("$email", "$Informationen"));
            $statement->bindParam(':Informationen', $_POST["Informationen"]);
            $statement->bindParam(':email', $_SESSION["email"]);
        }
        ?>


        <div id="alleinfos"


        <?php
        $sql = "SELECT `Informationen` FROM `profil2` WHERE email=:email";          //Auslesen der vorab gespeicherten Informationen aus der Datenbank
        $statement = $pdo->prepare($sql);
        $statement->execute(array(":email"=>"$email"));

        while ($row = $statement->fetch()) { // geht Datenbank durch --> gibt alle Treffer aus
            echo $row['Informationen']."<br />";
        }
        ?>
    </div>

    </div>


    <div class="deineposts">
            <h3>Deine Posts:</h3>
            <?php
            $sql = "SELECT * FROM Posts WHERE email=:email order by created_at DESC";       //Ausgabe der Posts aus der Datenbank
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":email" => "$email"));
            $statement->bindParam(':email', $_SESSION["email"]);
            while ($row = $statement->fetch()) {
                $email = $row['email'];
                $postbild = $row['bild_id'];
                echo "<div class='posts'>";
                echo "fühlt sich: ".$row['gefühl']." <br/>                 <!-- Ausgabe von Gefühlen aus der Datenbank-->
                    und schrieb:    " . $row['Body'] . "<br/>";
                echo "geschrieben am: " . $row['created_at'] . "<br /> <br/>";
                echo "<img src='upload/$postbild'>";                        //Ausgabe des Postbildes aus dem Ordner
                $post_id = $row['ID']; //welche ID es nehmen soll zum post löschen
                echo "<button>                                                    <!--Formular zum Löschen von Posts-->
                                <a href='../löschen.php?id=$post_id'>Löschen</a>       
                        </button> <br>";
               echo"</div>";
           }

            ?>

    </div>
</div>
</div>
</body>
</html>