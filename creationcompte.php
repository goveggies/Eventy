<?php
	if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){
		//require ('connect.php');
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=mcm0239a', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
		
	//	print_r($bdd);
		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $bdd -> prepare("SELECT nom FROM comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();
		
		if($nbLignes == 0){
			$res = $bdd->prepare("INSERT INTO comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array(
				'adressemail' => $adressemail, 
				'motdepasse' => $motdepasse
			));			
			echo "Ajout effectué";
		} else {
			echo 'Adresse mail déjà utilisée';
		}
	}
	else
	{
		echo 'Erreur saisie';
	}

?>

