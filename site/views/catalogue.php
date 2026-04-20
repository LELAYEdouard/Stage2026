
<div id="catalogue" class="d-flex flex-wrap gap-3 justify-content-center m-5"></div>
<script src="fonction_front/fonction.js"></script>
<script type="module">

const produits = await getProduits();

let affichage = produits

afficher_produits(affichage)

//recherche 
document.getElementById("recherche_bar").addEventListener('input',() => {
    let filtre_nom = document.getElementById("recherche_bar").value

    affichage = produits.filter(elt => {
        //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
        let reg = new RegExp("( |^)"+filtre_nom, "gi")
        return reg.test(elt.nom)
    })
    vider_produit()
    afficher_produits(affichage)
})
</script>