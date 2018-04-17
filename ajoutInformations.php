<?php
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$civ = $_POST['civ'];
	$nsoc = $_POST['nsoc'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$ville = $_POST['ville'];

	//require('connect.php');
	require('connexioncompte.php');
	//echo $id;
	$req = $linkpdo->prepare("SELECT nom FROM Comptes WHERE adressemail = :adressemail");	
	$req->execute(array(
		'adressemail'=>$adressemail,
		));	


?>
