<?php
include("header2.php");
include_once ("datenbank.php");
include ("action.php");
session_start();
$user = $_GET["user"];
$Body = $_POST["Body"];
$email = $_SESSION["email"];
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" type="text/css" href="Starteite_style.css" media="screen" />
    <meta name="viewport" content="width=device-width, initial-scale=1">




</head>

<body>

<h2 >Willkommen zurück <?php echo $email ?> ! </h2>

<div class="postingsschreiben">
<?php include ("postings_schreiben_2.php") ?>
</div>


                  <div class="button">

                        <form id= "deinprofil" action="profilseite/profil2.php?"> <br>
                            <input onmouseenter="" type="submit" value="Dein Profil">

                        </form>

                         </div>







<div class="beiträge">
                <form method ="post">
                    <fieldset>
                        <legend> Hyggellige Beiträge</legend>

                            <p>

                                <?php
                                $statement = $pdo->prepare ( "SELECT * FROM `Posts` order by created_at ASC");
                                $sql = "SELECT * FROM Posts";

                                $statement= $pdo->prepare("SELECT bild_id FROM users WHERE email=:email");
                                $statement->execute(array(":email"=>"$email"));
                                $statement->bindParam(':email', $_SESSION["email"]);

                               while ($row=$statement->fetch()) {
                                   $profilbild = $row['bild_id'];

                                   $profilbild = $row['bild_id'];
                                   if ($Body != NULL) {
                                       echo("$Body");
                                   } else {
                                       echo "<img src='upload/$bild_id'>";
                                   }
                                   foreach ($pdo->query($sql) as $row) {
                                   }
                                   $email = $row['email'];

                                   echo "<img src='upload/$profilbild'><br>";
                                   echo "<a href='./profilseite/profilvonaußen.php?andere=$email'>" . $email . "</a> schrieb: <br/>
                                    " . $row['Body'] . "<br/>";
                                   echo "<div class= 'post'>" . "geschrieben am:" . $row['created_at'] . "<br /> <br/> </div>";
                               }
                                ?>

                            </p>
                    </fieldset>
                </form>







</body>
</html>


