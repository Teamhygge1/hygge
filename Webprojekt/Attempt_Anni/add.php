<?php
session_start();
include_once("datenbank.php");
include_once("functions.php");

$userid = $_SESSION['userid'];
$body = substr($_POST['body'],0,140);

add_post($userid,$body);
$_SESSION['message'] = "Dein Post wurde hinzugefügt!";

header("Location:index.php");
?>

