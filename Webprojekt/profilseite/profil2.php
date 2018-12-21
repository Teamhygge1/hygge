<?php
require('../header2.php');
require('../datenbank.php');

$email = "jg119@hdm-stuttgart.de";
$select_sql = $db->prepare("SELECT 'HdM Email' FROM Profil");
$profil = $select_sql->execute();
echo $profil;
?>


<div id="Profilseite">
    <div class="col-4">


        <div class="container container-content">
            <div class="row">
                <div class="col-md-4 img">
                    <img src="IMG_5903.JPG" height="1000px">
                </div>

                <div class="col-md-4"
                <h3>Infos Über mich:</h3>

                <?php

                echo $profil;
                ?>      </div>
            <div>
                <h3>Meine Posts:</h3>

                <?php
                $statement = $db->prepare("SELECT 'text','bild','gefühl' FROM 'postings' WHERE $email='Hdm Email'");
                $result = $statement->execute();
                ?>
            </div>
        </div>

    </div>
</div>
</div>
