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

    <?php
    $statement = $pdo->prepare("SELECT bild_id FROM Posts WHERE email=:email");
    $statement->execute(array(":email" => "$email"));
    $statement->bindParam(':email', $_SESSION["email"]);

    while ($row = $statement->fetch()) {
        $profilbild = $row['bild_id'];


        echo "<img src='upload/$profilbild'>";
    }

    ?>
    </form>
<?php
$email = $_SESSION["email"];
if (isset($_POST['submit'])) {
    $file = $_FILES['BildZumHochladen'];

    $fileName = $_FILES['BildZumHochladen']['name'];
    $fileTmpName = $_FILES['BildZumHochladen']['tmp_name'];
    $fileSize = $_FILES['BildZumHochladen']['size'];
    $fileError = $_FILES['BildZumHochladen']['error'];
    $fileType = $_FILES['BildZumHochladen']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '/home/jg119/public_html/Webprojekt/profilseite/upload/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $bild_id = $fileNameNew;
                $sql = "UPDATE Posts SET bild_id=:bild_id_neu WHERE email=:email";
                $statement = $pdo->prepare($sql);
                $statement->execute(array("bild_id_neu" => $bild_id, "email" => $email));
                header("location: startseite22.php");


            } else {
                echo "Dein Bild ist zu groß";
            }
        } else {
            echo "Das Bild konnte leider nicht hochgeladen werden";
        }
    } else {
        echo "Dieser Bildtyp wird nicht unterstüzt";
    }


}
?>
</body>
</html>

