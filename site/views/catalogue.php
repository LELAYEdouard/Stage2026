<?php 
require_once __DIR__ . "/../controllers/categorie_controller.php";
require_once __DIR__ . "/../controllers/produit_controller.php";
?>
<!-- bouton tri et filtre -->
<button class="btn btn-dark position-fixed z-3" 
    type="button" 
    data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasBottom" 
    aria-controls="offcanvasBottom" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Tris et Filtres">
    <i class="bi bi-sliders"></i>
</button>

<!-- parametre tri et filtre -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Tris et Filtres</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        
    </div>

    <div class="offcanvas-body small d-flex flex-column align-items-center">

        <div class="card p-3 shadow-sm w-100" style="max-width: 350px;">
            
            <h6 class="mb-3">Filtrer par prix</h6>

            <!-- Slider -->
            <div id="slider" class="mb-4"></div>

            <!-- Inputs -->
            <div class="row g-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" id="input-with-keypress-0" class="form-control" placeholder="Min">
                    </div>
                </div>

                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" id="input-with-keypress-1" class="form-control" placeholder="Max">
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-3 shadow-sm w-100" style="max-width: 350px;">
            <h6 class="mb-3">Trier par</h6>

            <select id="select_tri" class="form-control">
                <option selected value="none">Pas de tri</option>
                <option value="1">Prix Croissant</option>
                <option value="2">Prix Décroissant</option>
                <option value="3">Alphabetique A-Z</option>
                <option value="4">Alphabetique Z-A</option>
            </select>
            
        </div>

        <div class="card p-3 shadow-sm w-100" style="max-width: 350px;">
            <h6>Afficher uniquement</h6>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switch_locaux">
                <label class="form-check-label" for="switch_locaux">Produit Locaux</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switch_reduc">
                <label class="form-check-label" for="switch_reduc">Produit en Réduction</label>
            </div>
        </div>

        <div class="card p-3 small d-flex flex-row shadow-sm justify-content-evenly w-100" style="max-width: 350px;">
            <button id="appliquer" type="button" class="btn btn-dark">Appliquer</button>  
            <a href="?catalogue=1" class="btn btn-dark">Renitialiser</a>        
        </div>

    </div>
</div>

<!-- catalogue -->
<?php if(!isset($_GET['search'])){?>
<div class="m-3" id="sect_prod_locaux">
    <h2>Produits Locaux</h2>
    <div class="d-flex flex-row align-items-center">
        <button id="bouton_gauche"><i class="bi bi-chevron-left"></i></button>
        <div id="prod_locaux" class="d-flex flex-row flex-nowrap p-3"></div>
        <button id="bouton_droit"><i class="bi bi-chevron-right"></i></button>
    </div>
</div>
<div class="m-3" id="sect_prod_reduc">
    <h2>Produits en Réduction</h2>
    <div class="d-flex flex-row align-items-center">
        <button id="bouton_gauche"><i class="bi bi-chevron-left"></i></button>
        <div id="prod_reduc" class="d-flex flex-row flex-nowrap p-3"></div>
        <button id="bouton_droit"><i class="bi bi-chevron-right"></i></button>
    </div>
</div>
<?php }?>  
<div class="m-3">
    <h2><?php if(isset($_GET['cat']) and $_GET['cat']!='all'){echo CategorieController::get_nom_cat($_GET['cat']);}else{echo "Tout les produits";}?></h2>
    <div id="catalogue" class="d-flex flex-wrap gap-3 justify-content-center"></div>
</div>

