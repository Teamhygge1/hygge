<?php
include_once 'datenbank.php';
// include_once '../register/login_test.php';
session_start();
$kuerzel = $_SESSION["email";
$andere= $_GET ["andere" ];
?>

<?php

//auszählen der Anzahl der ungelesenen Nachrichten
$pdo = new PDO ($dsn, $dbuser, $dbpass, array('charset' => 'utf8'));

$statement = $pdo->prepare("SELECT * from Posts WHERE $status IS NULL AND email =ANY (SELECT id FROM posts WHERE andere = ANY (SELECT email FROM following WHERE email=:email))");
$statement->execute(array(":andere"=>"$andere"));
$anzahl_notification = $statement->rowCount();


?>

