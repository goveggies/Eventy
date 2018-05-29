<?php


require('connect.php');
//session_destroy();
$logged = false;
$isAdmin = false;

if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
    $logged = true;
    	
    $adressemail = $_SESSION['adressemail'];
	$reqSelectExist = $linkdpo->prepare("SELECT * FROM Comptes WHERE adressemail = :adressemail;");	
	$reqSelectExist->execute(array(
		'adressemail'=> $_SESSION['adressemail']
		));
        
    $res = $reqSelectExist->fetch();
    
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include('participation_mail.php');




if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])) {
	$adressemail = $_POST['adressemail'];
	$motdepasse = $_POST['motdepasse'];
    $logged = true;
    $_SESSION['adressemail'] = $adressemail;
	
	$reqSelectExist = $linkdpo->prepare("SELECT * FROM Comptes WHERE adressemail = :adressemail;");	
	$reqSelectExist->execute(array(
		'adressemail'=> $adressemail
		));
	$nbLignes = $reqSelectExist->rowCount();
	
	$reqVerifyAdmin = $linkdpo->prepare("SELECT admin FROM Comptes WHERE adressemail = :adressemail;");
	$reqVerifyAdmin->execute(array('adressemail'=>$adressemail));
	$data=$reqVerifyAdmin->fetch();

	if($data['admin'] == 1) {
		$isAdmin = true;
	}
	



	if($nbLignes == 0)
	{
		header('Location: index.php');	
	} else if($nbLignes == 1) {
		$res = $reqSelectExist->fetch();
		
		if($motdepasse == $res['motdepasse'])
		{
			$_SESSION['id'] = $res['id'];
		} else {
			$reqSelectExist -> closeCursor();
			header('Location: connexion.php?mdp=invalide');	
		}

	} else {
		echo "Erreur 666 - Explosion dans 3...2...1...";
		$reqSelectExist -> closeCursor();
		header('Location: index.php');		
	}

	$reqSelectExist -> closeCursor();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventy - lo vòstre eveniment grand encara</title>
    <link rel="stylesheet" href="style/screen.css">
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
    <link rel="stylesheet" href="style/inscription_event.css">
    <link rel="stylesheet" href="style/admin.css">
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
             crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/instascan.min.js">
    </script>
  <script src="js/app.js"></script>
    <title>Eventy</title>
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
        <?php
            if($logged) {
                // connecté
                
                if($isAdmin) {
                    // si admin
                    
                    // requête pour l'évènement
                    $reqEvent = $linkdpo->prepare('SELECT * FROM EV_Evenement');
                    $reqEvent->execute();

                    $data = $reqEvent->fetch();

                    // requête pour l'utilisateur
                    $date = new DateTime($data['heure']);

                    
                ?>    
                    
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
                    
                <?php  
                } else {
                    // non admin
                    // a rempli formulaire ou non formulaire
                    if(empty($res['nom'])) {
                        // afficher le formulaire car l'utilisateur ne l'a jamais rentré
                        include('formulaire.php');
                    } else {
                        // afficher la page pour s'inscrire
                        include('lien_inscription_event.php');
                    }
                    
                }
                
                
            } else {
                // non connecté
            
        ?>
         
        <div id="inscription">
	    <h4 style="text-align:center; font-size: 2em;">Connexion à votre compte</h4>
		     <form action="connexion.php" method="post">
                <label for="adressemail">Adresse mail</label>
                <input type="email" name="adressemail"><br>
                <label for="motdepasse">Mot de passe</label>
                <input type="password" name="motdepasse" minlength="6" required><br>
                <input type="submit" name="submit" value="Se connecter"><br>
        	    <a href="index.php"> S'inscrire</a><br>
               	<a href="restore.php">Mot de passe oublie</a><br>
                <?php
                    if(isset($_GET['mdp']))
                    {
                        echo "<p style='color:red'> Mot de passe invalide </p>";
                    }
                ?>
                   
            </form> 
        </div>
        <?php
            } // fin du else (non logged) 
        ?>
    </section>

    <footer>
        
    </footer>
</body>
</html>
