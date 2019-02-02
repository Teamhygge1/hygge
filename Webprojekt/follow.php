<?php

include_once "datenbank.php";

session_start();

$email = $_SESSION["email"];
$andere= $_GET ["andere"];

$sql = "INSERT INTO following (email, following) VALUES (?, ?)"; //SQL Befehl-> Einfügen von Email und der E-Mail des Anderen in die Datenbank

if ($statement = $pdo->prepare($sql)) {
    $statement->execute(array("$email", "$andere"));

};
?>



































