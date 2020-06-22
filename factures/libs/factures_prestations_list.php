<?php
function GetListPrestations_POST($_P) {

	foreach ($_P as $presta) {
			?>
			 <div data-repeater-item class="Prestation_Ligne">
                <div class="row mb-1">
                  <div class="col-5 col-xl-5">
                    <input type="text" class="form-control" placeholder="Désignation de la prestation" name="designation_prestation" id="designation_prestation" value="<?php echo $presta['designation_prestation']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Quantité" name="quantite" id="quantite" value="<?php echo $presta['quantite']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Prix unitaire (0.00)" name="prix_unitaire" id="prix_unitaire" value="<?php echo $presta['prix_unitaire']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Montant HT" name="montant" id="montant" disabled required>
                  </div>
                  <div class="col-2 col-xl-1">
                    <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                  </div>
                </div>
             </div>
			<?php
		}

}





function GetListPrestations_ArrayDB($_P) {

  foreach ($_P as $presta) {
      ?>
       <div data-repeater-item class="Prestation_Ligne">
                <div class="row mb-1">
                  <div class="col-5 col-xl-5">
                    <input type="text" class="form-control" placeholder="Désignation de la prestation" name="designation_prestation" id="designation_prestation" value="<?php echo $presta['designation']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Quantité" name="quantite" id="quantite" value="<?php echo $presta['quantite']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Prix unitaire (0.00)" name="prix_unitaire" id="prix_unitaire" value="<?php echo $presta['montant_ht']; ?>" required>
                  </div>
                  <div class="col-2 col-xl-2">
                    <input type="text" class="form-control" placeholder="Montant HT" name="montant" id="montant" disabled required>
                  </div>
                  <div class="col-2 col-xl-1">
                    <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                  </div>
                </div>
             </div>
      <?php
    }

}
?>