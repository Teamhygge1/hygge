<?php
include 'datenbank.php';

session_start();
$value = $_GET["value"]; //der Wert des Gefühls wird über die URL übertragen




$sql = "INSERT INTO Posts (gefühl) VALUES ( $value )"; //Gefühl wird in die Datenbank übertragen
$statement = $pdo->prepare($sql); //Statement wird vorbereitet
$statement->execute(array("$value")); //Statement wird mit Variable ausgeführt

?>