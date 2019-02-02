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


    <!-- Bootsstrap einbinden-->
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>

<!-- Navbar mit Verlinkungen-->
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


        <li class="dropdown">


            <!--Benachrichtugungen Anzeige im Header -->

                    <a class="nav-link" href="#" id="dropdown" style="color: #0068ff"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Benachrichtigungen




                        <?php


                        $nachrichten = 0; // Variable wird bestimmt, um später den RowCount zu machen

                        $statement = $pdo->prepare("SELECT * FROM Posts WHERE status='0' AND email = ANY (SELECT following FROM following WHERE email = :email)");
                        //alles aus der Post Tabelle, mit dem Status 0 und aus der Following Tabelle nur die Leute denen die aktuell eingeloggte E-Mail folgt.


                        $statement->execute(array(":email" => $email));
                        $nachrichten = $statement->rowCount(); //Addieren der Posts mit dem Status 0
                        ?>



                        <span class="label label-pill label-danger count"
                              style="border-radius:10px;"><?php echo $nachrichten ?></span>
                        <!--Hier wird die Anzahl der Nachrichten ausgegeben (also nur die Zahl)-->
                    </a>



                    <div class="dropdown-menu" aria-labelledby="dropdown">

                        <?php

                        // wenn es nach dem Row Count mehr als Null Nachrichten gibt, zeige alle Posts von Leuten, denen ich folge.
                        if ($nachrichten > 0) {
                            $statement = $pdo->prepare("SELECT * FROM Posts WHERE status='0' AND email = ANY (SELECT following FROM following WHERE email = :email)");
                            $row = array();
                            while ($row = $statement->fetch()) {

                                // Anzeige im Dropdown der Nachrichten

                                echo "<div> <a href='./profilseite/profilvonaußen.php?andere=".$row['email']."'>".$row['email']."</a> schrieb: </div>";
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