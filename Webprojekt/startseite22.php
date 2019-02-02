<?php
include("header2.php");
include_once("datenbank.php");
include("action.php");
session_start();
$user = $_GET["user"];
$email = $_SESSION["email"];
$id_andere = $_GET["andere"];
$profilbild = $_POST["bild_id"];
$postbild = $_POST ["bild_id"];
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="Starteite_style.css" media="screen"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>


<h2>Willkommen zurück <?php echo $email ?> ! </h2>

<div class="postingsschreiben">
    <?php include("postings_schreiben_2.php") ?>
</div>


<div class="button">

    <form id="deinprofil" action="profilseite/profil2.php?"><br>
        <input onmouseenter="" type="submit" value="Dein Profil">

    </form>

</div>


<div class="beiträge">
    <form method="post">

            <legend> Hyggellige Beiträge</legend>



                <?php
                $sql1 = "SELECT bild_id FROM users WHERE email= 1";
                $statement = $pdo->prepare($sql1);                                       //Gibt das Profilbild aus
                $statement->execute(array(":email" => "email"));

                while ($row_bild = $statement->fetch()) {

                    $profilbild = $row_bild['bild_id'];

                }

                $sql = "SELECT * FROM Posts ORDER BY created_at DESC ";
                $statement = $pdo->prepare($sql);
                $statement->execute();
                while ($row = $statement->fetch()) { // geht Datenbank durch --> gibt alle Treffer aus

                    $profilbild = $row_bild['bild_id'];
                    $post_id = $row['ID'];
                    if ($row['Body'] != NULL) {





                        if ($row['gefühl'] != NULL ){

                            echo "<div class='postausgabe'>";
                        echo "<div> <a href='./profilseite/profilvonaußen.php?andere=".$row['email']."'>".$row['email']."</a> fühlt sich: ".$row['gefühl']."</div>";
                        echo "<br/> " . $row['Body'] . "<br/>";


                            echo "<div class= 'post'>" . "geschrieben am:" . $row['created_at'] ." <div class='profilbild'><img src='./profilseite/upload/$profilbild'> </div> <br><br/></div>";


                            echo "</div>";




                        }else{

                            echo "<div class='postausgabe'>";
                            echo "<a href='./profilseite/profilvonaußen.php?andere=".$row['email']."'>" . $row['email']. "</a> schrieb: <br/>
                                    " . $row['Body'] . "<br/>";
                            echo "<div class= 'post'>" . "geschrieben am:" . $row['created_at'] . "<br /> <br/> </div>";



                            echo "</div>>";
                        }




                    }


                    else {
                        echo "<div class='postausgabe'>";

                        echo "<img src='./profilseite/upload/$postbild'>";



                        echo "</div>";
                    }


                }


                ?>


</form>

</div>



</body>
</html>


