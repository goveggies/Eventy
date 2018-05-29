<?php
if (isset($_POST['submitFormulaire'])) {

  if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nsoc']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp'])) 
	{
		$requete = "UPDATE Comptes SET nom=:nom, prenom=:prenom, civilite=:civilite, nomsociete=:societe, adresse=:adresse, ville=:ville, cp=:cp WHERE id =".$_POST['id']." ;";
		
		$reqInsert = $linkdpo->prepare($requete);	
		$reqInsert->execute(array(
			'nom'=>$_POST['nom'],
			'prenom'=>$_POST['prenom'],
			'civilite'=>$_POST['civ'],
			'societe'=>$_POST['nsoc'],
			'adresse'=>$_POST['adresse'],
			'ville'=>$_POST['ville'],
			'cp'=>$_POST['cp']
		));
		print_r($reqInsert);
		header('Location: connexion.php');
  } else {
  	print_r('Information manquante');
  	sleep(1);
  	header('Location: connexion.php');
  }
} 

?>



 
    
    <section>


        <div id="formulaire">
	    <h4 style="text-align:center; font-size: 2em;">Parlons de vous</h4>
	    <h4 style="text-align:center; font-size: 1.5em;">Parlem de vos</h4>
	    
            <form action="connexion.php" method="post">
            
               <table id="table">
                <tr>
                    <td><label for="civ">Civilite</label></td>
                    <td><select name="civ">
                    <option value="Mdme">Madame</option>
                    <option value="M">Monsieur</option>
                    <option value="Autre">Autre</option>
                    </select></td>
                </tr>
               <tr>
                <td><label for="nom" required="required">Nom</label></td>
                <td><input type="text" name="nom"></td>
               </tr>
                
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input type="text" name="prenom"  required="required"></td>
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
                
                <input id="terminer" type="submit" name="submitFormulaire" value="Terminer">

            </form>
        </div>

      

    </section>
    