

<div id="lien_inscription">

<table id="table">
    <form action="participation_mail.php" method="post">
    <?php
        $reqMail = $linkdpo->prepare("SELECT adressemail FROM Comptes WHERE id = :id;");  
         if (isset($_SESSION['id']))
            $reqMail->execute(array(
                'id'=> $_SESSION['id']
                ));

        $res = $reqMail->fetch();

        $adressemail =$res['adressemail'];



        $etat = false;

        $reqSelectParticipation = $linkdpo->prepare("SELECT participant FROM Comptes WHERE adressemail = :adressemail");
        $reqSelectParticipation->execute(array('adressemail'=>$adressemail ));
        $dataParticipant = $reqSelectParticipation->fetch();
        if($dataParticipant['participant'] == 1) {
            $elementValue = "Vous participez";
            $elementOther = "disabled";
        } else {
            $elementValue = "Participer";
            $elementOther = "";
        }
    ?>
    <tr>
    <td><span>Les chaussettes chauffantes REQUIEM en la mineur</span>  
        <br> <span id="heure"> Horaire: 20h - 23h </span>
        <br> <span id="lieu"> Lieu: Tripode C </span></td>
        
    <td class="buttonsubmit"><input type="submit" name="submit" <?php echo 'value="'.$elementValue.'"'; echo ' '.$elementOther;?>/>
    </td>
    </tr>
    <input type="hidden" name="adressemail" <?php echo 'value="'.$adressemail.'"'; ?>/>
    </form>
</table>

<?php 
$reqMail -> closeCursor();
?>




</div>

