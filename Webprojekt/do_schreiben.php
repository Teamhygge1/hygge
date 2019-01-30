<?php
include 'datenbank.php';

session_start();
$user = $_GET["user"];
$gefühl = $_POST["gefühl"];
$Body = $_POST["Body"];// get oder post
$email = $_SESSION["email"];
//Posts in Datenbank schreiben


$sql = "INSERT INTO Posts (gefühl) VALUES ( $gefühl )";
$statement = $pdo->prepare($sql);
$statement->execute(array("$gefühl"));

?>