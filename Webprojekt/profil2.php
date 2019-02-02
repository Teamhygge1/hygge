

<?php
include('../header2.php');
require('../datenbank.php');

session_start();
$email = $_SESSION["email"];
$Informationen = $_POST["Informationen"]; // get oder post
$post_id = $row['ID']; //welche ID es nehmen soll zum post löschen
//$post_id = $_GET["id"];





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



<div id="profilseite">
    <div class="col-4">
        <div class="hintergrund">
            <h1>Herzlich Willkommen auf deiner Profilseite</h1>



            <h4>Füge ein Profilbild von dir hinzu</font></h4>


            <div class="upload">
                <form method="post" action="upload2.php" enctype="multipart/form-data">

                    <input type="file" name="BildZumHochladen" id="BildZumHochladen">
                    <input type="submit" value="Bild hochladen" name="submit">

                    <?php
                    $statement= $pdo->prepare("SELECT bild_id FROM users WHERE email=:email");
                    $statement->execute(array(":email"=>"$email"));
                    $statement->bindParam(':email', $_SESSION["email"]);

                    while ($row=$statement->fetch()){
                        $profilbild=$row['bild_id'];



                        echo "<img src='upload/$profilbild'>";
                    }

                    ?>

                </form>
            </div>

        </div>





        <div class="info">
            <h3>Infos über dich: </h3>



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


        </div>



        <div class="posts">
            <h3>Alle deine Informationen:</h3>
            <?php
            $sql = "SELECT `ID`, `Informationen`, `email` FROM `profil2` WHERE 1";
            foreach ($pdo->query($sql) as $row) {
                echo $row['ID']." ".$row['Informationen']."<br />";
                echo "E-Mail: ".$row['email']."<br /><br />";
            }
            ?>


        </div>


        <!-- <div class="row">
    <textarea name="Informationen" >Schreibe etwas über dich... </textarea>
        <form method="post" action="Infospeichern.php" id="info" enctype="multipart/form-data">
        <input type="submit" value="Speichern">
        </form>
   <!-- <span id="count"></span> -->
        <!--</div> -->

        <div class="posts">
            <h3>Deine Posts:</h3>
            <?php
            $sql = "SELECT * FROM Posts WHERE email=:email order by created_at DESC";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(":email" => "$email"));
            $statement->bindParam(':email', $_SESSION["email"]);
            while ($row = $statement->fetch()) {
                $email = $row['email'];
                echo "<br/>
                        " . $row['Body'] . "<br/>";
                echo "geschrieben am: " . $row['created_at'] . "<br /> <br/>";

                $post_id = $row['ID']; //welche ID es nehmen soll zum post löschen

                echo "</div>";
                echo "<button>
                                <a href='löschen.php?id=$post_id'>Löschen</a>
                        </button> <br>";

            }

            while ($row = $statement->fetch()) {
                $profilbild = $row['bild_id'];

                echo "<img src='upload/$profilbild'>";
                echo "</div>";
                echo "<button>
                                <a href='löschen.php?id=$post_id'>Löschen</a>
                        </button> <br>";

            }
            ?>
        </div>
    </div>
</div>
</body>
</html>