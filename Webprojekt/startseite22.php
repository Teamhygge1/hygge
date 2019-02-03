<?php
include("header2.php"); //bindet den Header ein
include_once("datenbank.php"); //bindet Datei mit Datenbankverbindungsdaten ein
include("action.php"); //bindet action.php ein
session_start(); //Session starten
$user = $_GET["user"]; //user aus der URL nehmen
$email = $_SESSION["email"]; //welche Mailadresse in der aktuellen Session eingeloggt ist
$id_andere = $_GET["andere"]; //Parameter aus URL holen und zwischenspeichern
$profilbild = $_POST["bild_id"]; //variable für Profilbild deklarieren
$postbild = $_POST ["bild_id"]; //variable für gepostetes Bild deklarieren
?>


<!DOCTYPE html>
<html lang="de">
<head> <!-- im Head wir das Stylesheet eingebunden und Metadaten eingegeben-->
    <link rel="stylesheet" type="text/css" href="Starteite_style.css" media="screen"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Startseite</title>

</head>

<body>

<!-- Logoutbutton-->
<div class="button">

    <a  href="logout.php" class="btn btn-outline-danger"> Logout </a> <!-- Verlinkung auf die Logout Datei-->
</div>

<h2>Willkommen zurück <?php echo $email ?> ! </h2>

<div class="postingsschreiben"> <!-- die Datei zum Postings schreiben/Gefühl auswählen und Bilder hochladen wird eingebunden-->
    <?php include("postings_schreiben_2.php") ?>
</div>


<div class="beiträge">
    <form method="post">

        <legend> Hyggellige Beiträge</legend>


        <?php
        //sql Befehl um alles aus der Tabelle Posts auszulesen, in absteigender Reihenfolge
        $sql = "SELECT * FROM `Posts` ORDER BY created_at DESC ";
        $statement = $pdo->prepare($sql); //bereitet das Statement vor
        $statement->execute(); //führt das Statement aus
        while ($row = $statement->fetch()) { // geht Datenbank durch und gibt alle Treffer aus

            $postbild = $row['bild_id']; //deklariert Variabel $postbild
            $profilbild = $row['bild_id']; //deklariert Variabel $profilbild

            if ($row['Body'] != NULL) { // If-Schleife mit Bedingung : dass die Spalte Body nicht NULL ist.


                if ($row['gefühl'] != NULL) {
                    //If-Schleife mit Bedingung: wenn die Spalte gefühl nicht NULL ist wird folgendes ausgegeben:






                    echo "<div class='postausgabe'>"; //definiert den div als Klasse die postausgabe heißt

                    echo "<div> <a href='./profilseite/profilvonaußen.php?andere=" . $row['email'] . "'>" . $row['email'] . "</a> fühlt sich: " . $row['gefühl'] . "</div>";
                    //gibt aus wer den Post schrieb, mit href-Verlinkung auf diese Mail sowie Gefühl

                    echo "und schrieb: <br/> " . $row['Body'] . "<br/>"; //gibt Text des Posts aus

                    echo "<div class= 'post'>" . "geschrieben am:" . $row['created_at'] . " <div class='profilbild'> 
                    <img src='./profilseite/upload/$profilbild'> </div> <br><br/></div>";
                    // viertes Echo: wann der Post geschrieben wurde und das Profilbild werden in der Klasse post ausgegeben.

                    echo "</div>";


                }


            } else {
                //wenn If-Schleife mit Bedingung (Body/Gefühl nicht null) nicht erfüllt wird, dann wird folgendes ausgegeben:

                echo "<div class='postausgabe'>";//definiert den div als Klasse die postausgabe heißt

                echo "<a href='./profilseite/profilvonaußen.php?andere=" . $row['email'] . "'>" . $row['email'] . "</a> postete: <br/>";
                echo "<img src='profilseite/upload/$postbild'>";

                //Wer den Post geschrieben hat mit Verlinkung auf dieses Profil und das Bild welches gepostet wurde.

                echo "</div>";
            }


        }


        ?>


    </form>

</div>


</body>
</html>


