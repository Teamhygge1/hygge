<?php
session_start();
include_once ("datenbank.php"); // Datenbankverbindung herstellen


if(isset($_GET['login'])) {  // Check, ob man eingeloggt ist
    $email = $_POST['email'];   // Email aus DB
    $_SESSION["email"] = $email;  //Email wird als Session Wert gespeichert
    $passwort = $_POST['passwort']; //Passwort aus DB



    // Eingabe Check vom Login
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email ");//durch Pdo Statement wird die Email aus der DB gelesen die mit der Email der Session übereinstimmt
    $result = $statement->execute(array('email' => $email)); //vergleich der Emails
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) { //Password Verify, wegen dem Passwort Hash
        $_SESSION['email'] = $user['email'];
        die('Login erfolgreich. Weiter zu <a href="startseite22.php?user=' . $email . '">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Login_CSS.css" media="screen" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>



<?php



if(isset($errorMessage)) {  //falls Error Message, dann wird sie ausgegeben
    echo $errorMessage;
}
?>



<div class="container">


    <div class="form-login">
        <h1> Log dich ein! </h1> <br>

<form action="?login=1" method="post">
    <input type="email"  name="email" placeholder="E-Mail"><br><br>

    <br>
    <input type="password"  name="passwort" placeholder="Passwort"> <br>

    <input type="submit" value="Login">
</form>

        <br>

        <div class="wrapper">



            <form action="register.php"> <br>
                <input type="submit" value="Noch nicht dabei? Registrieren!">

            </form>

        </div>
        </div>
</div>


</body>
</html>