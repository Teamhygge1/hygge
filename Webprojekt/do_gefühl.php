<?php
session_start(); //Session wird gestartet
include 'datenbank.php';
$user = $_GET["user"]; //Holt user aus der URL
$Body = $_POST["Body"];
$email = $_SESSION["email"]; ////holt Variable aus aktueller Session, sprich wer ist eingeloggt
$gefühl = $_POST['gefühl'];


$sql = "INSERT INTO Posts (email, Body, status, gefühl) VALUES ( ? , ?, '0', ?)"; //Übergibt Variablen in Datenbank
$statement = $pdo->prepare($sql); //bereitet das Statement vor
$statement->execute(array("$email", "$Body", "$gefühl")); //führt das Statement mit den Variablen aus
$statement->bindParam(':email', $_SESSION["email"]); //Bindet die Variablen an das Statement, damit diese übergeben werden



header ('Location: startseite22.php'); //wenn das "do" ausgeführt wurde, kommmt man wieder auf die Startseite bzw bleibt dort