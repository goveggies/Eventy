<?php

require('connexion.php');

// requête pour l'évènement
$reqEvent = $linkdpo->prepare('SELECT * FROM EV_Evenement');
$reqEvent->execute();

$data = $reqEvent->fetchAll();

// requête pour l'utilisateur
$date = new DateTime($data['date']);



// requête pour vérifier si le QR code est le même que 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <link rel="stylesheet" href="style/screen.css">
    <link rel="stylesheet" href="style/admin.css">
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
             crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/instascan.min.js">
    </script>
  <script src="js/app.js"></script>
</head>

<body>
    <nav>
        <a href='index.php'>
            <div id="logo">
                <img src="chick.png" id="logo_chicken">
                <h3> Eventy </h3>
            </div>
        </a>
    </nav>
    <section>
        <div id="panel">
            <h4 style="text-align:center; font-size: 2em;">Panel d'organisation</h4>
            <div id="panel-container">

                <h4> <?php echo $data['nom']; ?> <span class="inscrit">(75 inscrits)</span></h4>
                <div class="details">Le <span class="date"><?php echo $date->format('Y-m-d'); ?></span> à <span class="lieu"><?php echo $data['lieu']; ?></span></div>
                <div class="avancement-container">
                    <div class="avancement-bar"></div>
                </div>
                <p class="pourcentage_avancement"> Presence: 85 %</p>

                <div id="qrcode"></div>
                <div id="video">
                    <button id="btn_video" class="pointage">Faire un pointage</button>
                    <div></div>
                    <button id="btn_exitVideo" class="hidden">Arreter le scanning</button>
                </div>
                
                
                <h5 id="load_participants">
                        Voir les participants >
                </h5>
                
            </div>
        </div>
    </section>
</body>

</html>