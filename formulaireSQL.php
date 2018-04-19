<?php

if (isset($_POST['submit'])) {

	

  if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nsoc']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp'])) {
	// insérer nouveau contact
	
	$reqInsert = $_SESSION['linkpdo']->prepare("INSERT INTO Comptes(nom, prenom, civilite, nomsociete, adresse, ville, cp) VALUES(:nom, :prenom, :civilite, :societe, :adresse, :ville, :cp) WHERE id =". $_POST['id']." ;");	
	$reqInsert->execute(array(
		'id'=>$_POST['id']
		'nom'=>$_POST['nom'],
		'prenom'=>$_POST['prenom'],
		'civilite'=>$_POST['civ'],
		'societe'=>$_POST['nsoc'],
		'adresse'=>$_POST['adresse'],
		'ville'=>$_POST['ville'],
		'cp'=>$_POST['cp']
	));
	header('Location: index.html');
  } else {
  	//header('Location: formulaire.html');
  	printf('Information manquante');
  	sleep(3);
  	header('Location: formulaire.php');
  }
} 


?>3
