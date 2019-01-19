<?php
include 'datenbank.php';
session_start();
$Body = $_POST["Body"]; // get oder post

//$email = $_SESSION["email"];
//Posts in Datenbank schreiben


echo ($Body); //von riemke


$sql = "INSERT INTO Posts (email, Body) VALUES ( ?, ?)";
$statement = $pdo->prepare($sql); // vielleicht fehler
$statement->execute(array("$email", "$Body")); // vielleicht fehler
$statement->bindParam(':email', $_POST["email"]);
$statement->bindParam(':Body', $_POST["Body"]);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UTF-8">
</head>
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
        <option value="p3"> <a> traurig </a></option>
        <option value="p4"> <a> müde </a></option>
        <option value="p5"> <a> motiviert </a></option>
        <option value="p6"> <a> hungrig </a></option>
        <option value="p7"> <a> Prüfungsphase - frag nicht! </a></option>

    </select>
</fieldset>

</body>
</html>

