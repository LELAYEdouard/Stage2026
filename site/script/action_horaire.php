<?php 
if(isset($_POST)){
    $lst = [];
    for ($i=0; $i < count($_POST)/2 ; $i++) { 
        $lst[$i] = ['jour'.$i+1 => $_POST['jour'.$i+1],'horaire'.$i+1 => $_POST['horaire'.$i+1]];
    }
    $lst = serialize($lst);
    requete("UPDATE _compte_admin SET horaire = :horaire",[':horaire'=> $lst]);
    header('Location: admin.php?horaire=1');
}else{
    header('Location: admin.php');
}