async function getProduits() {
    const res = await fetch("api/produit.php")
    return await res.json()
}

function afficher_produits(json_prod){

    const liste = document.getElementById("catalogue")
    
    for(const prod of json_prod){
        
        const card = document.createElement("div")
        card.classList.add("card", "text-center", "p-3","shadow")

        const img = document.createElement("img")
        img.src = "img/"+prod.url_img
        img.alt = prod.nom
        img.classList.add("card-img-top", "rounded", "mb-2")

        const cardBody = document.createElement("div")
        cardBody.classList.add("card-body", "p-0")

        const nom = document.createElement("p")
        nom.classList.add("card-title", "mb-1")
        nom.textContent = prod.nom

        const prix = document.createElement("p")
        prix.classList.add("card-text", "fw-bold")
        prix.textContent = prod.prix+" €"

        cardBody.appendChild(nom)
        cardBody.appendChild(prix)
        card.appendChild(img)
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