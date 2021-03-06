<?php

// trois états

// récupération du token, si y'a token on traite, sinon, on affiche la page de base
// l'adresse mail existe pas, on dit que c'est une arnaque.
// l'adresse mail existe, on envoie l'email et on affiche un message comme quoi ça a été envoyé.


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$etat = 'initial';

if(isset($_POST['submitpass'])) {

	if(isset($_POST['mdp1']) && isset($_POST['mdp1'])){

		if ($_POST['mdp1'] == $_POST['mdp2']){
		$token = $_POST['tokeninput'];
		$mdp1 = $_POST['mdp1'];

			require('connect.php');		
			$reqUpdatePass = $linkdpo->prepare(" UPDATE Comptes SET motdepasse = :mdp  WHERE token = :token ;");
			$reqUpdatePass->execute(array('mdp'=>$mdp1, 'token'=>$token));
			$reqUpdateToken = $linkdpo->prepare(" UPDATE Comptes SET token = NULL  WHERE motdepasse = :mdp ;");
			$reqUpdateToken->execute(array('mdp'=>$mdp1));
		}else{
			echo 'Les mots de passe sont différents<br>';
			echo 'Deux fois le même mot de passe il te faut saisir ';
		}

	}else {
		echo 'Deux fois le mot de passe il te faut saisir ';
	}
	// mettre à jour le mdp et supprimer le token lié
}

if(isset($_GET['t'])) {
    // token est initialisé, on permet le changement de mpd
    $token = $_GET['t'];
    
    // test si le token est disponible
    require('connect.php');
    
    $reqTokenExist = $linkdpo->prepare("SELECT token FROM Comptes WHERE token = :token");	
    $reqTokenExist->execute(array('token'=>$token ));
	
    $nbLignes = $reqTokenExist->rowCount();

    if($nbLignes > 0) $etat = 'token';


} else {
    // token non initialité
    if(isset($_POST['submitmail'])) {
        // mail submitté
        $destinataire = $_POST['adressemail'];
        require('connect.php');

        /*
            vérifier si le mail existe dans la bdd
            si il n'existe pas : on change l'état (mailexistepas), et on active l'erreur
            si il existe : on génère token on envoie mail
        */


    $reqSelectExist = $linkdpo->prepare("SELECT adressemail FROM Comptes WHERE adressemail = :adressemail");	
	$reqSelectExist->execute(array(	'adressemail'=>$destinataire ));



	$nbLignes = $reqSelectExist->rowCount();
		if($nbLignes < 1){
			// si il n'existe pas : on change l'état (mailexistepas) pour activer l'erreur 
			$etat='mailexistepas';
		
		}else {
		
        	$token = bin2hex(random_bytes(12));

       		// rentrer le token dans la base de donnée
		$reqInsertToken = $linkdpo->prepare("UPDATE Comptes SET token = :token WHERE adressemail = :adressemail");
		$reqInsertToken->execute(array('token'=>$token, 'adressemail'=>$destinataire ));
	

        	// Envoi du mail
        
        	$expediteur = 'mot-de-passe-perdu@eventy.com';
        	$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
       		$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n"; // l'en-tete Content-type pour le format HTML
        	$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
        	$headers .= 'From: "Eventy !"<'.$expediteur.'>'."\n"; // Expediteur
        	$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
	
        	$sujet = "Restaurer son mot de passe sur Eventy. ";
        	$message ="On change votre mail sur cette adresse: http://blaguesdfk.cluster021.hosting.ovh.net/restore.php?t=" . $token;

	

        		if(mail($destinataire,$sujet,$message,$headers)) {
        	  	    // mail bien envoyé
                    $etat = 'mailexiste';
        		} else {
          		    // mail mal envoyé
          		    $etat = 'erreurMail';
        		}
		}
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

            <p class="center">On vient de vous envoyer un mail sur <?php echo $destinataire; ?>. Le processus est lancé. Pensez à ouvrir votre boite mail.</p>

            <?php
        } else if ($etat == 'mailexistepas') {
            ?>

            <p class="center">Votre email n'existe pas dans notre dimension, etes-vous sur d'exister chez nous ?</p>

            <?php
        } else if($etat =='erreurMail') {
          ?>
          <p class="center">L'email s'est mal envoyé. Il y a eu une erreur, re-essayez.</p>
          <?php
        } else if ($etat == 'token') {
            ?>

             <h4 style="text-align:center; font-size: 2em;"> Parametrez un nouveau mot de passe </h4>
             <form action="restore.php" method="post">
                <label for="motdepasse">Nouveau mot de passe </label>
                <input type="password" name="mdp1"><br>
                <label for="motdepasse_verif">Verification</label>
		<input type="hidden" name="tokeninput" value="<?php echo $_GET['t']; ?>">
                <input type="password" name="mdp2"><br>
                <input type="submit" name="submitpass" value="Procéder">
            </form>

            <?php
        }
        ?>
    </div>
</body>
</html>
