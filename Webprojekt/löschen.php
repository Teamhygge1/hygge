<?php

include_once("datenbank.php");
$id = $_GET["id"]; //holt die ID aus der URL

$sql = "DELETE FROM `Posts` WHERE $id = id"; /*löscht den Post aus der Datenbank, den wir anklicken.
 und aus der DB, den bei dem die ID übereinstimmt*/
$statement = $pdo->prepare($sql);
$statement->execute();

header ('Location: ./profilseite/profil2.php'); ////wenn das "do" ausgeführt wurde, kommmt man wieder auf die Profilseite bzw bleibt dort
?>