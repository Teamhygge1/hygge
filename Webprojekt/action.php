<?php
include 'datenbank.php';

session_start();
$value = $_GET["value"];




$sql = "INSERT INTO Posts (gefühl) VALUES ( $value )";
$statement = $pdo->prepare($sql);
$statement->execute(array("$value"));

?>