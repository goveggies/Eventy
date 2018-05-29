<?php
	try{
		$linkdpo = new PDO("mysql:host=https://phpmyadmin.cluster021.hosting.ovh.net/index.php;dbname=blaguesdfkroot.mysql.db", "blaguesdfkroot
", "Tghyujki1234");
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
	session_start();
?>
