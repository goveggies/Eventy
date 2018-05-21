<?php
require('connect.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$isAdmin = false;

if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])) {
	$adressemail = $_POST['adressemail'];
	$motdepasse = $_POST['motdepasse'];
	
	$reqSelectExist = $linkdpo->prepare("SELECT id,motdepasse FROM Comptes WHERE adressemail = :adressemail;");	
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
		$res = $reqSelectExist->fetchAll();
		
		if($motdepasse == $res[0]['motdepasse'])
		{
			$_SESSION['id'] = $res[0]['id'];
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
