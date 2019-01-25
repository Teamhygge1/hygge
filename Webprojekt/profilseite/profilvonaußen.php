<?php
include('../header2.php');
require('../datenbank.php');
session_start();
$id_andere = $_GET["id_andere"];
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
            <?php
            $sql = "SELECT 'Informationen' FROM `profil` WHERE email=:$id_andere";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":email"=>"$id_andere"));
            $statement->bindParam(':email', $_SESSION["email"]);
            while ($row=$statement->fetch()) {
                $email = $row['email'];
                echo "<br/>
                        " . $row['Informationen'] . "<br/>";
            }
            ?>

        </div>

        <div class="posts">

        <h3> Posts:</h3>
        <?php
        $sql = "SELECT * FROM `Posts` WHERE email=:$id_andere order by created_at DESC";
        $statement = $pdo->prepare($sql);
        $statement->execute(array(":email"=>"$id_andere"));
        $statement->bindParam(':email', $_SESSION["email"]);
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
