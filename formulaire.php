<?php

if (isset($_POST['submit'])) {

	

  if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nsoc']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp'])) {
	
	// connexion à la base de données	
		
	require('connexioncompte.php');
	
	// insérer nouveau contact
	
	$reqInsert = $linkpdo->prepare("INSERT INTO Comptes(nom, prenom, civilite, nomsociete, adresse, ville, cp) VALUES(:nom, :prenom, :civilite, :societe, :adresse, :ville, :cp) WHERE adressemail = $adressemail ;");	
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
  
  	//header('Location: formulaire.html');
  	printf('information manquante');
  	sleep(3);
  	header('Location: formulaire.html');
  }
} 


?>3