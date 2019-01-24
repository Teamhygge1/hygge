<?php
require('../header2.php');
require('../datenbank.php');
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Profilseite</title>
        <link rel="stylesheet" type="text/css" href="Main.css" media="screen"/>
    </head>
    <body>

    <div id="profilseite">
    <div class="col-4">
            <div class="hintergrund">
             <h1>Herzlich Willkommen auf deiner Profilseite</h1>

            <h4>Hüge ein Profilbild von dir hinzu</font></h4>

        <form method="post" action="Bild.php" enctype="multipart/form-data">

           <!-- Bilddatei:<br /> -->

            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Bild hochladen">

    </div>
                <div class="info">
                 <h3>Infos über mich: </h3>

           <!-- <div class="row"> -->
                <textarea name="Informationen" >Schreibe etwas über dich... </textarea>
                    <input type="submit" value="Speichern">
                    <form method="post" action="Infospeichern.php" enctype="multipart/form-data">
               <!-- <span id="count"></span> -->
            <!--</div> -->
        </div>

            <div class="posts">
                <h3>Meine Posts:</h3>

                <form method="post" action="postrauslesen.php" enctype="multipart/form-data">
            </div>
    </div>
    </div>
    </body>
</html>