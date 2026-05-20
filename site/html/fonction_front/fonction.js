async function getProduits() {
    const res = await fetch("api/produit.php")
    return await res.json()
}

//affiche les produit dans un element avec l'id mit en parametre
function afficher_produits(json_prod,id_div,admin){

    const liste = document.getElementById(id_div)
    
    for(const prod of json_prod){
        
        const card = document.createElement("div")
        card.classList.add("card", "text-center", "p-3","shadow")
        if(admin){
            card.setAttribute(
                'onclick',
                `click_produit(${prod.id},${prod.prix},${prod.reference}, ${JSON.stringify(prod.nom)}, ${prod.quantite},${prod.est_local},${prod.taux_reduction},${prod.prix_reduit},"${prod.nom_categorie}","${prod.url_img}","${prod.date_debut}","${prod.date_fin}",${prod.id_reduc} ,event)`
            );        
        }

        const wrapper = document.createElement("div")
        wrapper.classList.add("position-relative")

        const img = document.createElement("img")
        img.src = "img/prod/"+prod.url_img
        img.alt = prod.nom
        img.classList.add("card-img-top", "rounded", "mb-2")

        const cardBody = document.createElement("div")
        cardBody.classList.add("card-body", "p-0")

        const nom = document.createElement("p")
        nom.classList.add("card-title", "mb-1")
        nom.textContent = prod.nom

        
        if(prod.est_local == 1){
            const badge = document.createElement("span")
            
            badge.innerHTML= `<img src="img/local.png" style="height:3em;">`
            
            badge.classList.add("position-absolute", "top-0", "end-0")
            
            wrapper.appendChild(badge)
        }
        
        cardBody.appendChild(nom)

        if(prod.date_fin && Date.now() <= Date.parse(prod.date_fin)){
            const conteneur_prix = document.createElement("div")
            conteneur_prix.classList.add("d-flex","flex-row","justify-content-evenly","align-items-center")

            const prix_base = document.createElement("p")
            prix_base.classList.add("text-decoration-line-through")
            prix_base.textContent = prod.prix+" €"

            const prix_reduit = document.createElement("p")
            prix_reduit.classList.add("fw-bold")
            prix_reduit.textContent = prod.prix_reduit+" €"

            const reduc = document.createElement("p")
            reduc.classList.add("fw-bold","rounded","p-1")
            reduc.textContent = "-"+prod.taux_reduction+" %"

            conteneur_prix.appendChild(prix_base)
            conteneur_prix.appendChild(prix_reduit)
            conteneur_prix.appendChild(reduc)
            cardBody.appendChild(conteneur_prix)
        }else{
            const prix = document.createElement("p")
            prix.classList.add("card-text", "fw-bold")
            prix.textContent = prod.prix+" €"

            cardBody.appendChild(prix)
        }

        wrapper.appendChild(img)
        card.appendChild(wrapper)
        card.appendChild(cardBody)
        liste.appendChild(card)
    }

}

//affiche les produit dans un element pour pourvoir modifier leur stock
function afficher_produits_stock(json_prod,id_div){

    const liste = document.getElementById(id_div)
    
    for(const prod of json_prod){
        const div = document.createElement("div")
            
        div.innerHTML= `<div class="stock border border-dark rounded d-flex">
                            <p>${prod.reference}</p>
                            <p>${prod.nom}</p>
                            <form action="admin.php?update_stock=1" method="post">
                                <label for="nb">Stock
                                    <span class="aide" title="' + ' devant pour ajouter une valeur\n' - ' devant pour retirer une valeur\net appuyez sur entrée pour valider\nex: '+52' ajoute 52 à la quantité dans le stock">?</span>
                                </label>
                                <input type="hidden" name="id" value=${prod.id}>
                                <input type="text" size="8" name="new_qte" value=${prod.quantite}>
                                <input type="text" size="8" name="old_qte" value=${prod.quantite} hidden>
                                <input type="submit" class="btn btn-dark" value="Valider">
                            </form>
                        </div>`

        liste.appendChild(div)
    }
}


