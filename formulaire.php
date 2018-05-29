<?php
    include('connexioncompte.php');
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
            <a href='index.php'>
                <div id="logo">
                    <img src="chick.png" id="logo_chicken">  
                    <h3> Eventy </h3>
                </div>
            </a>
        </nav>
 
    
    <section>


        <div id="formulaire">
	    <h4 style="text-align:center; font-size: 2em;">Parlons de vous</h4>
	    <h4 style="text-align:center; font-size: 1.5em;">Parlem de vos</h4>
	    
            <form action="formulaireSQL.php" method="post">
            
               <table id="table">
               <tr>
                <td><label for="nom" required="required">Nom</label></td>
                <td><input type="text" name="nom"></td>
               </tr>
                
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input type="text" name="prenom"  required="required"></td>
                   </tr>
                
                <tr>
                    <td><label for="civ">Civilite</label></td>
                    <td><select name="civ">
                    <option value="Mdme">Madame</option>
                    <option value="M">Monsieur</option>
                    <option value="Autre">Autre</option>
                    </select></td>
                   </tr>
                
                <tr>
                    <td><label for="nsoc">Nom de la societe</label></td>
                    <td><input type="text" name="nsoc" required="required"></td>
                 </tr>
                <tr>
                
                    <td><label for="adresse">Adresse</label></td>
                    <td><input type="text" name="adresse" required="required"></td>
                </tr>
                
                <tr>
                    <td><label for="cp">Code postal</label></td>
                    <td><input type="text" name="cp" required="required"></td>
                </tr>
                <tr>
                    <td><label for="ville">Ville</label></td>
                    <td><input type="text" name="ville" required="required"></td>
                </tr>
                
               </table>
                
                <input id="terminer" type="submit" name="submit" value="Terminer">

            </form>
        </div>

      

    </section>
    
    
    <footer>
        
    </footer>
</body>
</html>
