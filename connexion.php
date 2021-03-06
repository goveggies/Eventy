<?php


require('connect.php');

if(isset($_GET['disconnect']) && $_GET['disconnect'] == 1) {
    session_destroy();
    header('Location: connexion.php');
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$logged = false;
$formulaireCompleted = false;
$isAdmin = false;

if(isset($_POST['submitFormulaire'])) {
    $formulaireCompleted = true;
}

if(isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
    $logged = true;
    $adressemail = $_SESSION['adressemail'];
	$reqSelectExist = $linkdpo->prepare("SELECT * FROM Comptes WHERE adressemail = :adressemail;");	
	$reqSelectExist->execute(array(
		'adressemail'=> $_SESSION['adressemail']
		));
        
    $res = $reqSelectExist->fetch();
    $_SESSION['id'] = $res['id'];
}




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
            $_SESSION['connected'] = true;
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
            <?php if($logged) { ?>
            <a href="connexion.php?disconnect=1" style="position: absolute; right: 9px; top: 9px; font-size: 0.7em;">Déconnexion</a>
            <?php } ?>
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
                    $nbParticipant = $data['nbparticipant'];
                    $nbInscrit = $data['nbInscrit'];

                    $tauxPresence = ($nbParticipant/$nbInscrit)*100;

                    
                ?>    
                    
                    <div id="panel">
                        <h4 style="text-align:center; font-size: 2em;">Panel d'organisation</h4>
                        <div id="panel-container">

                        <h4> <?php echo $data['nom']; ?> <span class="inscrit">(<?php echo $nbInscrit; ?> inscrits)</span></h4>
                        <div class="details">Le <span class="date"><?php echo $date->format('Y-m-d'); ?></span> à <span class="lieu"><?php echo $data['lieu']; ?></span></div>
                        <div class="avancement-container">
                        <div class="avancement-bar" style="width:<?php echo round($tauxPresence, 1); ?>%"></div>
                        </div>
                        <p class="pourcentage_avancement"> Presence: <?php echo round($tauxPresence, 1); ?> %</p>

                        <div id="qrcode"></div>
                        <div id="video">
                        <button id="btn_video" class="pointage">Faire un pointage</button>
                        <div class="reponse"></div>
                        <button id="btn_exitVideo" class="hidden">Arreter le scanning</button>
                        </div>


                        <h5 id="load_participants">
                        Les participants >
                        </h5>
                        </div>
                    </div>
                    
                <?php  
                } else {
                    // non admin
                    // a rempli formulaire ou non formulaire
                    if (($formulaireCompleted == true) || !empty($res['nom'])){
                        // afficher la page pour s'inscrire
                        if (isset($_POST['submitFormulaire'])) {

                            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nsoc']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp'])) 
                            {
                                $requete = "UPDATE Comptes SET nom=:nom, prenom=:prenom, civilite=:civilite, nomsociete=:societe, adresse=:adresse, ville=:ville, cp=:cp WHERE id =".$_POST['id']." ;";

                                $reqInsert = $linkdpo->prepare($requete);   
                                $reqInsert->execute(array(
                                    'nom'=>$_POST['nom'],
                                    'prenom'=>$_POST['prenom'],
                                    'civilite'=>$_POST['civ'],
                                    'societe'=>$_POST['nsoc'],
                                    'adresse'=>$_POST['adresse'],
                                    'ville'=>$_POST['ville'],
                                    'cp'=>$_POST['cp']
                                ));
                            } else {
                                    $formulaireCompleted = false;
                                    sleep(1);
                                    header('Location: connexion.php');
                            }
                        } 





                        include('lien_inscription_event.php');
                    }
                    else if(empty($res['nom']) && !$formulaireCompleted) {
                        // afficher le formulaire car l'utilisateur ne l'a jamais rentré
                        include('formulaire.php');
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
