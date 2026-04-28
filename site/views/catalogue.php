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

        <div class="card p-3 small d-flex flex-row justify-content-evenly">
            <button id="appliquer" type="button" class="btn btn-dark">Appliquer</button>  
            <a href="?catalogue=1" class="btn btn-dark">Renitialiser</a>        
        </div>
      
    </div>
</div>

<!-- catalogue -->
<div id="catalogue" class="d-flex flex-wrap gap-3 justify-content-center m-5"></div>

<script src="fonction_front/fonction.js"></script>
<script type="module">  

    const produits = await getProduits();

    let affichage = produits

    let filtre_nom 
    //filtre par categorie
    <?php if(isset($_GET['cat'])){?>
    const categorie= "<?php echo $_GET['cat']?>"

    if(categorie != "all"){
        affichage = filtrer_cat(produits,categorie,<?php echo json_encode(CategorieController::get_sub_cat($_GET['cat']));?>)    
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

    afficher_produits(affichage)

    //recherche avec mot clé dans le nom du produit
    document.getElementById("recherche_bar").addEventListener('input',() => {
        filtre_nom = document.getElementById("recherche_bar").value

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
        afficher_produits(affichage)
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

        //filtre
        affichage = produits.filter(elt => {
            if(!filtre_nom){
                filtre_nom = "."
            }
            //regex pour que la recherche corresponde au(x) mot(s) dans le titre du produit
            let reg = new RegExp("( |^)"+filtre_nom, "gi")
            
            return reg.test(elt.nom) && (input0.value <= elt.prix && input1.value >= elt.prix)
        })

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
        afficher_produits(affichage)
    })
</script>