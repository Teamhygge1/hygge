<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
include 'postings schreiben 2.php';
echo "Wilkommen zurück!: ".$userid;
?>