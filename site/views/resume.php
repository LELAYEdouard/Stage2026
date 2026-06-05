<?php 


if(empty($_GET['fetch'])){
?>
<div class="d-flex justify-content-center align-items-center flex-column">
    <div class="spinner-border my-5" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div>
        <h1>Analyse du PDF, ne quittez pas</h1>
    </div>
</div>
<script>
    let json;
    
    let interval = setInterval(() => {
        fetchFacture();
    }, 1000);
    
    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    async function fetchFacture() {
        const res = await fetch("fetch.json")
        json = await res.text();
        if(isJsonString(json)){
            clearInterval(interval);
            window.location = "admin.php?resume=1&fetch=1";
        }
    }
    
</script>

<?php 
}
else{
$resume = file_get_contents('fetch.json');

?>
<h1>Résumé</h1>
<?php if(!isset($_GET['view'])){?>
<form action="admin.php?ajout_stock_fact=1" method="post">
    <input name="prod" type="hidden" value=''>
    <label></label>
    <button type="submit" class="btn btn-dark"></button>
</form>
<?php }?>
<div id="liste"></div>
<script type="module">
    const produits = JSON.parse('<?= $resume ?>')

    const all_produits = await getProduits();

    let lst = []

    for (const prod of Object.entries(produits)) {
        let nom= all_produits.find(element => { return element['reference'] == prod[0] })
        if(nom){
            nom = nom['nom']
            const resume = document.createElement("div")
            resume.innerHTML = `<p>référence : ${prod[0]}</p> <p>quantité : ${prod[1]}</p> <p>${nom}</p>`
            document.getElementById("liste").appendChild(resume)
        }
        <?php if(!isset($_GET['view'])){?>
        else{
            lst.push(prod)
        }
        <?php }?>

    }
    <?php if(!isset($_GET['view']) ){?>
    if(lst.length != 0){
        document.querySelector("form label").innerHTML = lst.length +" produit(s) manquant(s)"
        document.querySelector("form button").innerHTML = "Ajouter " +lst.length +" produit(s) manquant(s)"
        document.querySelector("form input").value = JSON.stringify(lst)
    }else{
        document.querySelector("form").classList.add('hidden')
    }
    <?php }?>

</script>
<style>
 #liste {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 12px;
  padding: 1.5rem;
  max-width: 1000px;
  margin: 0 auto;
}

/* chaque item */
#liste > div {
  display: grid;
  grid-template-rows: auto auto;

  background: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 14px 18px;

  transition: transform 0.15s, border-color 0.15s;
}

#liste > div:hover {
  border-color: #aaa;
  transform: translateY(-3px);
}

/* référence */
#liste > div > p:first-child {
  font-size: 11px;
  font-weight: 600;
  color: #999;
  margin: 0;
}

/* quantité */
#liste > div > p:last-child {
  font-size: 16px;
  font-weight: 600;
  color: #111;
  margin: 6px 0 0 0;
}   
</style>
<?php }?>