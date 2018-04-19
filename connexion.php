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
            <a href='index.php'>
                <div id="logo">
                    <img src="chick.png" id="logo_chicken">  
                    <h3> Eventy </h3>
                </div>
            </a>
        </nav>
    <section>
        <div id="inscription">
	    <h4 style="text-align:center; font-size: 2em;">Connexion à votre compte</h4>

		     <form action="formulaire.php" method="post">
                <label for="adressemail">Adresse mail</label>
                <input type="email" name="adressemail"><br>
                <label for="motdepasse">Mot de passe</label>
                <input type="password" name="motdepasse" minlength="6" required><br>
                <input type="submit" name="submit" value="Se connecter"><br>
        	    <a href="index.php"> S'inscrire</a><br>
               	<a href="restore.php">Mot de passe oublie</a><br>
                <?php
                    if(isset($_GET['mdp']))
                    {
                        echo "Mot de passe invalide";
                    }
                ?>
                   
            </form>
        </div>
    </section>

    <footer>
        
    </footer>
</body>
</html>
