<?php
$lst = ReductionController::get($_GET['produit']);
?>

<section id="overlay_reduc" class="d-flex action hidden">
    <div id="contenu_reduc">
        <i class="bi bi-x-lg"></i>
        <h2>Réduction</h2>
        <form action="admin.php?action_reduc=1" method="post" onsubmit="return valider_reduc();">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="id_reduc" value="-1">
            <input type="hidden" name="action" value="modif">
            <input type="date" name="date_deb">
            <input type="date" name="date_fin">
            <label name="prix_base"></label>
            <input type="text" name="taux" value="">
            <input name="prix_reduit" readonly="readonly">
            <input type="submit" value="Valider">
        </form>
        <div class="alert alert-primary hidden" role="alert">
            Erreur de saisie ! 
        </div>
    </div>
</section>


<section>
    <h1>Réductions</h1>
    <?php if($lst){ ?>
        <div>
            <?php foreach($lst as $cle => $val){ ?>
            <div class="d-flex flex-row">
                <h4>Date de Début</h4>
                <p><?= $val["date_debut"]?></p>
                <h4>Date de Fin</h4>
                <p><?= $val["date_fin"]?></p>
                <h4>Taux de Réduction</h4>
                <p>-<?= $val["taux_reduction"]*100?>%</p>
                <button class="btn btn-dark" name="modifier" onclick=click_modif(<?= $_GET['produit'] ?>,<?= $val['id'] ?>,<?= $val['prix'] ?>,<?= $val['taux_reduction']*100 ?>,<?= $val['prix_reduit'] ?>,<?= '"' . $val['date_debut'] . '"'?>,<?='"' .  $val['date_fin']  . '"'?>)>Modifier</button>
                <form action="admin.php?action_reduc=1" method="post">
                    <input type="hidden" name="id" value="<?= $val['id'] ?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </form>
            </div>
            <?php } ?>
        </div>
    <?php }
    else{ ?>
        <h1>Pas de Réductions</h1>
    <?php } ?>
</section>

<script>
    document.getElementById("contenu_reduc").addEventListener('click',event=> {event.stopPropagation()})
    document.getElementById("overlay_reduc").addEventListener('click',()=>{
        document.getElementById("overlay_reduc").classList.add("hidden")
    })

    document.querySelector("#contenu_reduc .bi-x-lg").addEventListener('click',()=>{
        document.getElementById("overlay_reduc").classList.add("hidden")
    })

    //calcule le prix réduit 
    document.querySelector("#contenu_reduc input[name=taux]").addEventListener('input',()=>{
        let taux= document.querySelector("#contenu_reduc input[name=taux]").value
        if(!check_taux(taux) && taux != ""){
            console.log(taux)
            document.querySelector("#contenu_reduc input[name=prix_reduit]").value = Math.round(document.querySelector("#contenu_reduc label[name=prix_base]").innerHTML * (1 - taux/100) * 100)/100
        }else{
            
            document.querySelector("#contenu_reduc input[name=prix_reduit]").value=""
        }
    })
</script>