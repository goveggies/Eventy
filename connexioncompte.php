<?php
require('connect.php');

if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])) {
	$adressemail = $_POST['adressemail'];
	$motdepasse = $_POST['motdepasse'];
	
	$reqSelectExist = $linkdpo->prepare("SELECT id,motdepasse FROM comptes WHERE adressemail = :adressemail;");	
	$reqSelectExist->execute(array(
		'adressemail'=> $adressemail
		));
	$nbLignes = $reqSelectExist->rowCount();

	

	if($nbLignes == 0)
	{
		header('Location: index.html');	
	} else if($nbLignes == 1) {
		$res = $reqSelectExist->fetchAll();
		
		if($motdepasse == $res[0]['motdepasse'])
		{
			$_SESSION['id'] = $res[0]['id'];
		} else {
			echo "Mot de passe non valide";
			$reqSelectExist -> closeCursor();
			header('Location: index.html');	
		}

	} else {
		echo "Erreur 666 - Explosion dans 3...2...1...";
		$reqSelectExist -> closeCursor();
		header('Location: index.html');		
	}

	$reqSelectExist -> closeCursor();
}
?>
