

<div>

<table id="table">
    <form action="participation_mail.php" method="post">
    <?php
        $reqMail = $linkdpo->prepare("SELECT adressemail FROM comptes WHERE id = :id;");  
         if (isset($_SESSION['id']))
            $reqMail->execute(array(
                'id'=> $_SESSION['id']
                ));

        $res = $reqMail->fetchAll();

        $adressemail =$res[0]['adressemail'];
    ?>
    <tr>
    <td><span>Les chaussettes chauffantes REQUIEM en la mineur</span>  
        <br> <span id="heure"> Horaire: 20h - 23h </span>
        <br> <span id="lieu"> Lieu: Tripode C </span></td>
        
    <td class="buttonsubmit"><input type="submit" name="submit" value="Participer" onclick="alert('Merci de confirmer votre inscription à cet évènement via l email qui vient de vous être envoyé');"/>
    </td>
    </tr>
    <input type="hidden" name="adressemail" value="<?php echo $adressemail ?>">
    </form>
</table>

<?php 
$reqMail -> closeCursor();
?>




</div>

