<?php 
require_once __DIR__ . "/../controllers/categorie_controller.php";
?>
<div id="catalogue" class="d-flex flex-wrap gap-3 justify-content-center m-5"></div>
<script src="fonction_front/fonction.js"></script>
<script type="module">  

const produits = await getProduits();

let affichage = produits

//filtre par categorie
<?php
if(isset($_GET['cat'])){
   
?>
const categorie= "<?php echo $_GET['cat']?>"

if(categorie != "all"){
    
    affichage = filtrer_cat(produits,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>)    
}
<?php
}
?>  

afficher_produits(affichage)

//recherche avec mot clé dans le nom du produit
document.getElementById("recherche_bar").addEventListener('input',() => {
    let filtre_nom = document.getElementById("recherche_bar").value

    affichage = produits.filter(elt => {
        //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
        let reg = new RegExp("( |^)"+filtre_nom, "gi")
        return reg.test(elt.nom)
    })

    //recherche avec categorie
    <?php
    if(isset($_GET['cat'])){
    ?>
    if(categorie != "all"){

        affichage = filtrer_cat(affichage,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>) 
    }
    else{
    }
    <?php
    }
    ?>  

    vider_produit()
    afficher_produits(affichage)
})


</script>