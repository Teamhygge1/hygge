<?php
include 'datenbank.php';

session_start();
$user = $_GET["user"];
$Body = $_POST["Body"];// get oder post
$email = $_SESSION["email"];
//Posts in Datenbank schreiben

?>

<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<form method="post" action="do_gefühl.php">
    <p><label>Dein Post:<br></label</p>
    <textarea name="Body"></textarea>

    <fieldset>
        <legend> Wie fühlst du dich heute?</legend>
        <select  name="gefühl" >
            <option value="einfach gut"><a> einfach gut</a></option>
            <option value="glücklich"><a> glücklich </a></option>
            <option value="traurig"><a> traurig </a></option>
            <option value="müde"><a> müde </a></option>
            <option value="motiviert"><a> motiviert </a></option>
            <option value="hungrig"><a> hungrig </a></option>
            <option value="Prüfungsphase - frag nicht!"><a> Prüfungsphase - frag nicht! </a></option>
        </select>
        <input type="submit" value="Posten" name="submit">
    </form>
</fieldset>

<form method="post" action="Postbildupload.php" enctype="multipart/form-data">
    <p><label> Füge ein Bild zu deinem Post hinzu:<br></label></p>
    <div class="upload">
        <input type="file" name="BildZumHochladen" id="hochladen">
        <input type="submit" value="Bild hochladen" name="submit">
    </div>
</form>
</body>
</html>

