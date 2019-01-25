

<?php
include('../header2.php');
require('../datenbank.php');
session_start();
$email = $_SESSION["email"];
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
//$email = $_SESSION["email"];
//Posts in Datenbank schreiben



$sql = "INSERT INTO profil (email, Informationen) VALUES ( ?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array("$email", "$Informationen"));
$statement->bindParam(':Informationen', $_POST["Informationen"]);
$statement->bindParam(':email', $_SESSION["email"]);
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
             <h1>Herzlich Willkommen auf deiner Profilseite</h1>



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
                        echo "<img src='upload/$profilbild'>";
                    }

                    ?>

                </form>

    </div>
                <div class="info">
                 <h3>Infos über dich: </h3>
                    <form method="post" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
                       <!-- <p><label>Meine Infos:<br></label</p> -->
                        <textarea name="Informationen" placeholder="Schreibe etwas über dich..."> <?php echo ($Informationen); //von riemke ?></textarea>
                        <input type="submit" value="speichern">




                    </form>
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
                    $sql = "SELECT * FROM `Posts` WHERE email=:email order by created_at DESC";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(":email"=>"$email"));
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