<?php
$etat = '';
if(isset($_POST['adressemail']) && isset($_POST['motdepasse'])){
		require ('connect.php');
		
		$adressemail = $_POST['adressemail'];
		$motdepasse = $_POST['motdepasse'];

		$req = $linkdpo->prepare("SELECT nom FROM Comptes WHERE adressemail = :adressemail");
		$req->execute(array('adressemail'=> $adressemail));
		$nbLignes = $req->rowCount();
		
		if($nbLignes == 0){
			$res = $linkdpo->prepare("INSERT INTO Comptes (adressemail, motdepasse)
								VALUES (:adressemail, :motdepasse)");
			$res->execute(array(
				'adressemail' => $adressemail, 
				'motdepasse' => $motdepasse
			));			
			$etat = "<p style='color: green'>Inscription réussie !</p>";	
		} else {
            $etat = "<p style='color:red;'>Adresse mail déjà utilisée</p>";
			session_destroy();
		}
	}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventy - lo vòstre eveniment grand encara</title>
    <link rel="stylesheet" href="style/screen.css">
    <link rel="icon" type="image/png" href="chick.png" />
    <link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
</head>
<body>
        <nav>
            <div id="logo">
                <img src="chick.png" id="logo_chicken">
                <h3> Eventy </h3>
            </div>
        </nav>
    <section>
        <div id="inscription">
	    <h4 style="text-align:center; font-size: 2em;">Inscription</h4>	
            <form action="index.php" method="post">
                <label for="adressemail">Adresse mail</label>
                <input type="email" name="adressemail"><br>
                <label for="motdepasse">Mot de passe</label>
                <input type="password" name="motdepasse" minlength="6" required><br>
               	 <input type="submit" name="submit" value="S'inscrire">
               	<a href="connexion.php">Connexion</a>       	
               <?php
                        echo $etat;
                ?>
            </form>
        </div>
    </section>

    <footer>
        
    </footer>
</body>
</html>

