<?php

include_once "datenbank.php";

session_start();

$email = $_SESSION["email"];
$andere= $_GET ["andere" ];

//Löschen des Abonnenten aus der Datenbank an der Stelle, wo Kürzel aus der Session (eingeloggter Nutzer) mit dem Nutzer auf dessen profil man ist, übereinstimmt
$pdo = new PDO ($dsn, $dbuser, $dbpass, array('charset'=>'utf8'));
$sql = "DELETE FROM following  WHERE email=:email AND following=:email";

$statement = $pdo->prepare($sql);
$statement->execute(array(":email"=>"$email", ":following"=>"$andere")); //Gucken ob Variablen stimmen


header("Location: profil_anderer.php?profilname=$email");

?>