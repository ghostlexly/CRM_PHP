<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); include("$_SERVER[DOCUMENT_ROOT]/marges/GetMarges.php"); ?>
<?php if(!CheckSecurity('devis')) { exit("Vous n'avez pas accès à cette page."); } ?>

<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/switchery.min.css">

<?php include('libs/ajout-devis_getinfos.php'); ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Ajouter un devis</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item"><a href="liste-devis-enattente.php">Devis</a>
                </li>
                <li class="breadcrumb-item active">Ajouter
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
                    <form class="form row" method="POST" action="ajout-devis.php?idclient=<?php if(isset($_GET['idclient'])) { echo $_GET['idclient']; } else { echo "0"; } ?>">
                      <div class="col-md-12">
                        <h4 class="form-section"><i class="la la-eye"></i> Informations du client</h4>
                      </div>

<div class="col-md-12"><?php include('libs/ajout-devis_system.php'); ?></div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Client</label>
                          <div class="col-md-9">
                            <select class="custom-select" id="customSelect" name="choix_client" required>
                              <option selected="">Choisissez un client</option>
                              <?php include('libs/ajout-devis_listeclients.php'); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php if(isset($_GET['idclient'])) { ?><script>$(function() { $("[name='choix_client']").val('<?php echo $_GET['idclient']; ?>'); });</script><?php } ?>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Numéro client</label>
                          <div class="col-md-9">
                            <input type="number" class="form-control" placeholder="Numéro client" name="adresse_facturation" value="<?php echo GetVarClient('id'); ?>" disabled required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">E-mail</label>
                          <div class="col-md-9">
                            <input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php echo GetVarClient('email'); ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Adresse de facturation</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Ex : 21 Boulevard de Tunis - 13008 Marseille" name="adresse_facturation" value="<?php echo GetVarClient('adresse_facturation'); ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Tél. Fixe</label>
                          <div class="col-md-9">
                            <input type="tel" class="form-control" placeholder="Tél. Fixe" name="tel_fixe" value="<?php echo GetVarClient('numero_fixe'); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Tél. Portable</label>
                          <div class="col-md-9">
                            <input type="tel" class="form-control" placeholder="Tél. Portable" name="tel_portable" value="<?php echo GetVarClient('numero_portable'); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Echéance de paiement</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Echéance" name="echeance_paiement" value="<?php echo GetVarClient('echeance_paiement'); ?>" disabled required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <h4 class="form-section"><i class="la la-clipboard"></i> Détails du devis</h4>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Désignation du devis</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Désignation" name="designation_devis" value="<?php echo C_Input_Frm_Post('designation_devis'); ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Date du devis</label>
                          <div class="col-md-9">
                            <input type="date" class="form-control" placeholder="Date" name="date_ajout" value="<?php if(C_Input_Frm_Post('date_ajout') !== null) { echo C_Input_Frm_Post('date_ajout'); } else { echo date('Y-m-d'); } ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Numéro du devis</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="FA-AAMM-0001" name="numero_facturation" value="<?php if(C_Input_Frm_Post('numero_facturation') !== null) { echo C_Input_Frm_Post('numero_facturation'); } else { echo Gen_Devis_Numero(); } ?>" required>
                          </div>
                        </div>
                      </div>








                      <div class="form-group col-12 mb-2 file-repeater detail_facture">
                        <div data-repeater-list="repeater-list-prestations">
                          <?php if(isset($_POST['repeater-list-prestations'])) { include('libs/devis_prestations_list.php'); GetListPrestations_POST($_POST['repeater-list-prestations']); } else { ?>
                          <div data-repeater-item class="Prestation_Ligne">
                            <div class="row mb-1">
                              <div class="col-5 col-xl-5">
                                <input type="text" class="form-control" placeholder="Désignation de la prestation" name="designation_prestation" id="designation_prestation" required>
                              </div>
                              <div class="col-2 col-xl-2">
                                <input type="text" class="form-control" placeholder="Quantité" name="quantite" id="quantite" required>
                              </div>
                              <div class="col-2 col-xl-2">
                                <input type="text" class="form-control" placeholder="Prix unitaire (0.00)" name="prix_unitaire" id="prix_unitaire" required>
                              </div>
                              <div class="col-2 col-xl-2">
                                <input type="text" class="form-control" placeholder="Montant HT" name="montant" id="montant" disabled required>
                              </div>
                              <div class="col-2 col-xl-1">
                                <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-x"></i></button>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        </div>
                        <button type="button" data-repeater-create class="btn btn-primary" OnClick="Calculs_HT_Prestations();">
                          <i class="ft-plus"></i> Ajouter
                        </button>
                      </div>







 					<div class="col-md-12">
                      <h4 class="form-section"><i class="la la-euro"></i> Total du devis</h4>
                    </div>


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Montant total HT</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="-- €" name="montant_total_ht" disabled required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">TVA applicable</label>
                          <div class="col-md-9">
                                <div class="col-sm-4 col-2 text-center">
                                  <input type="checkbox" name="tva_applicable" id="switcheryColor1" class="switchery" data-color="danger" checked/>
                                </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 label-control">Montant total TTC</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="-- €" name="montant_total_ttc" disabled required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-actions right"><a href="liste-devis-enattente.php">
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
        <!-- // Form control repeater section end -->
      </div>
    </div>
  </div>
</div>


<script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

<script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>

<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
