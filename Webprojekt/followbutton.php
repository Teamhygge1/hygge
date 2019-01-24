<?php
include_once "datenbank.php";
$statement = $pdo->prepare ( "SELECT email FROM `users`");
foreach ($pdo->query($sql) as $row) {
    echo $row['email']." ".$row['Body']."<br />";

}
?>
<html>
<head>
    <title>hygge</title>
</head>


<body>


<button type="button" class="btn btn-follow" >follow</button>



</body>
</html>


