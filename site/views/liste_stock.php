<div id="liste_stock" class="d-flex flex-column justify-content-evenly"></div>

<script type="module">
    const produits = await getProduits()

    let affichage = produits
    let filtre_nom
    
    afficher_produits_stock(produits,"liste_stock")

    //recherche avec mot clé dans le nom du produit
    document.getElementById("recherche_bar").addEventListener('input',() => {
        
        filtre_nom = document.getElementById("recherche_bar").value
        
        affichage = produits.filter(elt => {
            //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
            let reg = new RegExp("( |^)"+filtre_nom, "gi")
            let reg_ref = new RegExp("^"+filtre_nom, "gi")
            return reg.test(elt.nom) || reg_ref.test(elt.reference)
        })

        vider_produit("liste_stock")
        afficher_produits_stock(affichage,"liste_stock")
    })
</script>