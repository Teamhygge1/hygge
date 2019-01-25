<?php
include 'datenbank.php';

session_start();
$Body = $_POST["Body"];// get oder post
$User = $_POST ["User"]; // noch user irgendwie abfragen und einlesen
//$email = $_SESSION["email"];
//Posts in Datenbank schreiben


echo ($Body);
echo ($User); // riemke eingefügt


$sql = "INSERT INTO Posts (email, Body, User ) VALUES ( ?, ?, ?)";
$statement = $pdo->prepare($sql);
$statement->execute(array("$email", "$Body", "$User"));
$statement->bindParam(':email', $_POST["email"]);
$statement->bindParam(':Body', $_POST["Body"]);
$statement->bindParam(':User', $_POST["User"]);
?>
<link rel="stylesheet" href="postingsschreiben.css" >
<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UTF-8">
</head>
<body>

<form method="post" action ="<?php echo $_SERVER[`PHP_SEL`];?>">
    <p><label>Dein Post:<br></label</p>

    <textarea name="Body" ></textarea> </label</p>
    <input type="submit" value="Posten">
</form>

<fieldset>
    <legend> Wie fühlst du dich heute?</legend>
    <select>
        <option value="p1"> <a> einfach gut</a></option>
        <option value="p2"> <a> glücklich </a></option>
        <option value="p3"> <a> traurig </a></option>
        <option value="p4"> <a> müde </a></option>
        <option value="p5"> <a> motiviert </a></option>
        <option value="p6"> <a> hungrig </a></option>
        <option value="p7"> <a> Prüfungsphase - frag nicht! </a></option>

    </select>
</fieldset>

</body>
</html>

