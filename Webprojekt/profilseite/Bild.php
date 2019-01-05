<?php
// Datenverbindung herstellen
require("../datenbank.php");

?>

    <!-- Header -->
    <div class="row">
        <div class="header-edit" ></div>
        <div class="container-no-padding">
            <div class="header-half">
                <span>Bild Hinzufügen</span>
            </div>
        </div>
    </div>


    <!-- Navigation-->
    <div class="container-uebersicht wrapper list-edit">
        <ul style="list-style-type: none;">
            <li style="float: left;"><a class="edit-link active" href="Bild.php">Füge ein Bild hinzu</a></li>
        </ul>
    </div>

<?php
if ($_POST) { // Fehlermeldungen
    $errors = array();

    if (empty($_FILES['bild'])) {
        $errors[] = "Es wurde kein Bild ausgewählt.";
    }

    if (empty($_POST['Beschreibung'])) {
        $errors[] = "Es wurde keine Beschreibung angegeben.";
    }


    if (empty($errors)) { 	// Datenbankabfrage, Bild hinzufügen, Personen und Schlagwörter verknüpfen
        $insertbild = $db->prepare("INSERT INTO ba_bild (Dateiname, Breite, Hoehe, Zeit, Beschreibung)
									   VALUES (:Dateiname, :Breite, :Hoehe, :Zeit, :Beschreibung)"); // SQL-Statement zum Hinzufügen eines Bildes
        $linksw = $db->prepare("INSERT INTO ba_beschreibt (BID,SID) VALUES (?,?)"); // SQL-Statement zum Hinzufügen der ausgewählten Schlagwörter
        $dateiname = $_POST['bild'];
        $breite = $_POST['Breite'];
        $hoehe = $_POST['Hoehe'];
        $beschreibung = $_POST['Beschreibung'];
        $bild = array(
            //'Dateiname' => $dateiname,
            //'Breite' => $breite,
            //'Hoehe' => $hoehe,
            // ist unten
            'Beschreibung' => $beschreibung
        );

        // Bild speichern
        // Das Bild
        $maxsize = 1536 * 1024; // 1,5MB
        $maxwidth = 4032; // maximale Breite in Pixel
        $maxheight = 3024; // maximale Hoehe in Pixel
        $folder = "img/galerie/"; // Speicherort
        // Dateitypen, getimagesize liefert nur Integerwerte
        // daher muessen wir diese in sinnvolle Dateiendungen konvertieren
        $filetypes = array(2 => ".jpg", 3 => ".png");
        // Das Bild ist optional
        if( $_FILES["bild"]["tmp_name"] ){ // Es wurde eine Datei hochgeladen
            if( !is_writable($folder) ){
                $errors[] = "Das Verzeichnis <strong>$folder</strong> ist nicht
				beschreibbar. Es kann kein Bild hochgeladen werden\n";
            }

            if( $_FILES["bild"]["size"] > $maxsize ){
                $errors[] = "Die Datei ist zu gro&szlig;. Es sind maximal " . round($maxsize / 1024) . " KB erlaubt.\n";
            }
            $size = getimagesize($_FILES["bild"]["tmp_name"]);
            if($size[0] > $maxwidth || $size[1] > $maxheight){
                $errors[] = "Das Bild ist &uuml;berdimensioniert. Es darf maximal " . "<strong>$maxwidth x $maxheight px</strong> gro&szlig; sein.\n";
            } // Falls die Breite und Hoehe des Bildes noch anderweitig verwendet
            // werden soll, koennten diese Daten hier unter else { ... } ←-

            if(array_key_exists($size[2], $filetypes)){
                $fileextension = $filetypes[$size[2]];
                $filename = hash("sha1", $_FILES["bild"]["name"] . time());
                $filename .= $fileextension;
            } else {
                $errors[] = "Die Datei hat keinen g&uuml;ltigen Dateityp, Es sind " . "lediglich folgende Typen erlaubt: <strong>" . implode(", ",$filetypes) . "</strong>.\n";
            }
            if(!$errors && move_uploaded_file($_FILES["bild"]["tmp_name"],$folder.$filename)){
                $bild["Dateiname"] = $folder.$filename;
                $bild["Breite"] = $size[0];
                $bild["Hoehe"] = $size[1];
            }else{
                $errors[] = "Die Bilddatei konnte nicht gespeichert werden.\n";
            }
        }
        else {
            $errors[] = "Die Bilddatei konnte nicht hochgeladen werden.\n";
        }
        if (empty($errors) && $insertbild->execute($bild)) { // bild wurde erfolgreich in DB gespeichert
            $BID = $db->lastInsertId();
            echo '<p class="erfolg container">Das Bild wurde erfolgreich hinzugefügt.</p>';
            if ($_POST['schlagworte']) { // wurden Schlagworte zum Bild ausgewählt?
                foreach($_POST['schlagworte'] as $sid) {
                    $linksw->execute(array(
                        $BID,
                        $sid
                    )); // Schlagworte mit neuem Bild verknüpfen
                }
            }

            if ($_POST['person']) { // wurden Personen zum Bild ausgewählt?
                foreach($_POST['person'] as $pid) {
                    $linkperson->execute(array(
                        $BID,
                        $pid
                    )); // Personen mit neuem Bild verknüpfen
                }
            }
        }
        elseif($errors){ // Ausgabe Fehlermeldung
            echo "<ul class='fehler container' style='list-style-type:none;'>";
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
        echo "<ul class='fehler container' style='list-style-type:none;'>";
        foreach($errors as $e){
            echo "<li>$e</li>";
        }
        echo "</ul>";
    }
}
?>

    <!-- Formular Bild hinzufügen-->
    <div class="container wrapper">
        <form action="<?php echo $_SERVER[’PHP_SELF’]; ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Bild hinzufügen:</legend>
                <label for="bild">Bild:</label> <input class="form-control" type="file" name="bild" /><br />
                <label for="Beschreibung">Beschreibung:</label><input class="form-control" type="text" name="Beschreibung" size="30" /><br />
            </fieldset>

            <fieldset>
                <label for="personen">Person auswählen:</label>

                <?php //Auswahlfeld für Personen
                $select_person = $db->query("SELECT * FROM ba_person"); // SQL-Statement zum Anzeigen aller Personen
                foreach($select_person as $person) {
                    echo '<input type="checkbox" name="person[]" value="' . $person['PID'] . '">' . "&nbsp;" . $person['Vorname'] . "&nbsp;" .  $person['Nachname'] . "&nbsp;" . "&nbsp;" . "&nbsp;" . "&nbsp;" . "</input>";
                }
                ?>

                <br />
            </fieldset>
            <br/>
            <fieldset>
                <button type="submit" class="btn btn-primary" value="Speichern" name="submit" >Speichern</button>
        </form>
    </div>
    <!-- Ende Formular-->

<?php
// Anbindung Fuß
include("Fuss.php");
?>
