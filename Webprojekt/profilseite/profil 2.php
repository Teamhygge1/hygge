<?php
require ('../header2.php');
require ('datenbank.php');

$email = 'jg119@hdm-stuttgart.de';
?>


<div id="Profilseite">
    <div class="col-4">


<div class="container container-content">
    <div class="row">
        <div class="col-md-4 img">
            <img src="rizky-subagja-1155257-unsplash.jpg" style="height: 400px; width:400px;" alt="" class="img-rounded">
        </div>

         <div class="col-md-4"
            <h3>Infos Über mich:</h3>
            <?php
            $statement = $db->prepare("SELECT 'E-Mail', 'Name', 'Kürzel', 'Studiengang' FROM 'Profil' WHERE $email='E-Mail'");
            $result = $statement->execute();
            while ($zeile = $result->fetchObject()) {
                echo "<ul>$zeile</ul>";
            }

            ?>


            <div>
            <h3>Meine Posts:</h3>
            <?php
            $statement = $db->prepare("SELECT 'E-Mail',  FROM 'Posts' WHERE $email='E-Mail'");
            $result = $statement->execute();
            while ($zeile = $result->fetchObject()) {
                echo "<ul>$zeile</ul>";
            }

            ?>
            </div>
    </div>

        </div>
    </div>
</div>