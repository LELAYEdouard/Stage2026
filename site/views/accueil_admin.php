<section id="overlay_reduc" class="d-flex action hidden">
    <div id="contenu_reduc">
        <i class="bi bi-x-lg"></i>
        <h2>Réduction</h2>

        <form action="admin.php?reduc=1" method="post" onsubmit="return valider_reduc();">
            <input type="hidden" name="id" value="-1">
            
            <input type="submit" value="Valider">
        </form>
        <div class="alert alert-primary hidden" role="alert">
            Erreur de saisie ! 
        </div>
    </div>
</section>

<section id="overlay_modif" class="d-flex action hidden">
    <div id="contenu_modif">
        <i class="bi bi-x-lg"></i>
        <h2>Modifier</h2>

        <form action="admin.php?modif=1" method="post" onsubmit="return valider_modif();">
            <input type="hidden" name="id" value="-1">
            <input type="text" name="reference">
            <input type="text" name="nom">
            <input type="text" name="prix">
            <input type="text" name="quantite">
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

            vider_produit()
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

        
    </script>