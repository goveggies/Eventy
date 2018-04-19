<?php
	if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){
		require ('connect.php');
		
		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $linkdpo->prepare("SELECT nom FROM comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();
		
		if($nbLignes == 0){
			$res = $linkdpo->prepare("INSERT INTO comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array(
				'adressemail' => $adressemail, 
				'motdepasse' => $motdepasse
			));			
			echo "Inscription réussie !";
			sleep(1);
			session_destroy();
			header('Location: connexion.html');	
		} else {
			echo 'Adresse mail déjà utilisée';
			sleep(1);
			session_destroy();
			header('Location: index.html');	
		}
	}
	else
	{
		echo 'Erreur saisie';
		session_destroy();
		header('Location: index.html');	
	}
?>

