<?php
include 'datenbank.php';

session_start();
$user = $_GET["user"];
$Body = $_POST["Body"];// get oder post
$email = $_SESSION["email"];



$sql = "INSERT INTO Posts (email, Body, status) VALUES ( ? , ?, '0')";
$statement = $pdo->prepare($sql);
$statement->execute(array("$user", "$Body"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post schreiben</title>
    <meta charset="UITF-8">
<body>

<form method="post" action="do_schreiben.php">
    <p><label>Dein Post:<br></label</p>

    <textarea name="Body" cols="50" rows="8"></textarea></label</p>

    <input type="submit" value="Posten">
</form>

<form method="post" action="do_schreiben.php?">
    <div class="gefühle">
        <select>
            <option value="">Wähle deine Stimmung</option>
            <?php
            $statement = $pdo->prepare("SELECT gefühle FROM Gefühle");
            $statement->execute();
            while ($row = $statement->fetch()){
            $gefühl = $row["gefühle"];
            ?>
            <option value="<?php echo $gefühl; ?>"><?php echo $gefühl;
                } ?></option>
        </select>
        <input type="submit" value="Posten">
    </div>
</form>

</body>
</head>
</html>