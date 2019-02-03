<?php
session_start();
include('../header2.php');          //Einbinden des Headers
include ('../follow.php');          //Einbinden der Follow Funktion
require('../datenbank.php');        //Einbinden der Datenbank
$id_andere = $_GET["andere"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
$email = $_SESSION["email"];
//Posts in Datenbank schreiben

?>



<!DOCTYPE html>
<html lang="de">
<head>
    <link rel = stylesheet style =text/css href="../profilvonaussen_CSS.css" media = screen>    <!--Einbinden des Stylesheets-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Profilseitevonaussen</title>
</head>
<body>

<div class="logoutbutton">                  <!--Einbinden des Logout-Buttons-->

    <a  href="../logout.php" class="btn btn-outline-danger"> Logout </a>
</div>



<div id="profilseite">
    <div class="col-4">


            <h1>Herzlich Willkommen auf der Profilseite von <?php echo $id_andere?> </h1>           <!--Email welche über URL übergeben wird, wird ausgegeben-->



         <div id="profilbildausgabe">
            <h4>Das ist <?php echo $id_andere?> </h4>

             <button id="follow" name="follow" onclick="Location.href='follow.php'">Follow Me!</button>  <!--Follow Funktion-->
             <br>
            <?php
            $sql= "SELECT bild_id FROM users WHERE email=:id_andere";           //Auslesen der Bildid aus der Datenbank
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row=$statement->fetch()){
                $profilbild=$row['bild_id'];

                echo "<img src='upload/$profilbild'>";          //Hochladen des Profilbildes aus dem Ordner Upload mit der passenden ID
            }
            ?>
    </div>

        </div>




            <h3>Infos über <?php echo $id_andere?>: </h3>
    <div class="info">
            <?php
            $sql = "SELECT `Informationen` FROM `profil2` WHERE email=:id_andere";          //Auslesen der Informationen aus der Datenbank
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row = $statement->fetch()) {
                echo $row['Informationen']."<br />";
            }
            ?>

        </div>

        <div class="postings">


            <form id="formpostings">

            <h5> Posts von <?php echo $id_andere?> :</h5>
            <?php
            $sql = "SELECT * FROM `Posts` WHERE email=:id_andere order by created_at DESC";         //Auslesen der Posts aus der Datenbank
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row = $statement->fetch()) {
                $email= $row['email'];
                $postbild = $row['bild_id'];

                echo "<div class='posts'>";
                echo "<br/> ".$row['Body']."<br/>";
                echo "geschrieben am: " .$row['created_at']."<br /> <br/>";
                echo "<img src='upload/$postbild'>";                                        //Ausgabe des Postbildes aus dem Ordner
                echo "</div>";
            }

            ?>


            </form>
        </div>



    </div>
</body>
</html>
