
<?php

if(isset($_POST['qrcode'])) {
  // requête pour vérifier si le QR code est le même que 
$reqVerifyQR = $linkpdo->prepare('SELECT passQR FROM Comptes WHERE passQR = :passQR');
$reqVerifyQR->execute(array(
    'passQR':$_POST['qrcode']
));
    
    $count = $reqVerifyQR->rowCount();
    if($count > 0) {
        echo true;
    }
    echo false;
    
}




?>