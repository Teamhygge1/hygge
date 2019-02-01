<?php
session_start();
include 'datenbank.php';
$user = $_GET["user"];
$Body = $_POST["Body"];// get oder post
$email = $_SESSION["email"];
$gefühl = $_POST['gefühl'];
echo $gefühl;

$sql = "INSERT INTO Posts (email, Body, status, gefühl) VALUES ( ? , ?, '0', ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array("$email", "$Body", "$gefühl"));
$statement->bindParam(':email', $_SESSION["email"]);



header ('Location: startseite22.php');