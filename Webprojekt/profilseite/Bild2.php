<?php
        session_start();
        include_once '../datenbank.php';
?>

<!DOCTYPE html>
  <html>
    <body>

<?php
    if (isset($_SESSION['id'])){
        if ($_SESSION['id'] == 1){
            echo "Du bist eingeloggt als ...";
        }
    }
?>

<h2>Bild hochladen</font></h2>

<form method="post" action="upload2.php" enctype="multipart/form-data">

    <input type="file" name="BildZumHochladen" id="BildZumHochladen">
    <input type="submit" value="Bild hochladen" name="submit">

</form>
    </body>
</html>
