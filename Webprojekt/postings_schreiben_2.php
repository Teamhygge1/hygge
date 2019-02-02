<?php
include 'datenbank.php'; //bindet Datei mit Datenbankverbindungsdaten ein

session_start(); //startet Session
$user = $_GET["user"]; //holt Variable aus der URL
$Body = $_POST["Body"]; //Body wird später aus der DB geholt
$email = $_SESSION["email"]; //holt Variable aus aktueller Session, sprich wer ist eingeloggt


?>

<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

 <!-- Bereich in dem man seinen Post schreiben kann (Textarea) und Bereich in dem man sein Gefühl wählen kann (Option value) -->

<form method="post" action="do_gefühl.php"> <!-- führt die PHP-Datei "do.gefühl aus. -->
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

<!-- Bildupload für den Bilder Post -->

<form method="post" action="Postbildupload.php" enctype="multipart/form-data">
    <p><label> Füge ein Bild zu deinem Post hinzu:<br></label></p>
    <div class="upload">
        <input type="file" name="BildZumHochladen" id="hochladen">
        <input type="submit" value="Bild hochladen" name="submit">
    </div>
</form>
</body>
</html>

