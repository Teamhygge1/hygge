<?php
session_start();
include_once('datenbank.php');
include_once('functions.php');

$_SESSION['userid'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> HYGGE BLOG </title>
</head>

<body>

<?php
if (isset($_SESSION['message'])){
    echo "<b>". $_SESSION['message']."</b>";
    unset($_SESSION['message']);
}
?>

<p><a href='users.php'>Eine Liste der User</a></p>

<form method='post' action='add.php'>
    <p>Dein Beitrag:</p>
    <textarea name='body' rows='5' cols='40'> </textarea>
    <p><input type='submit' value='submit'/></p>
</form>

<?php
$posts = show_posts($_SESSION['userid']);

if (count($posts)){
    ?>
    <table border='1' cellspacing='0' cellpadding='5' width='500'>
        <?php
        foreach ($posts as $key => $list){
            echo "<tr valign='top'>\n";
            echo "<td>".$list['userid'] ."</td>\n";
            echo "<td>".$list['body'] ."<br/>\n";
            echo "<small>".$list['stamp'] ."</small></td>\n";
            echo "</tr>\n";
        }
        ?>
    </table>
    <?php
}else{
    ?>
    <p><b>Du hast noch nichts gepostet!</b></p>
    <?php
}
?>
<h2>Leute denen du folgst!</h2>

<?php
$users = show_users($_SESSION['userid']);

if (count($users)){
}else{
    $myusers = array();
}
$myusers[] = $_SESSION['userid'];

$posts = show_posts($myusers,10);
    ?>
    <ul>
        <?php
        foreach ($users as $key => $value){
            echo "<li>".$value."</li>\n";
        }
        ?>


</body>
</html>