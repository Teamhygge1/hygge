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
    <a class="navbar-brand" href="#">hygge</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">startseite <span class="sr-only">(current)</span></a>
            </li>
            <li>
                <button type="button" class="btn btn-outline-danger">logout</button>
            </li>

            <li>
    </div>

    <ul class="nav navbar-nav navbar-right">
 <?php

 $sql = "SELECT * FROM Posts WHERE status='0'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $anzahl_benachrichtigungen = $statement->rowCount();

        ?>

        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="label label-pill label-danger count" style="border-radius:10px;"><?php echo $anzahl_notification ?></span>
                <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>
            </a>

            <ul class="dropdown-menu">

                <?php

                if ($anzahl_benachrichtigungen > 0) {


                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $rows = array();


                    while ($row = $query->fetch())
                        $rows[] = $row;
                    foreach ($rows as $row) {

                        ?>

                        <a class="dropdown-item"
                           href="../webpage/do_gelesen.php?channel=<?php echo $row['channel'] ?>&posts_id=<?php echo $row['posts_id'] ?>">
                            <small><i>
                                    <?php
                                    echo date('F j, Y, g:i a', strtotime($row['date']));
                                    ?>
                                </i></small>
                            <br/>
                            <div>
                                Ein neuer Beitrag von
                                <?php
                                echo $row['email']; ?>:
                                <br>
                                <?php
                                echo $row['body'] ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <?php
                    }
                    ?>

                    <div class="dropdown-divider"></div>
                    <?php

                }
                else {
                    echo 'Keine neuen Nachrichten.';
                }
                ?>


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