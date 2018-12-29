<?php
session_start();
include_once ("datenbank.php");


if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];




    $statement = $pdo->prepare("SELECT * FROM users WHERE email = 'email' ");
    $result = $statement->execute(array('email' => $email));
    echo $result;
    $user = $statement->fetch();
    if ($user != false) {
        echo "User nicht gefunden";
    }

    //Überprüfung des Passworts
    if ($user != false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }




}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Login_CSS.css" media="screen" />
    <title>Login1</title>
</head>
<body>
<h1> Log dich ein! </h1>
<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
<div>
<form action="?login=1" method="post">
    E-Mail:<br>
    <input type="email"  name="email"><br><br>

    Dein Passwort:<br>
    <input type="password"  name="passwort"><br>

    <input type="submit" value="Abschicken">
</form>


<form action="passwortvergessen.php">
    <input type="submit" value="Passwort vergessen?">
</div>
</body>
</html>