<?php
$mdp = new SensitiveParameterValue($_POST['mdp']);
if(!empty($_POST) && !empty($_POST['mail']) && !empty($mdp->getValue()) && connexion($_POST['mail'],$mdp)){
    $_SESSION['logged']=true;
}


header("Location: admin.php");