<?php include("header2.php"); include_once ("datenbank.php"); ?>

 <link rel="stylesheet" href="Starteite_style.css" >

<!DOCTYPE html>
<html>
<head>

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

<!-- Include the above in your HEAD tag ---------->


</head>

<div id="fullscreen_bg" class="fullscreen_bg"/>
<div class="container">
    <div class="bhoechie-tab-content active">

        <h2 style="margin-top: 0;color:#00001a">Willkommen zurück </h2>

        <!-- eigenes Profil anzeigen? -->

    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-8 col-xs-9 bhoechie-tab-container">
            <div class=" bhoeccol-md-3 col-md-3 col-md-3 col-md-3hie-tab-menu">
                <ul class="list-group">
                    <a href="#" class="list-group-item active">
                        <br/><br/><i class="glyphicon glyphicon-home"></i> Dein Profil <br/><br/>


                    <a href="#" class="list-group-item ">
                        <br/><br/><i class="glyphicon glyphicon-user"></i> Follower<br/><br/>


                    <!--</a>
                    <a href="#" class="list-group-item">
                        <br/><br/><i class="glyphicon glyphicon-search"></i>Suche<br/><br/> -->

                   <!-- <a href="#" class="list-group-item">
                        <br/><br/><i class="glyphicon glyphicon-cog"></i>Einstellungen<br/><br/>-->
                        <select>
                            <option value="p1"> Passwort</a></option>
                            <option value="p2"> <a href="passwortvergessen.php.">Passwort vergessen</a></option>
                            <option value="p3"> <a href="passwortzuruecksetzen.php">Passwort zurücksetzen</a></option>

                        </select>
                    </a>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->

                <form method ="post">
                <fieldset>
                    <legend> Hygellige Beiträge</legend>

                    <?php
                    $statement = $pdo->prepare ( "SELECT * FROM `Posts`; order by `desc`;");
                    // $pdo = new PDO('mysql::host=mars.iuk.hdm-stuttgart.de;dbname=u-as327', 'as327', 'LahMaedae1');
$sql = "SELECT * FROM Posts";
                   foreach ($pdo->query($sql) as $row) {
                        echo $row['User']." ".$row['Body']."<br />";

                    }
                    ?>
</fieldset>
                </form>




               <!-- <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-tasks" style="font-size:12em;color:#00001a"></h1>
                        <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Schedule</a></h2>
                        <h3 style="margin-top: 0;color:#00001a">Meine Follower</h3>
                    </center>
                </div>


                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-transfer" style="font-size:12em;color:#00001a"></h1>
                        <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Trips</a></h2>
                        <h3 style="margin-top: 0;color:#00001a">Meine Nachrichten </h3>
                    </center>
                </div>

                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-edit" style="font-size:12em;color:#00001a"></h1>
                        <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Edit</a></h2>
                        <h3 style="margin-top: 0;color:#00001a"><Einstellungen/h3>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>  kommentar kommentar -->