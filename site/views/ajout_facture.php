<form action="admin.php?action_facture=1" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <img id="image_visu" name="img" src=""/>
        <input type="file" id="imgInp" name="facture"/>
    </div>
    <button type="submit" class="btn btn-dark">Envoi</button>
</form>

<script>
	//preview img changé
	imgInp.onchange = evt => {
		const [file] = imgInp.files
		if (file) {
			image_visu.src = URL.createObjectURL(file)
		}
	}
</script>