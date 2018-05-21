<?php
	try{
		$linkdpo = new PDO("mysql:host=...;dbname=bla", "...", "...");
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
?>