function vider_produit(id){
    document.getElementById(id).replaceChildren()
}

function filtrer_cat(json_prod, id_cat, id_cat_sub = []) {
    return json_prod.filter(prod => 
        prod.id_categorie == id_cat || id_cat_sub.includes(prod.id_categorie));
}

//fonction pour modifier et ajouter reduction lors du clic sur un produit
function click_produit(id,prix,ref,nom,qte,local,taux_reduc,prix_reduit,cat,url,date_debut,date_fin,id_reduc,event){
    let popup_prod = document.getElementById("overlay")
    let content = document.getElementById("contenu")
    
    //vider les input de modification
    document.querySelector("#contenu_modif input[name=nom]").value = ""
    document.querySelector("#contenu_modif input[name=prix]").value = ""
    document.querySelector("#contenu_modif input[name=quantite]").value = ""
    document.querySelector("#contenu_modif input[name=reference]").value = ""
    document.querySelector("#contenu_modif img").src = ""
    document.querySelector("#contenu_modif input[name=local]").checked = false
    
    //cache les erreur s'il en a eu
    document.querySelector("#contenu_modif .alert").classList.add("hidden")
    document.querySelector("#contenu_reduc .alert").classList.add("hidden")

    //change le nom du bouton en fonction de la presence ou non d'une réduction
    if(taux_reduc){
        document.querySelector("#contenu button[name=reduction]").innerHTML = "Modifier réduction"
        document.querySelector("#contenu_reduc input[name=action]").value = "modif"
    }else{
        document.querySelector("#contenu button[name=reduction]").innerHTML = "Ajouter Réduction"
        document.querySelector("#contenu_reduc input[name=action]").value = "ajout"
    }

    //si on clique trop a droite de l'ecran
    if(event.clientX > window.innerWidth-200){
        content.style.left = "";
        content.style.right = "0";
    }
    else{
        content.style.left = event.clientX + "px";
        content.style.right = "";
    }
    content.style.top = event.clientY + "px";
    popup_prod.classList.remove("hidden")
    
    document.querySelector("#contenu>h4").innerHTML = nom
    document.querySelector("a[name=liste]").href = `admin.php?liste_reduc=1&produit=${id}`

    let popup_modif = document.getElementById("overlay_modif")
    let popup_reduc = document.getElementById("overlay_reduc")
    let popup_liste = document.getElementById("overlay_liste")

    //ouverture modification produit
    document.querySelector("button[name=modifier]").addEventListener('click',()=>{
        
        popup_prod.classList.add("hidden")
        popup_modif.classList.remove("hidden")

        document.querySelector("#contenu_modif input[name=id]").value = id
        document.querySelector("#contenu_modif input[name=nom]").placeholder = nom
        document.querySelector("#contenu_modif input[name=prix]").placeholder = prix
        document.querySelector("#contenu_modif input[name=quantite]").placeholder = qte
        document.querySelector("#contenu_modif input[name=reference]").placeholder = ref
        document.querySelector("#contenu_modif img").src = "img/prod/"+url
        document.querySelector(`#contenu_modif option[name="${cat}"`).selected = true
        
        if(local == 1){
            document.querySelector("#contenu_modif input[name=local]").checked = true
        }else{
            document.querySelector("#contenu_modif input[name=local]").checked = false
        }
    })

    //ouverture reduction produit
    document.querySelector("button[name=reduction]").addEventListener('click',()=>{
        
        popup_prod.classList.add("hidden")
        click_modif(id,id_reduc,prix,taux_reduc,prix_reduit,date_debut,date_fin)

    })

}

