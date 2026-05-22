<?php
$lst = ReductionController::get($_GET['produit']);
?>

<section id="overlay_reduc" class="d-flex action hidden">
    <div id="contenu_reduc" class="rounded">
        <i class="bi bi-x-lg"></i>
        <h2>Réduction</h2>
        <form action="admin.php?action_reduc=1" method="post" onsubmit="return valider_reduc();">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="id_reduc" value="-1">
            <input type="hidden" name="action" value="ajout">
            
            <div>
                <label>Date Début</label>
                <input type="date" name="date_deb">
            </div>
            <div>
                <label>Date Fin</label>
                <input type="date" name="date_fin">
            </div>
            <div>
                <label>Prix</label>
                <label name="prix_base"></label>
            </div>
            <div class="d-flex">
                <label>Taux de Réduction</label>
                <input type="number" min=0 max=100 name="taux" value="" class="form-control">
            </div>
            <div class="d-flex">
                <label>Prix Réduit</label>
                <input name="prix_reduit" readonly="readonly" class="bg-white form-control" disabled="disabled">
            </div>
            <input type="submit" value="Valider" class="btn btn-dark">
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
                <h4>Du</h4>
                <p><?= $val["date_debut"]?></p>
                <h4>Au</h4>
                <p><?= $val["date_fin"]?></p>
                <h4>Réduit de</h4>
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
        let val = document.querySelector("#contenu_reduc label[name=prix_base]").innerHTML
        if(!check_taux(taux) && taux != ""){
            document.querySelector("#contenu_reduc input[name=prix_reduit]").value = Math.round(val.substr(0,val.length -1) * (1 - taux/100) * 100)/100 +"€"
        }else{
            
            document.querySelector("#contenu_reduc input[name=prix_reduit]").value=""
        }
    })
</script>