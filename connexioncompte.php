<?php


if (isset($_POST['submit'])) {

if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])) {
	$adressemail = $_POST['adressemail'];
	$motdepasse = $_POST['motdepasse'];

	require('connect.php');
	
	$reqSelectExist = $linkpdo->prepare("SELECT nom FROM Comptes WHERE adressemail = :adressemail");	
	$reqSelectExist->execute(array(
		'adressemail'=>$adressemail,
		'motdepasse'=>$motdepasse	
	));
	
	$nbLignes = $reqSelectExist->rowCount();
	if($nbLignes < 1){
		// si ça existe pas, on peut pas se connecter, on dit ciao vers inscription
		header('Location: index.html');	
	}else {
		// si ça existe, on traite et on renvoie vers le formulaire
		// afficher le html (le formulaire d'infos)
		
	}

}



}






?>
