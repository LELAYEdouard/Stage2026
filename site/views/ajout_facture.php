<div class="d-flex flex-column align-items-center">
	
	<form action="admin.php?action_facture=1"
		  method="post"
		  enctype="multipart/form-data"
		  class="form-prod">
	
		<div class="form-line">
			<label>Importer une facture</label>
	
			<input type="file"
				   id="imgInp"
				   name="facture"
				   accept=".pdf,image/*">
	
		</div>
	
		<div class="form-line">
			<button type="submit" class="btn-submit">
				Envoyer
			</button>
		</div>
	
	</form>
	
	<div class="form-line">
		<a href="admin.php?resume=1&fetch=1"
		   class="btn-submit btn-secondary">
			Afficher dernière facture
		</a>
	</div>
</div>

<style>

	.form-prod {
  max-width: 500px;
  margin: 20px auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.form-line {
  display: flex;
  flex-direction: column;
  gap: 6px;
  width: 25em;
}

.form-line label {
  font-size: 13px;
  font-weight: 600;
  color: #555;
}

.form-line input[type="file"] {
  padding: 8px;
  border: 1px dashed #ccc;
  border-radius: 8px;
  background: #fafafa;
  cursor: pointer;
}

.form-line input[type="file"]:hover {
  border-color: #999;
}

.btn-submit {
  display: inline-block;
  text-align: center;
  padding: 10px 14px;
  background: #111;
  color: #fff;
  border-radius: 8px;
  text-decoration: none;
  border: none;
  cursor: pointer;
}

.btn-submit:hover {
  opacity: 0.85;
}

.btn-secondary {
  background: #444;
}
</style>