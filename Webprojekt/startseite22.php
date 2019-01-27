<?php
include("header2.php");
include_once ("datenbank.php");
session_start();
?>


<!DOCTYPE html>
<html>
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
                        <legend> Hygellige Beiträge</legend>

                            <p>

                                <?php
                                $statement = $pdo->prepare ( "SELECT * FROM `Posts` order by created_at ASC");
                                // $pdo = new PDO('mysql::host=mars.iuk.hdm-stuttgart.de;dbname=u-as327', 'as327', 'LahMaedae1');
                                $sql = "SELECT * FROM Posts";
                                foreach ($pdo->query($sql) as $row) {
                                    $email= $row['email'];
                                    echo "<a href='./profilseite/profilvonaußen.php?andere=$email'>".$email."</a> schrieb: <br/>
                        ".$row['Body']."<br/>";
                                    echo "<div class= 'post'>"."geschrieben am:" .$row['created_at']."<br /> <br/> </div>";
                                }
                                ?>
                            </p>
                    </fieldset>
                </form>







</body>
</html>


