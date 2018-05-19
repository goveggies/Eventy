<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventy - lo vòstre eveniment grand encara</title>
    <link rel="stylesheet" href="style/inscription_event.css">
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

        <div>
            
            <table id="table">
                <form action="participation_mail.php" method="post">
                    <?php 
                        session_start();
                        require('connect.php');
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


    <footer>
        
    </footer>
</body>
</html>

