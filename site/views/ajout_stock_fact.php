<?php

$lst = (explode("],[",substr($_POST['prod'],2,-2)));

?>

<div class="d-flex felx-column m-5 justify-content-center">
	<form method="post"
      action="admin.php?action_facture=1"
      class="form-prod">
    <input type="hidden" name="action" value="ajout_manque">
    
<?php 
$i = 1;
foreach ($lst as $prod) {
    $prod = explode(",",$prod); 
    $ref = substr($prod[0],1,-1);
    $qte = substr($prod[1],1,-1);
    ?>

    <div class="ajout-ligne">

    <input type="text"
           name="ref[<?= $i ?>]"
           value="<?= htmlentities($ref) ?>"
           placeholder="Référence">

    <input type="text"
           name="nom[<?= $i ?>]"
           placeholder="Nom">

    <input type="number"
           step="0.01"
           min="0"
           name="prix[<?= $i ?>]"
           placeholder="Prix">

    <input type="number"
           min="0"
           name="qte[<?= $i ?>]"
           value="<?= htmlentities($qte) ?>"
           placeholder="Qté">

    <select name="cat[<?= $i ?>]">
        <?php foreach ($all_cat as $cat) { ?>
            <option value="<?= $cat["id"] ?>">
                <?= htmlentities($cat["nom_categorie"]) ?>
            </option>
        <?php } ?>
    </select>

</div>

<?php $i++; } ?>

    <button type="submit" class="btn-submit btn btn-dark">
        Enregistrer tous les produits
    </button>

</form>
</div>
<div class="alert alert-primary hidden" role="alert">
	Erreur de saisie ! 
</div>
<script>
	//preview img changé
	imgInp.onchange = evt => {
		const [file] = imgInp.files
		if (file) {
			image_visu.src = URL.createObjectURL(file)
		}
	}
</script>
<style>
.ajout-ligne {
    display: grid;
    grid-template-columns: 120px 1fr 100px 100px 180px;
    gap: 12px;
    align-items: center;

    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 10px;
}

.ajout-ligne input,
.ajout-ligne select {
    width: 100%;
    height: 36px;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 0 10px;
}

.form-prod {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-submit {
    align-self: center;
    margin-top: 15px;
}
</style>