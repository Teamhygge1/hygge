<?php
session_start();
include("datenbank.php");

 ?>

<!DOCTYPE html>
<html>
<head>

    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" href="register_CSS.css" media="screen" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>




<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll


//Variablen festlegen und aus Sessiosn lesen und aus DB holen
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $id = $_SESSION["email"];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    // Überprüfung, ob es sich um eine gültige E-Mail handelt (ob @- Zeichen vorhanden)

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }

    // Error, wenn kein Passwort eingegeben wurde
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }

    // Error, wenn die angegeben Passwörter nicht überein stimmen
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }



    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email ");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, Nutzer kann registriert werden.
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT); //Passwort Hash! Wichtig für die Sicherheit

        $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");  //Eintrag der Daten in die Datenbank
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash)); //Passwort Hash

        //Wenn es oben ein Ergebnis gab, wurde der Nutzer erfolgreich registriert
        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
    ?>




<div class="container">

<div class="form-register">

    <h1> Registriere dich jetzt!</h1> <br>

    <h2> Werde Teil der HdM- Hygge Community und bleibe Up to date was auf dem Campus so geht!</h2> <br>

    <form action="?register=1" method="post">
        E-Mail:<br>
        <input type="email"  name="email" placeholder="E-Mail"><br><br>


        Dein Passwort:<br>
        <input type="password"  name="passwort" placeholder="Passwort"><br>

        Passwort wiederholen:<br>
        <input type="password"  name="passwort2" placeholder="Passwort wiederholen"><br><br>


        <div class="wrapper">


       <form class="button">
        <input type="submit" value="Los gehts!">

       </form>

    </form> <br>


        <form class="button" action="login.php"> <br>
            <input type="submit" value="Bereits dabei? Log dich ein!">

        </form>
       </div>

    </div>

</div>


    <?php
} //Ende von if($showFormular)
?>

</body>
</html>