<?php 
if(isset($_POST) && isset($_POST['id']) && $_POST['id'] != "-1"){
    
    $quantite = $_POST['new_qte'];
    $ancienne_quantite = $_POST['old_qte'];
    if ((str_contains($quantite,'+') and strpos($quantite,'+')==0) or (str_contains($quantite,'-') and strpos($quantite,'-')== 0)) {
        $nouvelle_quantite = $ancienne_quantite + (int) $quantite;
    }
    else if(str_contains($quantite,'+') and strpos($quantite,'+')!=0){
        $nouvelle_quantite = $ancienne_quantite + (int) substr($quantite,strpos($quantite,'+'));
    }
    else if(str_contains($quantite,'-') and strpos($quantite,'-')!= 0){
        $nouvelle_quantite = $ancienne_quantite + (int) substr($quantite,strpos($quantite,'-'));
    }
    else{
        $nouvelle_quantite = $quantite;
    }
    ProduitController::update(quantite:$nouvelle_quantite,id:$_POST['id']);
    header('Location: admin.php?stock=1');
}else{
    header('Location: admin.php');
}