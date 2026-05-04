async function getProduits() {
    const res = await fetch("api/produit.php")
    return await res.json()
}

function afficher_produits(json_prod,id_div){

    const liste = document.getElementById(id_div)
    
    for(const prod of json_prod){
        
        const card = document.createElement("div")
        card.classList.add("card", "text-center", "p-3","shadow")

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

        if(prod.id_reduc){
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