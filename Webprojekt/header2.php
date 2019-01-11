<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"/>
<link rel="stylesheet" type="text/css" href="profilseite/Main.css" media="screen" />

<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="navbar navbar-inverse nav">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/">HYGGE</a>

          	<div class="nav-collapse collapse">
              <ul class="nav">
                  <li class="divider-vertical"></li>
                  <li><a href="#"><i class="icon-home icon-white"></i> Startseite</a></li>
              </ul>
              <div class="pull-right">
                <ul class="nav pull-right">
                  <!--  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Herzlich Willkommen auf deinem Profil<b class="caret"></b></a> -->
                            <li class="divider"></li>
                            <form id=logout action="logout.php">
                                <input type="submit" value="Logout"
                </ul>
              </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>