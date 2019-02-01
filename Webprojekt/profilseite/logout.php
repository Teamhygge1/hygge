<?php
session_start();
session_destroy();
//Cookies entfernen
setcookie("identifier","",time()-(3600*24*365));
setcookie("securitytoken","",time()-(3600*24*365));

header('Location: ./header2.php');




echo "logout erfolgreich";
die;



?>