<?php
session_start();
include "datenbank.php";
$email = $_SESSION["email"];
// if (!isset($_SESSION['email'])) {
//   header('location: login.php');
// }
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="profilseite/Main.css" media="screen"/>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">HYGGE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="startseite22.php">Startseite <span class="sr-only">(current)</span></a>
            </li>
            <li>
                <a class="nav-link" href="profil2.php"> Dein Profil <span class="sr-only">(current)</span> </a>


            </li>

            <li>

                <a  href="logout.php" class="btn btn-outline-danger"> Logout </a>
            </li>


    </div>

    <ul class="nav navbar-nav navbar-right">
        <?php

        // $sql = "SELECT * FROM Posts WHERE status='0'";
        // $statement = $pdo->prepare($sql);
        // $statement->execute();
        //  $anzahl_benachrichtigungen = $statement->rowCount();

        ?>

        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="label label-pill label-danger count"
                      style="border-radius:10px;"><?php echo $nachrichten ?></span>
                <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>
            </a>


            <ul class="dropdown-menu">

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="dropdown01" style="color: #0068ff"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Benachrichtigungen
                        <?php //hier werden die ungelesenen nachrichten ausgelesen
                        $nachrichten = 0;
                        $statement = $pdo->prepare("SELECT * FROM Posts WHERE status='0' AND email = ANY (SELECT following from following WHERE email=:email)"); //nimm alls spalten aus der tabelle null wo gelesen auf null gessetzt ist, also die posts die noch ungelesen sind
                        $statement->execute(array(":email" => "$email"));
                        $anzahl = $statement->rowCount(); //zähle die zeilen in der tabelle wo er NULL findet und zeige die anzahl der spalten als anzahl der benachrichtigungen an
                        ?>
                        <span class="badge badge-primary"><?php echo $anzahl ?></span>
                        <!--er soll die variable an dieser stelle ausgeben-->
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdown01">

                        <?php // wenn es Nachrichten gibt, dann zeige Klasse 'dropdown-item', ansonsten führe else aus 'Keine neuen Nachrichten'
                        if ($nachrichten > 0) {
                            $sql = "SELECT * from Posts WHERE status='0' AND email = ANY (SELECT following from following WHERE email=:email)";
                            $statement = $pdo->prepare($sql);
                            $statement->execute(array(":email" => "$email"));
                            $row = array();
                            while ($row = $statement->fetch()) {

                               echo '<div>' . $row["email"] . 'schrieb:</div>';
                                echo '<div>' . $row["Body"] . '</div>';
                               echo '<div class="dropdown-divider"></div>';
                            }     } else {
                            echo 'Keine neuen Nachrichten';
                        }
                        ?>
                    </div>
                </li>
            </ul>

        </li>

    </ul>

    </div>
    </li>
    </ul>

    </div>
</nav>
<br/><br/>


</body>

</html>