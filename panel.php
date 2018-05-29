<?php
// requête pour l'évènement
$reqEvent = $linkdpo->prepare('SELECT * FROM EV_Evenement');
$reqEvent->execute();

$data = $reqEvent->fetchAll();

// requête pour l'utilisateur
$date = new DateTime($data['date']);



// requête pour vérifier si le QR code est le même que 
$reqVerifyQR = $linkpdo->prepare('SELECT passQR FROM Comptes WHERE passQR = :passQR');
$reqVerifyQR->execute(array(
    'passQR':$passQR
));


?>


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
