<?php


	if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){
		require ('connect.php');
		
		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $linkdpo->prepare("SELECT nom FROM Comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();
		
		if($nbLignes == 0){
			$res = $linkdpo->prepare("INSERT INTO Comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array(
				'adressemail' => $adressemail, 
				'motdepasse' => $motdepasse
			));			
			echo "Inscription réussie !";
			header('Location: connexion.php');	
		} else {
			echo 'Adresse mail déjà utilisée';
			session_destroy();
			header('Location: index.php?email=isused');	
		}
	}
	else
	{
		echo 'Erreur saisie';
		session_destroy();
		header('Location: index.html');	
	}
?>

