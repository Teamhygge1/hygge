<?php

include_once ("datenbank.php");


session_start();
$user = $_GET["user"];
$Body = $_POST["Body"];
$email = $_SESSION["email"];



$statement = $pdo->prepare ( "SELECT * FROM `Posts` WHERE order by created_at ASC");
$sql = "SELECT * FROM Posts";
$statement->execute(array(":email"=>"$email"));
$statement->bindParam(':email', $_SESSION["email"]);

?>