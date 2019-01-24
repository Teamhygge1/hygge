<?php
require ('../datenbank.php');
session_start();
$Informationen = $_POST["Informationen"]; // get oder post
// noch userid irgendwie abfragen und einlesen
//$email = $_SESSION["email"];
//Posts in Datenbank schreiben


echo ($Informationen); //von riemke


$sql = "INSERT INTO profil (User, Informationen) VALUES ( ?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array("$User", "$Informationen"));
$statement->bindParam(':Informationen', $_POST["Informationen"]);
$statement->bindParam(':User', $_POST["User"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Infos über mich</title>
    <meta charset="UTF-8">
</head>
<body>

<form method="post" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
    <p><label>Meine Infos:<br></label</p>

    <textarea name="Informationen"></textarea></label</p>
    <input type="submit" value="speichern">
</form>
