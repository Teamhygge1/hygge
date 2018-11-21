<?php
include_once('../header 2.php');
session_start();
$email = 'jg119@hdm-stuttgart.de';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<div id="Profilseite">
    <div class="col-4">


<div class="container">
    <div class="row">
        <div class="col-md-6 img">
            <img src="rizky-subagja-1155257-unsplash.jpg"  alt="" class="img-rounded">
        </div>
         <div class="col-md-6 details" id="Benutzerinfo"
            <h3>Infos Über mich:</h3>
            <?php
            $statement = $pdo->prepare("SELECT 'E-Mail', 'Name', 'Kürzel', 'Studiengang' FROM 'Profil' WHERE $email='E-Mail'");
            $result = $statement->execute();
            while ($zeile = $result->fetchObject()) {
                echo "<ul>$zeile</ul>";
            }

            ?>


            <div id="posts">
            <h3>Meine Posts:</h3>
            <?php
            $statement = $pdo->prepare("SELECT 'E-Mail',  FROM 'Posts' WHERE $email='E-Mail'");
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