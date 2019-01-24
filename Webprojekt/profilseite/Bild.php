<?php
// Datenverbindung herstellen
require("../datenbank.php");
?>


<?php
if ($_POST) { // Fehlermeldungen
    $errors = array();

    if (empty($_FILES['bild'])) {
        $errors[] = "Es wurde kein Bild ausgewählt.";
    }


    if (empty($errors)) { 	// Datenbankabfrage, Bild hinzufügen, Personen und Schlagwörter verknüpfen
        $insertbild = $db->prepare("INSERT INTO images (Dateiname)
									   VALUES (:Dateiname)"); // SQL-Statement zum Hinzufügen eines Bildes
        $dateiname = $_POST['bild'];
        $bild = array();

        $ziel = "/home/jg119/public_html/Webprojekt/profilseite/upload/";
        $zieldatei = $ziel . basename($_FILES["bild"]["name"]);
        if (move_uploaded_file($_FILES["bild"]["tmp_name"],$zieldatei)){
            echo"Bild erfolgreich hochgeladen";
        }


        if( $_FILES["bild"]["tmp_name"] ){
            if( !is_writable($ziel) ){
                $errors[] = "Das Verzeichnis <strong>$ziel</strong> ist nicht
				beschreibbar. Es kann kein Bild hochgeladen werden\n";
            }

            if(!$errors && move_uploaded_file($_FILES["bild"]["tmp_name"],$ziel.$dateiname)){
                $bild["Dateiname"] = $ziel.$dateiname;
            }else{
                $errors[] = "Die Bilddatei konnte nicht gespeichert werden.\n";
            }
        }
        else {
            $errors[] = "Die Bilddatei konnte nicht hochgeladen werden.\n";
        }
        if (empty($errors) && $insertbild->execute($bild)) { // bild wurde erfolgreich in DB gespeichert

            echo '<p >Das Bild wurde erfolgreich hinzugefügt.</p>';


        }
        elseif($errors){ // Ausgabe Fehlermeldung
            echo "<ul style='list-style-type:none;'>";
            foreach($errors as $e){
                echo "<li >$e</li>";
            }
            echo "</ul>";
        }
        else { // Fehler beim Speichern des Bilds
            $dberr = $insertbild->errorInfo();
            echo "<p>Datenbankfehler: " . $dberr[2] . "</p>\n";
        }
    }
    else { // Fehler bei Daten
        echo "<ul style='list-style-type:none;'>";
        foreach($errors as $e){
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
}
?>

    <!-- Formular Bild hinzufügen-->
    <div >
        <form action="<?php echo $_SERVER[’PHP_SELF’]; ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Bild hinzufügen:</legend>
                <label for="bild">Bild:</label> <input class="form-control" type="file" name="bild" /><br />
            </fieldset>

            <br/>
            <fieldset>
                <button type="submit" class="btn btn-primary" value="Speichern" name="submit" >Speichern</button>
        </form>
    </div>

