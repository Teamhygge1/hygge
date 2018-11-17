<?php
include_once ('../header.php');
session_start();
$email = 'jg119@hdm-stuttgart.de';
?>
<html>
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optionales Theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Das neueste kompilierte und minimierte JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div id="benutzerseite">
    <div class="col-4" >


</div>
    <div class="container">
        <div class="row">
            <div>
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-6 col-md-4" >
                            <img src="rizky-subagja-1155257-unsplash.jpg" alt="" class="img-rounded img-responsive" />
                        </div>
                        <div class="col-sm-6 col-md-8"  id="benutzerinfo">
                            <h3>Infos Über mich:</h3>
                            <?php
                            $statement = $pdo->prepare("SELECT 'E-Mail', 'Name', 'Kürzel', 'Studiengang' FROM 'Profil' WHERE $email='E-Mail'");
                            $result = $statement->execute();
                            while ($zeile = $result->fetchObject()) {
                                echo "<ul>$zeile</ul>";
                            }

                            ?>
                        </div>

                    </div>
                    <div id="posts">
                        <h3>Meine Posts:</h3>
                        <?php
                        $statement = $pdo->prepare("SELECT 'E-Mail',  FROM 'Posts' WHERE $email='E-Mail'");
                        $result = $statement->execute();
                        while ($zeile = $result->fetchObject()) {
                            echo "<ul>$zeile</ul>";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
</html>