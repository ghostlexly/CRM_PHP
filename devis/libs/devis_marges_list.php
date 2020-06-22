<?php
function GetListMarges_POST($_P) {
  global $pdo;
  global $List_Intervenants;


	foreach ($_P as $inter) {
			?>
			 <div data-repeater-item>
          <div class="row mb-1">
            <div class="col-5 col-xl-5">
              <select class="custom-select" id="choix_intervenant-<?php echo $inter['choix_intervenant']; ?>" name="choix_intervenant" required>
                 <?php include("$_SERVER[DOCUMENT_ROOT]/marges/Intervenants_Selectlist.php"); ?>
              </select>
            </div>
            <div class="col-2 col-xl-2">
              <input type="text" class="form-control" placeholder="Temps passé" name="temps_passe" value="<?php echo $inter['temps_passe']; ?>">
            </div>
            <div class="col-2 col-xl-1">
              <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
            </div>
          </div>
        </div>

         <script>$(function() { $("#choix_intervenant-<?php echo $inter['choix_intervenant']; ?>").val('<?php echo $inter['choix_intervenant']; ?>'); });</script>
			<?php
		}

}









function GetListMarges_DB($_P) {
  global $pdo;
  global $List_Intervenants;


  foreach ($_P as $inter) {
      ?>
       <div data-repeater-item>
          <div class="row mb-1">
            <div class="col-5 col-xl-5">
              <select class="custom-select" id="choix_intervenant-<?php echo $inter['id_intervenant']; ?>" name="choix_intervenant" required>
                 <?php include("$_SERVER[DOCUMENT_ROOT]/marges/Intervenants_Selectlist.php"); ?>
              </select>
            </div>
            <div class="col-2 col-xl-2">
              <input type="text" class="form-control" placeholder="Temps passé" name="temps_passe" value="<?php echo $inter['heures']; ?>">
            </div>
            <div class="col-2 col-xl-1">
              <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
            </div>
          </div>
        </div>

         <script>$(function() { $("#choix_intervenant-<?php echo $inter['id_intervenant']; ?>").val('<?php echo $inter['id_intervenant']; ?>'); });</script>
      <?php
    }

}
?>