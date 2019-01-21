




<html>

<h1> Wem folgen? </h1>

<h2> Hier siehst du alle Nutzer von HdM- Hygge! </h2>

<?php

require_once "datenbank.php";




$sql = "SELECT * FROM users";
foreach ($pdo->query($sql) as $row) {
    echo

        $row['email']." 
    ".$row['vorname']." <br />";
}


?>







</html>

