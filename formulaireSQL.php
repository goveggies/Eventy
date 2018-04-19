<?php

if (isset($_POST['submit'])) {

	require('connect.php');

  if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nsoc']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp'])) 
	{
		$requete = "UPDATE comptes SET nom=:nom, prenom=:prenom, 
																							civilite=:civilite, nomsociete=:societe, 
																							adresse=:adresse, ville=:ville, cp=:cp 
																							WHERE id =".$_POST['id']." ;";
		
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
		print_r($reqInsert);
		header('Location: fin.html');
  } else {
  	print_r('Information manquante');
  	sleep(1);
  	header('Location: formulaire.php');
  }
} 


?>3
