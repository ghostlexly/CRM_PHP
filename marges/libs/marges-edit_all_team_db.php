<?php

foreach ($List_Intervenants as $inter) {
      ?>
       <div data-repeater-item>
        <div class="row mb-1">
            <input type="hidden" name="exist_id" value="<?php echo $inter['id']; ?>">
          <div class="col-5 col-xl-5">
            <input type="text" class="form-control" placeholder="Membre de l'équipe" name="membre_equipe" value="<?php echo $inter['nom']; ?>" required>
          </div>
          <div class="col-2 col-xl-2">
            <input type="text" class="form-control" placeholder="Taux horaire" name="taux_horaire" value="<?php echo $inter['taux_horaire']; ?>" required>
          </div>
        </div>
      </div>
      <?php
    }

?>