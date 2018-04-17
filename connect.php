<?php

	try{
		$linkpdo = new PDO("mysql:host=localhost;dbname=mcm0239a", "mcm0239a", "2pdcmpaa");
		echo 'connexion OK';
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}



?>
