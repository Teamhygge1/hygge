<!DOCTYPE html>
<html>
<body>


    <?php
    $ziel = "/home/jg119/public_html/Webprojekt/profilseite/upload/";
    $zieldatei = $ziel . basename($_FILES["BildZumHochladen"]["name"]);
    if (move_uploaded_file($_FILES["BildZumHochladen"]["tmp_name"],$zieldatei)){
        echo"Bild erfolgreich hochgeladen";
    }
    else {
        echo "Fehler.";

    }
    ?>

</body>
</html>

