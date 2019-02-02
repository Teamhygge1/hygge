

<?php
include('../header2.php');
require('../datenbank.php');
session_start();
$email = $_SESSION["email"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
//$email = $_SESSION["email"];
//Posts in Datenbank schreiben





?>


<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="profil2_css.css" media="screen" />
    <meta charset="UTF-8">
    <title>Profilseite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<a  href="../logout.php" class="btn btn-outline-danger"> Logout </a>

<div>
<div id="profilseite">

            <h1>Herzlich Willkommen auf deiner Profilseite</h1>


    <div id="absolute">


    <div class="upload">

        <h4>Füge ein Profilbild von dir hinzu</font></h4>



        <form method="post" action="upload2.php" enctype="multipart/form-data">

            <input type="file" name="BildZumHochladen" id="BildZumHochladen">
            <input type="submit" value="Bild hochladen" name="submit">

            <?php
            $statement= $pdo->prepare("SELECT bild_id FROM users WHERE email=:email");
            $statement->execute(array(":email"=>"$email"));
            $statement->bindParam(':email', $_SESSION["email"]);

            while ($row=$statement->fetch()){
                $profilbild=$row['bild_id'];



                echo " <div class='profilbild'> <img src='upload/$profilbild'> </div>";
            }

            ?>

        </form>

    </div>


    <div class="info">
        <h5>Infos über dich: </h5>



        <form method="post" action="profil2.php">

            <textarea name="Informationen" placeholder="Schreibe etwas über dich..."></textarea>
            <input name="submit" type="submit" value="speichern">

        </form>

        <?php
        if(isset($_POST["submit"])){
            $sql = "INSERT INTO profil2 (email, Informationen) VALUES ( ?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->execute(array("$email", "$Informationen"));
            $statement->bindParam(':Informationen', $_POST["Informationen"]);
            $statement->bindParam(':email', $_SESSION["email"]);
        }
        ?>


        <div id="alleinfos"


        <?php
        $sql = "SELECT `Informationen` FROM `profil2` WHERE email=:email";
        $statement = $pdo->prepare($sql);
        $statement->execute(array(":email"=>"$email"));

        while ($row = $statement->fetch()) { // geht Datenbank durch --> gibt alle Treffer aus
            echo $row['Informationen']."<br />";
        }
        ?>
    </div>

    </div>




        <!-- <div class="row">
    <textarea name="Informationen" >Schreibe etwas über dich... </textarea>
        <form method="post" action="Infospeichern.php" id="info" enctype="multipart/form-data">
        <input type="submit" value="Speichern">
        </form>
   <!-- <span id="count"></span> -->
        <!--</div> -->



    <div class="deineposts">
            <h3>Deine Posts:</h3>
            <?php
            $sql = "SELECT * FROM Posts WHERE email=:email order by created_at DESC";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":email" => "$email"));
            $statement->bindParam(':email', $_SESSION["email"]);
            while ($row = $statement->fetch()) {
                $email = $row['email'];
                $postbild = $row['bild_id'];
                echo "<div class='posts'>";
                echo "fühlt sich: ".$row['gefühl']." <br/>
                    und schrieb:    " . $row['Body'] . "<br/>";
                echo "geschrieben am: " . $row['created_at'] . "<br /> <br/>";
                echo "<img src='upload/$postbild'>";
                $post_id = $row['ID']; //welche ID es nehmen soll zum post löschen
                echo "<button>
                                <a href='../löschen.php?id=$post_id'>Löschen</a>
                        </button> <br>";
               echo"</div>";
           }
           /* while ($row = $statement->fetch()) {
                $postbild = $row['bild_id'];

                echo "<img src='upload/$postbild'>";


            } */
            ?>

    </div>
</div>
</div>
</body>
</html>