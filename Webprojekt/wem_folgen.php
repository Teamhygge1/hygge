 <?php
/*session_start();
include_once("datenbank.php");

$id = $_GET['id'];
$do = $_GET['do'];

switch ($do){
    case "follow":
        follow_user($_SESSION['userid'],$id);
        $msg = "You have followed a user!";
        break;

    case "unfollow":
        unfollow_user($_SESSION['userid'],$id);
        $msg = "You have unfollowed a user!";
        break;

}
$_SESSION['message'] = $msg;


?>

*/


function show_users($user_id=0){

if ($user_id > 0){
$follow = array();
$fsql = "select user_id from following
where follower_id='$user_id'";
$fresult = mysqli_query($fsql);

while($f = mysqli_fetch_object($fresult)){
array_push($follow, $f->user_id);
}

if (count($follow)){
$id_string = implode(',', $follow);
$extra =  " and id in ($id_string)";

}else{
return array();
}

}

$users = array();
$sql = "select id, username from users
where status='active'
$extra order by username";


$result = mysqli_query($sql);

while ($data = mysqli_fetch_object($result)){
$users[$data->id] = $data->username;
}
return $users;
}
include_once "datenbank.php"
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Wem folgen?</title>

</head>

<body>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Users</title>
</head>
<body>

<h1>Liste der User</h1>
<?php
$users = show_users();
$following = following($_SESSION['userid']);

if (count($users2)){
?>
<table border='1' cellspacing='0' cellpadding='5' width='500'>
    <?php
    foreach ($users as $key => $value){
        echo "<tr valign='top'>\n";
        echo "<td>".$key ."</td>\n";
        echo "<td>".$value;
        if (in_array($key,$following)){
            echo " <small>
        <a href='action.php?id=$key&do=unfollow'>unfollow</a>
        </small>";
        }else{
            echo " <small>
        <a href='action.php?id=$key&do=follow'>follow</a>
        </small>";
        }
        echo "</td>\n";
        echo "</tr>\n";
    }
    }
    ?>
</body>
</html>











</body>


</html>

