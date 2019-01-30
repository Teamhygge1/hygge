<?php

include_once "datenbank.php";

session_start();

$id=$_GET["id"];
$channel=$_GET["channel"];
$email= $_SESSION["email"];



//Post wird auf gelesen gesetzt

$pdo = new PDO($dsn, $dbuser, $dbpass, array ('charset'=>'utf8')));
$statement=  $pdo->prepare("Update Posts SET $email = 'read' WHERE Body = (SELECT email FROM Posts WHERE id=:id)");



?>