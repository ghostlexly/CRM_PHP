<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('gestion_des_marges')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Gestion des marges</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item active">Gestion des marges
                </li>
              </ol>
            </div>
          </div>
        </div>

      <div class="content-body">
        <section id="form-control-repeater">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form class="form row" method="POST" action="marges-edit.php">
                      <div class="col-md-12">
                        <?php include('libs/marges-edit_save.php'); include('GetMarges.php'); ?>
                      </div>
                      <div class="col-md-12">
                        <h4 class="form-section"><i class="la la-building"></i> Frais internes de la société</h4>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Frais internes en %</label>
                          <div class="col-md-9">
                            <input type="number" class="form-control" placeholder="-- %" name="taux_interne" value="<?php echo $FraisInternes; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <h4 class="form-section"><i class="la la-group"></i> Gestion de l'équipe</h4>
                        <p>Saisissez les taux horaires de chaque membre afin que les marges soient calculées en fonction des intervenants.</p>
                      </div>

                      <div class="form-group col-12 mb-2 file-repeater detail_facture">
                        <div data-repeater-list="repeater-list-intervenants">
                          <?php if(sizeof($List_Intervenants) > 0) { include('libs/marges-edit_all_team_db.php'); } else { ?>
                          <div data-repeater-item>
                            <div class="row mb-1">
                              <div class="col-5 col-xl-5">
                                <input type="text" class="form-control" placeholder="Membre de l'équipe" name="membre_equipe" required>
                              </div>
                              <div class="col-2 col-xl-2">
                                <input type="text" class="form-control" placeholder="Taux horaire" name="taux_horaire" required>
                              </div>
                            </div>
                          </div>
                         <?php } ?>
                        </div>
                        <button type="button" data-repeater-create class="btn btn-primary">
                          <i class="ft-plus"></i> Ajouter
                        </button>
                      </div>

                      <div class="col-md-12">
                        <div class="form-actions right"><a href="/index.php">
                          <button type="button" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> Annuler
                          </button></a>
                          <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Enregistrer
                          </button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>
    </div>
  </div>
</div>


<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

<script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
