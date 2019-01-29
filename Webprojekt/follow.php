<?php

include_once "datenbank.php";

session_start();

$email = $_SESSION["email"];
$andere= $_GET ["andere" ];



//echo $andere;

// In Tabelle Abonnenten wird das "Follower-Verhältnis" vermerkt.

$statement= $pdo->prepare ("INSERT INTO following (email, following) VALUES (?,?)");
$statement->execute(array("$email", "$andere"));






// Alle Posts des neuen Freundes werden als gelesen in der Tabelle Notification markiert.
$stmt = $pdo->prepare("UPDATE Posts SET status =0  WHERE Body = ANY(SELECT id FROM Posts WHERE email=:andere)");
$stmt->execute(array(":email"=>"$andere"));

header("Location: profilvonaußen.php?profilname=$email");





?>


