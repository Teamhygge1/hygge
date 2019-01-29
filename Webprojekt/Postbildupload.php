<?php
include ("datenbank.php");
session_start();
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
                $sql = "INSERT INTO Posts (email, bild_id) VALUES (? , ?)";
                $statement = $pdo->prepare($sql);
                $statement->execute(array("$email","$bild_id"));
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