<?php
require('../header2.php');
require('../datenbank.php');

$email = $_POST['user'];
$password = $_POST['passwort'];

($email =='email' AND $password =='password')


//$select_sql = $db->prepare("SELECT 'HdM Email' FROM Profil");
//$profil = $select_sql->execute();
//echo $profil;
//?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profilseite</title>
        <link rel="stylesheet" type="text/css" href="Main.css" media="screen"/>
    </head>
    <body>

    <div id="profilseite">
    <div class="col-4">

             <h1>Herzlich Willkommen auf deiner Profilseite</h1>

            <h4>Hüge ein Profilbild von dir hinzu</font></h4>

        <form method="post" action="image_upload.php" enctype="multipart/form-data">

            Bilddatei:<br />

            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Bild hochladen" name="submit">

    </div>
                <div class="info">
                 <h3>Infos über mich: </h3>

           <!-- <div class="row"> -->
                <textarea name="Informationen" >Schreibe etwas über dich... </textarea>
               <!-- <span id="count"></span> -->
            <!--</div> -->
        </div>

            <div class="posts">
                <h3>Meine Posts:</h3>

                <?php
                $statement = $db->prepare("SELECT 'text','gefühl' FROM 'posts' WHERE $email= 'HdM Email'");
                $result = $statement->execute();
                ?>
            </div>
    </div>
    </body>
</html>