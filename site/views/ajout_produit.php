<div class="d-flex felx-column m-5 justify-content-center">
	<form method="post" action="admin.php?action_prod=1" enctype="multipart/form-data" onsubmit="return valider_ajout();">
		<input type="hidden" name="action" value="ajout">
		<div class="form-group">
			<label for="reference">Réference produit</label>
			<input type="text" class="form-control" name="reference">
		</div>
		<div class="form-group">
			<label for="nom">Nom Produit</label>
			<input type="text" class="form-control" name="nom">
		</div>
		<div class="form-group">
			<label for="prix">Prix</label>
			<input type="number" step=0.01 min=0 class="form-control" name="prix">
		</div>
		<div class="form-group">
			<img id="image_visu" name="img" src=""/>
			<input type="file" id="imgInp" name="image"/>
		</div>
		<div class="form-group">
			<select name="cat">
				<?php foreach($all_cat as $cle => $val){ ?>
				<option value="<?= htmlentities($val["id"])?>" name="<?= htmlentities($val["nom_categorie"])?>"><?= htmlentities($val["nom_categorie"])?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="qte">Quantité</label>
			<input type="number" min="0" class="form-control" name="qte">
		</div>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id=local name="local">
			<label class="form-check-label" for="local">Produit local</label>
		</div>
		<button type="submit" class="btn btn-dark">Creer</button>
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