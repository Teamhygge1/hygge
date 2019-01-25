<?php

 	session_start();

 	include ("datenbank.php");
 	if (isset($_POST["email"]) AND isset($_POST["passwort"])) {
        $email = $_POST["email"];
        $passwort = $_POST["passwort"];
        $passworthash = password_hash($passwort, PASSWORD_DEFAULT);

    }

 	//Es wird zuerst geschaut, ob die Aktivierungsmail bestätigt wurde, dann werden Benutzername und
 	//Passwort überprüft und bei richtiger Eingabe, eine Session gesetzt und zur Hauptseite weitergeleitet

 	$stmt = $pdo->prepare("SELECT * FROM login WHERE email='" . $email . "' AND passwort='" . $passwort . "' AND aktiviert = 1");
 	$match = $stmt->execute();


 	if($match) {

        $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :email AND aktiviert = 1");

        if ($stmt->execute(array(':email' => $email))) {
            if ($row = $stmt->fetch()) {
                $user_id = $row['id'];
                $passworthash = $row["passwort"];
                password_verify($passwort, $passworthash);

                if (password_verify($passwort, $passworthash)) {

                    $_SESSION["login-id"] = $row["login_id"];
                    $_SESSION["username"] = $row ["benutzername"];
                    $_SESSION["mail"] = $row ["hdm_mail"];

                }



            }
        }
    }

 	?>
