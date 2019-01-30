<?php
include 'datenbank.php';

session_start();
$user = $_GET["user"];
$Body = $_POST["Body"];// get oder post
$email = $_SESSION["email"];
//Posts in Datenbank schreiben


$sql = "INSERT INTO Posts (email, Body, status) VALUES ( ? , ?, '0')";
$statement = $pdo->prepare($sql);
$statement->execute(array("$user", "$Body"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<form method="post" action="<?php echo $_SERVER[`PHP_SEL`]; ?>">
    <p><label>Dein Post:<br></label</p>

    <textarea name="Body"></textarea>

</form>
<input type="submit" value="Posten" enctype="multipart/form-data">

<fieldset>
    <!--<form action="action.php" method="post"> -->
    <legend> Wie fühlst du dich heute?</legend>
    <select>
        <option value="p1"><a> einfach gut</a></option>
        <option value="p2"><a> glücklich </a></option>
        <option value="p3"><a> traurig </a></option>
        <option value="p4"><a> müde </a></option>
        <option value="p5"><a> motiviert </a></option>
        <option value="p6"><a> hungrig </a></option>
        <option value="p7"><a> Prüfungsphase - frag nicht! </a></option>

    </select>
    </form>
</fieldset>

<form method="post" action="Postbildupload.php" enctype="multipart/form-data">
    <p><label> Füge ein Bild zu deinem Post hinzu:<br>></label></p>
    <div class="upload">
        <input type="file" name="BildZumHochladen" id="hochladen">
        <input type="submit" value="Bild hochladen" name="submit">
    </div>
    </form>
</body>
</html>

