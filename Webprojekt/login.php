<?php
session_start();
include_once ("datenbank.php"); // Datenbankverbindung herstellen


if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];




    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email ");
    $result = $statement->execute(array('email' => $email));
    echo $result;
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user != false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="startseite22.php">internen Bereich</a>');
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

</head>
<body>



<?php



if(isset($errorMessage)) {
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