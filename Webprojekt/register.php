<?php
session_start();
include("datenbank.php");
 ?>

<!DOCTYPE html>
<html>
<head>

    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" href="register_CSS.css" media="screen" />
</head>
<body>




<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
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

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));

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
        <input type="email"  name="email"><br><br>

        Dein Passwort:<br>
        <input type="password"  name="passwort"><br>

        Passwort wiederholen:<br>
        <input type="password"  name="passwort2"><br><br>


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