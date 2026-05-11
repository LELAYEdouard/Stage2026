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
                `click_produit(${prod.id},${prod.prix},${prod.reference}, ${JSON.stringify(prod.nom)}, ${prod.quantite},${prod.est_local},${prod.taux_reduction},${prod.prix_reduit},"${prod.nom_categorie}","${prod.url_img}", event)`
            );        
        }

        const wrapper = document.createElement("div")
        wrapper.classList.add("position-relative")

        const img = document.createElement("img")
        img.src = "img/"+prod.url_img
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

function vider_produit(){
    document.getElementById("catalogue").replaceChildren()
}

function filtrer_cat(json_prod, id_cat, id_cat_sub = []) {
    return json_prod.filter(prod => 
        prod.id_categorie == id_cat || id_cat_sub.includes(prod.id_categorie));
}

//fonction pour modifier et ajouter reduction lors du clic sur un produit
function click_produit(id,prix,ref,nom,qte,local,taux_reduc,prix_reduit,cat,url,event){
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

    //change le nom du bouton en fonction de la presence ou non d'une réduction
    if(taux_reduc){
        document.querySelector("#contenu button[name=reduction]").innerHTML = "Modifier réduction"
    }else{
        document.querySelector("#contenu button[name=reduction]").innerHTML = "Ajouter Réduction"
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

    let popup_modif = document.getElementById("overlay_modif")
    let popup_reduc = document.getElementById("overlay_reduc")

    //ouverture modification produit
    document.querySelector("button[name=modifier]").addEventListener('click',()=>{
        
        popup_prod.classList.add("hidden")
        popup_modif.classList.remove("hidden")

        document.querySelector("#contenu_modif input[name=id]").value = id
        document.querySelector("#contenu_modif input[name=nom]").placeholder = nom
        document.querySelector("#contenu_modif input[name=prix]").placeholder = prix
        document.querySelector("#contenu_modif input[name=quantite]").placeholder = qte
        document.querySelector("#contenu_modif input[name=reference]").placeholder = ref
        document.querySelector("#contenu_modif img").src = "img/"+url
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
        popup_reduc.classList.remove("hidden")

        
    })
}
function valider_reduc(){
    if(1){ 
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

function check_modif(){
    
    let nom = document.querySelector("#contenu_modif input[name=nom]").value
    let prix = document.querySelector("#contenu_modif input[name=prix]").value
    let qte = document.querySelector("#contenu_modif input[name=quantite]").value 
    let ref = document.querySelector("#contenu_modif input[name=reference]").value
    
    return ( check_nom(nom)) || (check_prix(prix)) || (check_quantite(qte))|| ( check_prix(ref))

}

function check_nom(nom){
    return nom.length > 50;
}

function check_prix(prix){
    let reg = new RegExp("[^0-9]+\.[^0-9]", "gi")
    return reg.test(prix);
}

function check_prix(ref){
    let reg = new RegExp("[^0-9]+", "gi")
    return reg.test(ref);
}

function check_quantite(qte){
    let reg = new RegExp("[^0-9]+", "gi")
    return reg.test(qte);
}