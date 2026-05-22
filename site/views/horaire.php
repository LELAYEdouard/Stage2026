<div class="d-flex felx-column m-5 justify-content-center">
	<form method="post" action="admin.php?action_horaire=1">

        <div class="d-flex flex-row">

            <?php 
            $horaire = unserialize(get_horaire());
            foreach($horaire as $val){ 
            $cle = array_keys($val);
            ?>
            <div>
                <div class="form-group">
                    <label>Jour</label>
                    <input type="text" class="form-control" name="<?=$cle[0]?>" value="<?=$val[$cle[0]]?>">
                </div>
                <div class="form-group">
                    <label>Horaire</label>
                    <input type="text" class="form-control" name="<?=$cle[1]?>" value="<?=$val[$cle[1]]?>">
                </div>
            </div>
                <?php } ?>
        </div>
		<button type="submit" class="btn btn-dark">Valider</button>
	</form>
</div>