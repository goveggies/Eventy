
<?php

require('connect.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['qrcode'])) {
    
  // requête pour vérifier si le QR code est le même que 
$reqVerifyQR = $linkdpo->prepare('SELECT passQR FROM Comptes WHERE passQR = :passQR');
$reqVerifyQR->execute(array(
    'passQR'=>$_POST['qrcode']
));
    
    $count = $reqVerifyQR->rowCount();
    if($count > 0) {
        echo true;
    }
    echo false;
    
} else {
    header('Location: connexion.php');
}

?>