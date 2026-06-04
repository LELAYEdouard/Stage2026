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

    <div class="form-line product-block">

        

        <label>Référence</label>
        <input type="text"
               name="ref[<?= $i ?>]"
               value="<?= $ref ?>">

        <label>Nom</label>
        <input type="text"
               name="nom[<?= $i ?>]"
               >

        <label>Prix</label>
        <input type="number"
               step="0.01"
               name="prix[<?= $i ?>]"
               >

        <label>Quantité</label>
        <input type="number"
               name="qte[<?= $i ?>]"
               value="<?=$qte ?>">

        <label>Catégorie</label>
        <select name="cat[<?= $i ?>]">
            <?php foreach ($all_cat as $cat) { ?>
                <option value="<?= $cat["id"] ?>">
                    <?= htmlentities($cat["nom_categorie"]) ?>
                </option>
            <?php } ?>
        </select>

    </div>

<?php $i++; } ?>

    <button type="submit" class="btn-submit">
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