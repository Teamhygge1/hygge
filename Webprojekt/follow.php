<?php

include_once "datenbank.php";

session_start();

$email = $_SESSION["email"];
$andere= $_GET ["andere" ];


// In Tabelle Abonnenten wird das "Follower-Verhältnis" vermerkt.
//$pdo = new PDO ($dsn, $dbuser, $dbpass, array('charset'=>'utf8'));
$sql = "INSERT INTO following (email, following) VALUES (?, ?)";

if ($statement = $pdo->prepare($sql)) {
    $statement->execute(array("$email", "$andere"));

};

/* Alle Posts des neuen Freundes werden als gelesen in der Tabelle Notification markiert.
$stmt = $pdo->prepare("UPDATE posts SET $email ='read' WHERE post= ANY(SELECT id FROM posts WHERE email=:andere)");
$stmt->execute(array(":email"=>"$andere")); */

header("Location: profil_anderer.php?profilname=$email");
?>



























