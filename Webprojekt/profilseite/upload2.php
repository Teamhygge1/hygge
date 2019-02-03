<?php
include ("../datenbank.php");   //Einfügen der Datenbank
session_start();                //Session wird gestartet
$email = $_SESSION["email"];        //Variable $email wird in Session gespeichert
if (isset($_POST['submit'])){           //Erst wenn "submit" gedrückt wird ausführen
    $file = $_FILES['BildZumHochladen'];

    $fileName = $_FILES['BildZumHochladen']['name'];
    $fileTmpName = $_FILES['BildZumHochladen']['tmp_name'];
    $fileSize = $_FILES['BildZumHochladen']['size'];
    $fileError = $_FILES['BildZumHochladen']['error'];
    $fileType = $_FILES['BildZumHochladen']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');           //Format des Bildes

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 1000000){               //Größe des Bildes
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = '/home/jg119/public_html/Webprojekt/profilseite/upload/'.$fileNameNew;       //Ziel des Bildupload
                move_uploaded_file($fileTmpName, $fileDestination );            //Befehl zum hochladen
               $bild_id = $fileNameNew;
               $sql = "UPDATE users SET bild_id=:bild_id_neu WHERE email=:email";       //Das Bild wird mittels $bild_id in die Datenbank eingetragen
               $statement = $pdo->prepare($sql);                                        //DB wird geöffnet
               $statement->execute(array("bild_id_neu"=>$bild_id,"email"=>$email));
                header("location: profil2.php");                                         //Nach erfolgreichen Upload wird wieder auf die Profilseite verwiesen


            } else {
                echo "Dein Bild ist zu groß";   //Ausgabe Fehlermeldung
            }
        } else{
            echo "Das Bild konnte leider nicht hochgeladen werden"; //Ausgabe Fehlermeldung
        }
    } else {
        echo "Dieser Bildtyp wird nicht unterstützt";  //Ausgabe Fehlermeldung
    }


}
?>