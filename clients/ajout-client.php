<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('clients')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Ajouter un client</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Clients</a>
                </li>
                <li class="breadcrumb-item active">Ajouter
                </li>
              </ol>
            </div>
          </div>
        </div>

      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="ajout-client.php">
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-eye"></i> Informations</h4>
                        <div class="col-md-12">
                          <?php include('libs/ajout-client_system.php'); ?>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Société <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Nom de la société" name="nom_societe" value="<?php echo C_Input_Frm_Post('nom_societe'); ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput2">Interlocuteur <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Nom de l'interlocuteur" name="nom_interlocuteur" value="<?php echo C_Input_Frm_Post('nom_interlocuteur'); ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput3">Adresse de facturation <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Ex : 21 Boulevard de Tunis - 13008 Marseille" name="adresse_facturation" value="<?php echo C_Input_Frm_Post('adresse_facturation'); ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput4">Adresse e-mail <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="email" class="form-control " placeholder="Adresse e-mail" name="adresse_email" value="<?php echo C_Input_Frm_Post('adresse_email'); ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput5">Siret</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Siret" name="numero_siret" value="<?php echo C_Input_Frm_Post('numero_siret'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput6">Tél. fixe</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Tél. fixe" name="tel_fixe" value="<?php echo C_Input_Frm_Post('tel_fixe'); ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput7">TVA intracommunautaire</label>
                              <div class="col-md-9">
                                <input type="tel" class="form-control " placeholder="TVA" name="numero_tva" value="<?php echo C_Input_Frm_Post('numero_tva'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput8">Tél. portable</label>
                              <div class="col-md-9">
                                <input type="tel" class="form-control " placeholder="Tél. portable" name="tel_portable" value="<?php echo C_Input_Frm_Post('tel_portable'); ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput9">Echéance de paiement</label>
                              <div class="col-md-9">
                                <select class="form-control" name="echeance_paiement">
                                  <option value="À réception">À réception</option>
                                  <option value="À 30 jours">À 30 jours</option>
                                  <option value="À 60 jours">À 60 jours</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput10">Date d'ajout</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="date_ajout" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput11">Informations complémentaires</label>
                              <div class="col-md-9">
                                <textarea class="form-control" rows="3" placeholder="Informations complémentaires" name="infos_complementaires"></textarea>
                              </div>
                            </div>
                          </div>
                      	</div>


            <hr>


            		<h4 class="form-section"><i class="la la-eye"></i> Hébergement</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL hôte</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="123.456.789.101" name="mysql_hote" value="<?php echo C_Input_Frm_Post('mysql_hote'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP hôte</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="123.456.789.101" name="ftp_hote" value="<?php echo C_Input_Frm_Post('ftp_hote'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>


                      	<div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL port</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="3306" name="mysql_port" value="<?php echo C_Input_Frm_Post('mysql_port'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP port</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="21" name="ftp_port" value="<?php echo C_Input_Frm_Post('ftp_port'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>


                      	<div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="DubSeven" name="mysql_user" value="<?php echo C_Input_Frm_Post('mysql_user'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="DubSeven" name="ftp_user" value="<?php echo C_Input_Frm_Post('ftp_user'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>



                      	<div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="mysql_passw" value="<?php echo C_Input_Frm_Post('mysql_passw'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="ftp_passw" value="<?php echo C_Input_Frm_Post('ftp_passw'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>




                      	<div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL database</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="prestashop_wats" name="mysql_db" value="<?php echo C_Input_Frm_Post('mysql_db'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>



                      	<div class="row">
                      	  <div class="col-md-11">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice URL</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control " placeholder="http://prestashop.com/admin2304519/index.php" name="bo_url" value="<?php echo C_Input_Frm_Post('bo_url'); ?>">
                              </div>
                            </div>
                          </div>
                      	</div>




                      	<div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="dubseven" name="bo_user" value="<?php echo C_Input_Frm_Post('bo_user'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="bo_passw" value="<?php echo C_Input_Frm_Post('bo_passw'); ?>">
                              </div>
                            </div>
                          </div>
                        </div>





<hr>



                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Nom de l'hébergeur</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Dynamix" name="nom_heberg" value="<?php echo C_Input_Frm_Post('nom_heberg'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Date renouvellement</label>
                              <div class="col-md-9">
                                <input type="date" class="form-control " placeholder="00/00/0000" name="date_renouv_heberg" value="<?php echo C_Input_Frm_Post('date_renouv_heberg'); ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Prix hébergeur</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="-- €" name="prix_heberg" value="<?php echo C_Input_Frm_Post('prix_heberg'); ?>">
                              </div>
                            </div>
                          </div>
                    </div>






                      <div class="form-actions right"><a href="liste-clients.php">
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
        <!-- // Basic form layout section end -->
      </div>
    </div>
  </div>

<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
