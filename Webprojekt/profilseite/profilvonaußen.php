<?php
session_start();
include('../header2.php');
require('../datenbank.php');
$id_andere = $_GET["andere"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
$email = $_SESSION["email"];
//Posts in Datenbank schreiben
include "../datenbank.php";
include "../follow.php";

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




            <button   id="Button" name="Button" onClick='location.href="follow.php"'>Follow Me <3</button>





            <h4>Das ist <?php echo $id_andere?> </h4>

            <form method="get" action="Bild2.php" enctype="multipart/form-data">
            </form>


        </div>
        <div class="info">
            <h3>Infos über <?php echo $id_andere?>: </h3>
            <?php
            $sql = "SELECT 'Informationen' FROM `profil` WHERE email= andere";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            while ($row=$statement->fetch()) {
                $email = $row['email'];
                echo "<br/>
                        ". $row['Informationen']."<br/>";
            }
            ?>

        </div>

        <div class="posts">

        <h3> Posts:</h3>
        <?php
        $sql = "SELECT * FROM `Posts` WHERE email=:id_andere order by created_at DESC";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id_andere', $_GET["andere"]);
        while ($row=$statement->fetch())  {
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
