<?php
if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])) {
	$adressemail = $_POST['adressemail'];
	$motdepasse = $_POST['motdepasse'];

	require('connect.php');
	
	$reqSelectExist = $linkpdo->prepare("SELECT id,motdepasse FROM Comptes WHERE adressemail = :adressemail;");	
	$reqSelectExist->execute(array(
		'adressemail'=> $adressemail
		));
	
	$nbLignes = $reqSelectExist->rowCount();


	if($nbLignes == 0){
		// si ça existe pas, on peut pas se connecter, on dit ciao vers inscription
		header('Location: index.html');	
	}else if($nbLignes == 1){
		
		$res = $reqSelectExist->fetchAll();
		
		if($motdepasse == $res[0]['motdepasse'])
		{
			echo "Mot de passe valide";
			$id = $res[0]['id'];
			header('Location: formulaire.html?id='.$id);	
		} else {
			echo "Mot de passe non valide";
			header('Location: index.html');	
		}

	} else {
		echo "Erreur 666 - Explosion dans 3...2...1...";		
	}

	$reqSelectExist -> closeCursor();
}
?>
