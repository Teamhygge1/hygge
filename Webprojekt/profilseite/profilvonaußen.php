<?php
session_start();
include('../header2.php');
include ('follow.php');
require('../datenbank.php');
$id_andere = $_GET["andere"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
$email = $_SESSION["email"];
//Posts in Datenbank schreiben


echo ($Informationen); //von riemke
?>



<!DOCTYPE html>
<html lang="de">
<head>
    <link rel = stylesheet style =text/css href="../profilvonaussen_CSS.css" media = screen>
    <meta name ="viewport" content = "width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Profilseitevonaussen</title>
</head>
<body>

<div class="button">

    <a  href="../logout.php" class="btn btn-outline-danger"> Logout </a>
</div>

<div id="profilseite">
    <div class="col-4">
        <div class="hintergrund">
            <h1>Herzlich Willkommen auf der Profilseite von <?php echo $id_andere?> </h1>
            <button id="follow" name="follow" onclick="Location.href='follow.php'">Follow Me!</button>

            <h4>Das ist <?php echo $id_andere?> </h4>

            <?php
            $sql= "SELECT bild_id FROM users WHERE email=:id_andere";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row=$statement->fetch()){
                $profilbild=$row['bild_id'];

                echo "<img src='upload/$profilbild'>";
            }
            ?>


        </div>
        <div class="info">
            <h3>Infos über <?php echo $id_andere?>: </h3>
            <?php
            $sql = "SELECT `Informationen` FROM `profil2` WHERE email=:id_andere";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row = $statement->fetch()) {
                echo $row['Informationen']."<br />";
            }
            ?>

        </div>

        <div class="posts">

            <h3> Posts von <?php echo $id_andere?> :</h3>
            <?php
            $sql = "SELECT * FROM `Posts` WHERE email=:id_andere order by created_at DESC";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":id_andere" => $id_andere));
            while ($row = $statement->fetch()) {
                $email= $row['email'];
                $postbild = $row['bild_id'];
                echo "<br/>
                        ".$row['Body']."<br/>";
                echo "geschrieben am: " .$row['created_at']."<br /> <br/>";
                echo "<img src='upload/$postbild'>";

            }



            ?>


            </form>
        </div>
    </div>
</div>
</body>
</html>
