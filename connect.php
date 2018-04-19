<?php

	try{
		$GLOBALS['linkdpo'] = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
		echo 'connexion OK';
	}catch(Exception $e){
		echo 'connexion pas OK';
		die('Erreur: '.$e->getMessage());
	}
	
?>