<script src="fonction_front/fonction.js"></script>
<script type="module">  

    const produits = await getProduits();

    let affichage = produits

    let filtre_nom

    let affichage_locaux = produits.filter(elt => { return elt.est_local == 1; })
    let affichage_reduc = produits.filter(elt => { return elt.id_reduc != null; })

    //filtre par categorie
    <?php if(isset($_GET['cat'])){?>
    const categorie= "<?php echo $_GET['cat']?>"

    if(categorie != "all"){
        affichage = filtrer_cat(produits,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>)  
        affichage_locaux = affichage.filter(elt => { return elt.est_local == 1; }) 
        affichage_reduc = affichage.filter(elt => { return elt.id_reduc != null; })
    }
    <?php }?>  

    <?php if(isset($_GET['search'])){?>
        filtre_nom = "<?php echo $_GET['search']?>"
        console.log(filtre_nom)

        affichage = produits.filter(elt => {
            //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
            let reg = new RegExp("( |^)"+filtre_nom, "gi")
            return reg.test(elt.nom)
        })

    <?php }?>

    afficher_produits(affichage,"catalogue")
    afficher_produits(affichage_locaux,"prod_locaux")
    afficher_produits(affichage_reduc,"prod_reduc")

    //si pas de produit locaux , ne pas afficher la div
    if(affichage_locaux.length == 0){
        document.getElementById("sect_prod_locaux").classList.add("hidden")
    }

    //si pas de produit reduc , ne pas afficher la div
    if(affichage_reduc.length == 0){
        document.getElementById("sect_prod_reduc").classList.add("hidden")
    }

    //recherche avec mot clé dans le nom du produit
    document.getElementById("recherche_bar").addEventListener('input',() => {
    
        filtre_nom = document.getElementById("recherche_bar").value

        if(filtre_nom){
            //cache section produit locaux
            document.getElementById("sect_prod_locaux").classList.add("hidden")
        }
        else{
            document.getElementById("sect_prod_locaux").classList.remove("hidden")
        }

        affichage = produits.filter(elt => {
            //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
            let reg = new RegExp("( |^)"+filtre_nom, "gi")
            return reg.test(elt.nom)
        })

        //recherche avec categorie
        <?php if(isset($_GET['cat'])){ ?>
        if(categorie != "all"){
            affichage = filtrer_cat(affichage,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>) 
        }
        <?php } ?>  

        vider_produit()
        afficher_produits(affichage,"catalogue")
    })
    

    const max_prix = <?php echo ProduitController::max_prix();?>

    //tri filtres venant d'un exemle du site nouislider
    var stepsSlider = document.getElementById('slider');
    var input0 = document.getElementById('input-with-keypress-0');
    var input1 = document.getElementById('input-with-keypress-1');
    var inputs = [input0, input1];

    noUiSlider.create(stepsSlider, {
        start: [0, max_prix],
        connect: true,
        range: {
            min:0,
            max:max_prix
        }
        
    });

    stepsSlider.noUiSlider.on('update', function (values, handle) {
        inputs[handle].value = values[handle];

    })
    ;

    inputs.forEach(function (input, handle) {

        input.addEventListener('change', function () {
            stepsSlider.noUiSlider.setHandle(handle, this.value);
        });

    })

    document.getElementById("appliquer").addEventListener('click',()=>{

        //cache section produit locaux
        document.getElementById("sect_prod_locaux").classList.add("hidden")

        let locaux = document.getElementById("switch_locaux").checked
        let reduc = document.getElementById("switch_reduc").checked

        //filtre
        affichage = produits.filter(elt => {
            if(!filtre_nom){
                filtre_nom = "."
            }
            //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
            let reg = new RegExp("( |^)"+filtre_nom, "gi")
            if(elt.id_reduc){
                return reg.test(elt.nom) && (input0.value <= elt.prix_reduit && input1.value >= elt.prix_reduit)
            }
            return reg.test(elt.nom) && (input0.value <= elt.prix && input1.value >= elt.prix)
        })

        if(locaux){
            affichage = affichage.filter(elt => {
                return elt.est_local == 1;
            })
        }

        if(reduc){
            affichage = affichage.filter(elt => {
                return elt.id_reduc != null;
            })
        }

        //tri
        let tri = document.getElementById("select_tri").value

        switch (tri) {
            case "1":
                affichage.sort((a, b) => a.prix - b.prix);
                break;

            case "2":
                affichage.sort((a, b) => b.prix - a.prix);
                break;

            case "3":
                //source MDN
                affichage.sort((a, b) => {
                    const nameA = a.nom.toUpperCase(); // ignorer les majuscules/minuscules
                    const nameB = b.nom.toUpperCase(); // ignorer les majuscules/minuscules
                    if (nameA < nameB) {
                        return -1;
                    }
                    if (nameA > nameB) {
                        return 1;
                    }

                    // les noms sont égaux
                    return 0;
                });
                break;

            case "4":
                //source MDN
                affichage.sort((a, b) => {
                    const nameA = a.nom.toUpperCase(); // ignorer les majuscules/minuscules
                    const nameB = b.nom.toUpperCase(); // ignorer les majuscules/minuscules
                    if (nameA > nameB) {
                        return -1;
                    }
                    if (nameA < nameB) {
                        return 1;
                    }

                    // les noms sont égaux
                    return 0;
                });
                break;

            default:
                break;
        }

        //recherche avec categorie
        <?php if(isset($_GET['cat'])){ ?>
        if(categorie != "all"){
            affichage = filtrer_cat(affichage,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>) 
        }
        <?php } ?>  

        vider_produit()
        afficher_produits(affichage,"catalogue")
    })

    let prod_locaux_slider = document.getElementById("prod_locaux")

    let bouton_droit = document.getElementById("bouton_droit")
    let bouton_gauche = document.getElementById("bouton_gauche")

    bouton_droit.addEventListener('click', () =>{
        prod_locaux_slider.scrollLeft += 300
    })

    bouton_gauche.addEventListener('click', () =>{
        prod_locaux_slider.scrollLeft -= 300
    })
</script>