<?php

session_destroy();
$_SESSION['connected'] = false;
header('Location: connexion.php');

?>