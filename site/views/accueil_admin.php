<!-- suppression -->
<section id="overlay_supp" class="d-flex action hidden">
    <div id="contenu_supp">
        <h2>Suppression</h2>
        <article class="d-flex">
            <form action="admin.php?action_prod=1" method="post">
                <input type="hidden" name="id" value="-1">
                <input type="hidden" name="action" value="supprimer">
                <input type="submit" class="btn btn-danger" value="Valider">
            </form>
            <button name="annuler" class="btn btn-secondary">Annuler</button>
        </article>
    </div>
</section>

<!-- reduction -->
<section id="overlay_reduc" class="d-flex action hidden">
    <div id="contenu_reduc">
        <i class="bi bi-x-lg"></i>
        <h2>Réduction</h2>
        <form action="admin.php?action_reduc=1" method="post" onsubmit="return valider_reduc();">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="id_reduc" value="-1">
            <input type="hidden" name="action" value="ajout">
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

<!-- modifier produit -->
<section id="overlay_modif" class="d-flex action hidden">
    <div id="contenu_modif">
        <i class="bi bi-x-lg"></i>
        <h2>Modifier</h2>

        <form action="admin.php?action_prod=1" method="post" enctype="multipart/form-data" onsubmit="return valider_modif();">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="action" value="modif">
            <input type="text" name="reference">
            <input type="text" name="nom">
            <input type="text" name="prix">
            <input type="text" name="quantite">
            <select name="cat">
                <?php foreach($all_cat as $cle => $val){ ?>
                <option value="<?= htmlentities($val["id"])?>" name="<?= htmlentities($val["nom_categorie"])?>"><?= htmlentities($val["nom_categorie"])?></option>
                <?php } ?>
            </select>
            <img id="image_visu" name="img" src=""/>
            <input type="file" id="imgInp" name="image"/>
            <input type="checkbox" name="local">
            <input type="submit" value="Valider">
        </form>
        <div class="alert alert-primary hidden" role="alert">
            Erreur de saisie ! 
        </div>
    </div>
</section>

<section id="overlay" class="d-flex action hidden">
    <div id="contenu" class="d-flex flex-column">
        <h4></h4>

        <button class="btn btn-dark" name="modifier">Modifier</button>
        <button class="btn btn-dark" name="reduction">Réduction</button>
        <a href="admin.php" class="btn btn-dark" name="liste">Liste des Réductions</a>
        
        <button class="btn btn-danger" name="supprimer">Supprimer</button>

    </div>
</section>

<div id="catalogue" class="mt-5 d-flex flex-wrap gap-3 justify-content-center"></div>

<script type="module">
    
        const produits = await getProduits();

        let affichage = produits
        let filtre_nom
        afficher_produits(affichage,"catalogue",1)

        //recherche avec mot clé dans le nom du produit
        document.getElementById("recherche_bar").addEventListener('input',() => {
        
            filtre_nom = document.getElementById("recherche_bar").value

            affichage = produits.filter(elt => {
                //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
                let reg = new RegExp("( |^)"+filtre_nom, "gi")
                let reg_ref = new RegExp("^"+filtre_nom, "gi")
                return reg.test(elt.nom) || reg_ref.test(elt.reference)
            })

            //recherche avec categorie
            <?php if(isset($_GET['cat'])){ ?>
            if(categorie != "all"){
                affichage = filtrer_cat(affichage,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>) 
            }
            <?php } ?>  

            vider_produit("catalogue")
            afficher_produits(affichage,"catalogue",1)
        })


        document.getElementById("contenu").addEventListener('click',event=> {event.stopPropagation()})
        document.getElementById("overlay").addEventListener('click',()=>{
            document.getElementById("overlay").classList.add("hidden")
        })

        document.getElementById("contenu_modif").addEventListener('click',event=> {event.stopPropagation()})
        document.getElementById("overlay_modif").addEventListener('click',()=>{
            document.getElementById("overlay_modif").classList.add("hidden")
        })

        document.querySelector("#contenu_modif .bi-x-lg").addEventListener('click',()=>{
            document.getElementById("overlay_modif").classList.add("hidden")
        })

        document.getElementById("contenu_reduc").addEventListener('click',event=> {event.stopPropagation()})
        document.getElementById("overlay_reduc").addEventListener('click',()=>{
            document.getElementById("overlay_reduc").classList.add("hidden")
        })

        document.querySelector("#contenu_reduc .bi-x-lg").addEventListener('click',()=>{
            document.getElementById("overlay_reduc").classList.add("hidden")
        })

        document.getElementById("contenu_supp").addEventListener('click',event=> {event.stopPropagation()})
        document.getElementById("overlay_supp").addEventListener('click',()=>{
            document.getElementById("overlay_supp").classList.add("hidden")
        })

        document.querySelector("#contenu_supp button[name=annuler]").addEventListener('click',()=>{
            document.getElementById("overlay_supp").classList.add("hidden")
        })

        //preview img changé
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                image_visu.src = URL.createObjectURL(file)
            }
        }

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