<?php
include("header2.php");
include_once ("datenbank.php");
include ("postings_schreiben_2.php");
session_start();
?>

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

        <h2 style="margin-top: 0;color:#00001a">Willkommen zurück <?php echo $email ?> </h2>

        <!-- eigenes Profil anzeigen? -->

    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-8 col-xs-9 bhoechie-tab-container">
            <div class=" bhoeccol-md-3 col-md-3 col-md-3 col-md-3hie-tab-menu">
                <ul class="list-group">
                    <a href="#" class="list-group-item active">

                        <!--<br/><br/><i class="glyphicon glyphicon-home"></i> Dein Profil <br/><br/>-->
                        <form id= "deinprofil" action="profilseite/profil2.php?"> <br>
                            <input type="submit" value="Dein Profil">

                        </form>


                        <a href="#" class="list-group-item ">
                            <br/><br/><i class="glyphicon glyphicon-user"></i> Follower<br/><br/>


                            <!--</a>
                            <a href="#" class="list-group-item">
                                <br/><br/><i class="glyphicon glyphicon-search"></i>Suche<br/><br/> -->

                            <!-- <a href="#" class="list-group-item">
                                 <br/><br/><i class="glyphicon glyphicon-cog"></i>Einstellungen<br/><br/>-->

                        </a>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->

                <form method ="post">
                    <fieldset>
                        <legend> Hygellige Beiträge</legend>
                        <div class="w3-container">
                            <p>

                                <?php
                                $statement = $pdo->prepare ( "SELECT * FROM `Posts` order by created_at DESC");
                                // $pdo = new PDO('mysql::host=mars.iuk.hdm-stuttgart.de;dbname=u-as327', 'as327', 'LahMaedae1');
                                $sql = "SELECT * FROM Posts";
                                foreach ($pdo->query($sql) as $row) {
                                    $email= $row['email'];
                                    echo "<a href='./profilseite/profilvonaußen.php?andere=$email'>".$email."</a> schrieb: <br/>
                        ".$row['Body']."<br/>";
                                    echo "geschrieben am: " .$row['created_at']."<br /> <br/>";
                                }
                                ?>
                            </p></div>
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