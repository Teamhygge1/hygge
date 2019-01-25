<?php
require ('../datenbank.php');
session_start();
$sql = "SELECT User, Body, created_at FROM Posts";
foreach ($pdo->query($sql) as $row) {
    echo $row['User'] . "<br />";
    echo $row['Body']."<br />";
    echo "geschrieben am: " . $row['created_at'] . "<br /><br />";
}
?>