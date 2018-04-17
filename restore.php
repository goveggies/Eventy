<?php

// trois états 

// récupération du token, si y'a token on traite, sinon, on affiche la page de base
// l'adresse mail existe pas, on dit que c'est une arnaque.
// l'adresse mail existe, on envoie l'email et on affiche un message comme quoi ça a été envoyé.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$etat = 'initial';

if(isset($_GET('t')) {
    // token est initialisé
    $etat = 'token';
} else {
    // token non initialité
    if(isset($_POST['submitmail'])) {
        // mail submitté
        
        /*
            vérifier si le mail existe dans la bdd
            si il n'existe pas : on active l'erreur
            si il existe : on envoie un mail en générant toekn
        */
    } else {
        // aucun mail submitté.
        echo 'pas de mail submitté';
    }
}





// mot de passe bien initialisé, on envoie sur la page pour dire que c'est bon, avec lien avec connnexion
// mot de passe mal initialisé, par similaire, on reload la page de restauration 

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventy - Restaurer un mot de passe</title>
    
    <link rel="stylesheet" href="style/screen.css">
    <link rel="icon" type="image/png" href="chick.png" />
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
</head>
<body>
    <div id="inscription">
        
        
        <?php
        
        if($etat == 'initial') {
            ?>    
               <h4 style="text-align:center; font-size: 2em;">Mot de passe disparu de vostre cap ? </h4>
                <form action="restore.php" method="post">
                    <label for="adressemail">Adresse mail</label>
                    <input type="email" name="adressemail"><br>
                    <input type="submit" name="submitmail" value="Récupération">
                </form>	
                <p class="center">Si l'adresse mail existe, on retourne vers vous ! </p>
            <?php
        } else if ($etat == 'mailexiste') {
            ?>
            
            <p class="center">On vient de vous envoyer un mail sur <?php echo $mail; ?>. Le processus est lance. Ouvrez votre boite mail.</p>
	    
            <?php
        } else if ($etat == 'mailexistepas') {
            ?>
              
            <p class="center">Votre email n'existe pas dans notre dimension, etes-vous sur d'exister chez nous ?</p>  
            
            <?php
        } else if ($etat == 'token') {
            
            // faire la recherche sql
            ?>
            
             <h4 style="text-align:center; font-size: 2em;"> Parametrez un nouveau mot de passe </h4>
             <form action="restore.php" method="post">
                <label for="motdepasse">Nouveau mot de passe </label>
                <input type="motdepasse" name="adressemail"><br>
                <label for="motdepasse_verif">Verification</label>
                <input type="motdepasse_verif" name="adressemail"><br>
                <input type="submit" name="submitpass" value="Procéder">
            </form>
            
            <?php
        }
   
   
        ?>
        
        
       
       
	   
        
    </div>
</body>
</html>