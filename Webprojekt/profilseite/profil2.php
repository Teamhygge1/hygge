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


<div id="Profilseite">
    <div class="col-4">


        <h2>Bild hochladen</font></h2>

        <form method="post" action="image_upload.php" enctype="multipart/form-data">

            Bilddatei:<br />

            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Bild hochladen" name="submit">

                </div>

                <div class="col-md-4"
                <h3>Infos Über mich:</h3>
                <label for="description">Schreibe etwas über dich...</label>
                <input type="text" name="Infotext" maxlength="200">
                <?php

                echo $profil;
                ?>
            </div>
            <div>
                <h3>Meine Posts:</h3>

                <?php
                $statement = $db->prepare("SELECT 'text','gefühl' FROM 'postings' WHERE $email='HdM Email'");
                $result = $statement->execute();
                ?>
            </div>
        </div>

    </div>
</div>
</div>

