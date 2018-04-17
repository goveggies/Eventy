<?php
	if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){

		try{
			$linkdpo = new PDO("mysql:host=localhost;dbname=mcm0239a", "mcm0239a", "2pdcmpaa");
			echo 'connexion OK';
		}catch(Exception $e){
			die('Erreur: '.$e->getMessage());
		}

		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $linkdpo -> prepare("SELECT nom FROM Comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();

		if($nbLignes < 1){

			$res = $linkdpo->prepare("INSERT INTO Comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array('adressemail' => $adressemail, 'motdepasse' => $motdepasse));
			echo "Ajout effectué";
		}else {
			echo 'adresse mail déjà utilisée';
		}
	}

?>

