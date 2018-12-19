<?php include "image_upload.php";

include "datenbank.php";


$email = $_POST['user'];
$password = $_POST['passwort'];

//ctoney ctoney123
if ($email =='email' AND $password=='password') {
    echo "You have logged in!";
} else if ($email =='email' AND $password=='password') {
    echo "Login erfolgreich! Herzlich Wilkommen!!";
} else {
    echo "Bitte zuerst einloggen!";
}







?>

<!DOCTYPE html>
<html>

<head>
    <title>Startseite</title>
    <meta charset="UITF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


</head>

<body>





<fieldset style="border:solid thin black;">
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <h1>Teile der Welt mit, was dich gerade bewegt! </h1>


             <fieldset>
             <form $="Beitrag" method="post" action="datenbank.php" >
                <label for="description">Was geht?</label>
                 <input type="text" name="blogpost" maxlength="300" style="width: auto"  >


                 <br>


            <div>
                <div> Wie fühlst du dich? </div>
                <select>

                    <option value="" disabled selected default style="color: darkgray"> Mood </option>
                    <option value="fantastisch">Fantastisch!</option>
                    <option value="gut">gut</option>
                    <option value="naja">naja</option>
                    <option value="hyggelich">hyggelich</option>
                    <option value="schlecht">schlecht</option>
                    <option value="neugeboren">Wie neu geboren!</option>
                    <option value="nervnicht"> Nerv mich nicht!</option>
                </select>
            </div>




                 <h2>Bild hochladen</font></h2>

                 <form method="post" action="image_upload.php" enctype="multipart/form-data">

                     Bilddatei:<br />

                     <input type="file" name="fileToUpload" id="fileToUpload">
                     <input type="submit" value="Bild hochladen" name="submit">


                 </form>



            <div  class="form-group">
                <button id= Teilen type="submit" class="btn btn-primary">
                    Teilen!
                </button>

            </div>
             </fieldset>


            </form>
        </div>

    </div>
</div>

</fieldset>




</body>


