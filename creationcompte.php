<?php
	if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){

		//require ('connect.php');
		try{
			$linkdpo = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
			echo 'connexion OK';
		}catch(Exception $e){
			echo 'connexion pas OK';
			die('Erreur: '.$e->getMessage());
		}
		print_r($linkdpo);
		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $linkdpo -> prepare("SELECT nom FROM comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();
		print_r($req);
		if($nbLignes < 1){
			$res = $linkdpo->prepare("INSERT INTO comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array('adressemail' => $adressemail, 'motdepasse' => $motdepasse));
			echo "Ajout effectué";
		}else {
			echo 'adresse mail déjà utilisée';
		}
	}
	else
	{
		echo 'Blanezkaj';
	}

?>

