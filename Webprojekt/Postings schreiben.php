<?php include_once ("datenbank.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UITF-8">
<body>

<form method="post" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
    <p><label>Dein Post:<br></label</p>

    <textarea name="Body" cols="50" rows="8"></textarea></label</p>
    <input type="submit" value="Posten">
</form>

<fieldset>
<legend> Wie fühlst du dich heute?</legend>
<select>
     <option value="p1"> <a> einfach gut</a></option>
    <option value="p2"> <a> glücklich </a></option>
    <option value="p2"> <a> traurig </a></option>
    <option value="p2"> <a> müde </a></option>
    <option value="p2"> <a> motiviert </a></option>
    <option value="p2"> <a> hungrig </a></option>
    <option value="p2"> <a> Prüfungsphase - frag nicht! </a></option>

</select>
</fieldset>
<?php

include_once 'datenbank.php.';

$statement = $pdo->prepare("INSERT INTO 'Posts' (user,Body) VALUES(?, ?, ?)");
$statement->execute(array('Wert 1', 'Wert 2', 'Wert 3'));


 /*$sql = "INSERT INTO posts";
$sql .= "SET";
$db_link = @mysqli_connect ('mars.iuk.hdm-stuttgart.de',
     'as327',
    'LahMaedae1',
    'Posts');
// hier wird der mysql-Befehl ausgeführt und beitrag gespeichert
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
    die('Ungültige Abfrage: ' . $mysql->error());


}
*/?>
</body>
</head>
</html>