function click_modif(id,id_reduc,prix,taux_reduc,prix_reduit,date_debut,date_fin){
    //vider input reduction
    document.querySelector("#contenu_reduc input[name=taux]").placeholder = ""
    document.querySelector("#contenu_reduc input[name=taux]").value = ""
    document.querySelector("#contenu_reduc label[name=prix_base]").innerHTML = ""
    document.querySelector("#contenu_reduc input[name=prix_reduit]").placeholder = ""
    document.querySelector("#contenu_reduc input[name=date_deb]").value = ""
    document.querySelector("#contenu_reduc input[name=date_fin]").value = ""
    
    document.getElementById("overlay_reduc").classList.remove("hidden")
    
    document.querySelector("#contenu_reduc input[name=id]").value = id
    document.querySelector("#contenu_reduc label[name=prix_base]").innerHTML = prix

    if(taux_reduc){
        document.querySelector("#contenu_reduc input[name=id_reduc]").value = id_reduc
        document.querySelector("#contenu_reduc input[name=taux]").placeholder = taux_reduc
        document.querySelector("#contenu_reduc input[name=prix_reduit]").placeholder = prix_reduit
        document.querySelector("#contenu_reduc input[name=date_deb]").value = date_debut
        document.querySelector("#contenu_reduc input[name=date_fin]").value = date_fin
    }
}

function valider_reduc(){
    
    if(check_reduc()){ 
        document.querySelector("#contenu_reduc .alert").classList.remove("hidden")
        return false;
    }

  return true;
}
function valider_modif(){
    if(check_modif()){ 
        document.querySelector("#contenu_modif .alert").classList.remove("hidden")
        return false;
    }

    return true;
}

function valider_ajout(){
    if(check_ajout()){ 
        document.querySelector(".alert").classList.remove("hidden")
        return false;
    }
    console.log("oui")
    return true;
}

function check_reduc(){
    
    let taux = document.querySelector("#contenu_reduc input[name=taux]").value
    let date_deb = document.querySelector("#contenu_reduc input[name=date_deb]").value
    let date_fin = document.querySelector("#contenu_reduc input[name=date_fin]").value 
    
    return ( check_taux(taux)) || (check_date(date_deb,date_fin))

}

function check_date(debut,fin){
    return debut == "" || fin == "" || fin < debut ;
}

function check_taux(taux){
    let reg = new RegExp("^([0-9]|([1-9][0-9])|100)$", "gi")
    return !reg.test(taux) && taux != "";
}

function check_modif(){
    
    let nom = document.querySelector("#contenu_modif input[name=nom]").value
    let prix = document.querySelector("#contenu_modif input[name=prix]").value
    let qte = document.querySelector("#contenu_modif input[name=quantite]").value 
    let ref = document.querySelector("#contenu_modif input[name=reference]").value
    
    return ( check_nom(nom) ) || (check_prix(prix)) || (check_quantite(qte))|| ( check_ref(ref))

}
function check_ajout(){
    
    let nom = document.querySelector(" input[name=nom]").value
    let prix = document.querySelector("input[name=prix]").value
    let qte = document.querySelector(" input[name=qte]").value 
    let ref = document.querySelector(" input[name=reference]").value
    console.log(nom,prix,qte,ref)
    console.log( check_nom(nom) || nom =="") && (check_prix(prix)|| prix =="") && (check_quantite(qte))&& ( check_ref(ref)||ref =="")

    return ( check_nom(nom) || nom =="") || (check_prix(prix)|| prix =="") || (check_quantite(qte))|| ( check_ref(ref)||ref =="")

}


function check_nom(nom){
    return nom.length > 50;
}

function check_prix(prix){
    let reg = new RegExp("[^0-9]+\.[^0-9]", "gi")
    return reg.test(prix);
}

function check_ref(ref){
    let reg = new RegExp("[^0-9]+", "gi")
    return reg.test(ref);
}

function check_quantite(qte){
    let reg = new RegExp("[^0-9]+", "gi")
    return reg.test(qte);
}