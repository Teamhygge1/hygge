<html>
<?php
session_start();
$variable1 = 0;

if(!isset($_SESSION["username"]) and !isset($_GET["page"]))  {
    $variable1 = 0;
}
if (isset($_GET["page"]) && ($_GET["page"]) == "log") {

    $user = $_POST["user"];
    $passwort = $_POST["passwort"];

    if($user == "david" and $passwort == "123") {
        $_SESSION["username"] = $user;
        $variable1 = 1;
    } else {
        $variable1 = 2;
    }
}
?>

<html>
<head>
    <title>Welcome/Wilkommen</title>
    <?php
    if ($variable1 == 1) {
        ?>
        <meta http-equiv="refresh" content="3"; url=seite2.php" />
        <?php
    }
    ?>
</head>
<body>
<?php
if($variable1 == 0) {
    ?>
    Bitte logge dich ein :<br />

    <form method="post" action="index.php?page=log">
        User<input type="text" name="user" /> <br />
        Passwort<input type="password" name="passwort" /> <br />
        <input type="submit" value="login" />
    </form>

    <?php
}‚
if ($variable1 == 1) {
    ?>
    Einen Moment bitte...

    <?php
}
if ($variable1 == 2) {
    ?>
    E-Mail Adresse und Passwort stimmen nicht überein. <a href="index.php">zurück</a>.

    <?php
}
?>

</body>
</html>﻿