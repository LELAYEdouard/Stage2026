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

<style>
    * { box-sizing: border-box; }

#liste_stock {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 1.5rem;
  max-width: 800px;
}

.stock {
  display: flex;
  align-items: center;
  gap: 16px;
  background: #fff;
  border: 1px solid #ddd !important;
  border-radius: 10px !important;
  padding: 14px 18px;
  transition: border-color 0.15s;
}

.stock:hover {
  border-color: #aaa !important;
}

/* Code produit (le premier <p>) */
.stock > p:first-child {
  font-size: 11px;
  font-weight: 600;
  color: #999;
  min-width: 42px;
  margin: 0;
  letter-spacing: 0.03em;
}

/* Nom du produit (le deuxième <p>) */
.stock > p:nth-child(2) {
  flex: 1;
  font-size: 14px;
  font-weight: 500;
  color: #111;
  margin: 0;
}

.stock form {
  display: flex;
  align-items: center;
  gap: 8px;
}

.stock form label {
  font-size: 12px;
  color: #666;
  display: flex;
  align-items: center;
  gap: 4px;
}

.aide {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  border: 1px solid #ccc;
  font-size: 10px;
  color: #999;
  cursor: help;
}

.stock input[type="text"] {
  width: 72px;
  height: 32px;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 0 10px;
  font-size: 14px;
  text-align: center;
  background: #f8f8f8;
  transition: border-color 0.15s, box-shadow 0.15s;
}

.stock input[type="text"]:focus {
  outline: none;
  border-color: #333;
  box-shadow: 0 0 0 3px rgba(0,0,0,0.07);
}

.stock .btn.btn-dark {
  height: 32px;
  padding: 0 14px;
  background: #111;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: opacity 0.15s, transform 0.1s;
}

.stock .btn.btn-dark:hover { opacity: 0.8; }
.stock .btn.btn-dark:active { transform: scale(0.97); }
</style>