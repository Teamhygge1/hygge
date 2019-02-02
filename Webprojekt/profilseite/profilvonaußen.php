<?php
session_start();
include('../header2.php');
include ('../follow.php');
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
    <meta charset="UTF-8">
    <title>Profilseite</title>
</head>
<body>

<div id="profilseite">
    <div class="col-4">
        <div class="hintergrund">
            <h1>Herzlich Willkommen auf der Profilseite von <?php echo $id_andere?> </h1>
            <?php
            $sql = "SELECT * FROM following WHERE (email=:email AND following=:id_andere)";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":email"=>$email, ":id_andere"=>$id_andere));
            $row=$statement->fetch() ;

                if ($id_andere == $row['following']) {
                    ?>
                    <button id="follow" name="follow" onclick="Location.href='follow.php'">Follow Me!</button>

                    <?php
                }
                else{
                    ?>
                    <button id="follow" name="follow" onclick="Location.href='unfollow.php'">Unfollow Me!</button>
                <?php

                }

            ?>
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
            echo "<br/>
                        ".$row['Body']."<br/>";
            echo "geschrieben am: " .$row['created_at']."<br /> <br/>";

        }



        ?>


        </form>
    </div>
    </div>
</div>
</body>
</html>
