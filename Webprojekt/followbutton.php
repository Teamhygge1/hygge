<html>

<head>
    <meta charset="utf-8">
    <title>Wem folgen?</title>

</head>

<body>

<h1> Wem folgen? </h1>

<h2> Hier siehst du alle Nutzer von HdM- Hygge! </h2>

<h3> Folge deinen Freunden, um immer zu wissen was sie grade bewegt! </h3>

<?php
require_once "datenbank.php";

$statement = $pdo->prepare ( "SELECT email FROM `user`");

$sql = "SELECT email FROM users";

 foreach ($pdo->query($sql) as $row) {
     {

echo "<table>";
      echo "<tr>";
      echo "<td>",$row ->email, "</td>";
      echo "<td>", include "button.php", "</td>";
      echo "<tr>";
        }
echo "</table>";
}
?>








</body>


</html>


