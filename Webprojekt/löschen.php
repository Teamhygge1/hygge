<?php

include_once("datenbank.php");
$id = $_GET["id"];

$sql = "DELETE FROM `Posts` WHERE $id = id";
$statement = $pdo->prepare($sql);
$statement->execute();

header ('Location: ./profilseite/profil2.php');
?>