<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php include('libs/details-client_getinfos.php'); ?>
<?php if(!CheckSecurity('clients')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block"><?php echo strtoupper($ClientInfos['nom_societe']); ?></h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item"><a href="liste-clients.php">Clients</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $ClientInfos['nom_societe']; ?>
                </li>
              </ol>
            </div>
          </div>
        </div>

      </div>




      <div class="content-body">
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="details-client.php?id=<?php echo $_GET['id']; ?>">
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-eye"></i> Informations</h4>
                        <div class="col-md-12"><?php include('libs/details-client_confirmedit.php'); ?></div> <?php include('libs/details-client_getinfos.php'); // Actualiser infos ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Société <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Nom de la société" name="nom_societe" value="<?php echo $ClientInfos['nom_societe']; ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput2">Interlocuteur <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Nom de l'interlocuteur" name="nom_interlocuteur" value="<?php echo $ClientInfos['nom_interlocuteur']; ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput3">Adresse de facturation <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Adresse de facturation" name="adresse_facturation" value="<?php echo $ClientInfos['adresse_facturation']; ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput4">Adresse e-mail <span class="required">*</span></label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Adresse e-mail" name="adresse_email" value="<?php echo $ClientInfos['email']; ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput5">Siret</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Siret" name="numero_siret" value="<?php echo $ClientInfos['siret']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput6">Tel. fixe</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Tel. fixe" name="tel_fixe" value="<?php echo $ClientInfos['numero_fixe']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput7">TVA intracommunautaire</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="TVA" name="numero_tva" value="<?php echo $ClientInfos['tva']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput6">Tel. portable</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="Tel. portable" name="tel_portable" value="<?php echo $ClientInfos['numero_portable']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput6">Date d'ajout</label>
                              <div class="col-md-9">
                                <input type="date" class="form-control " placeholder="Date d'ajout" name="date_ajout" value="<?php echo $ClientInfos['date_ajout']; ?>">
                              </div>
                            </div>
                          </div>
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
                            <script>$(function() { $("[name='echeance_paiement']").val('<?php echo $ClientInfos['echeance_paiement']; ?>'); });</script>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput7">Informations complémentaires</label>
                              <div class="col-md-9">
                                <textarea class="form-control" rows="3" placeholder="Informations complémentaires" name="infos_complementaires"><?php echo $ClientInfos['infos_compl']; ?></textarea>
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
                                <input type="text" class="form-control " placeholder="123.456.789.101" name="mysql_hote" value="<?php echo $Hebergs['mysql_host']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP hôte</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="123.456.789.101" name="ftp_hote" value="<?php echo $Hebergs['ftp_host']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL port</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="3306" name="mysql_port" value="<?php echo $Hebergs['mysql_port']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP port</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="21" name="ftp_port" value="<?php echo $Hebergs['ftp_port']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="DubSeven" name="mysql_user" value="<?php echo $Hebergs['mysql_user']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="DubSeven" name="ftp_user" value="<?php echo $Hebergs['ftp_user']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="mysql_passw" value="<?php echo $Hebergs['mysql_passw']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">FTP password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="ftp_passw" value="<?php echo $Hebergs['ftp_passw']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">MySQL database</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="prestashop_wats" name="mysql_db" value="<?php echo $Hebergs['mysql_db']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-md-11">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice URL</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control " placeholder="http://prestashop.com/admin2304519/index.php" name="bo_url" value="<?php echo $Hebergs['url_backoffice']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>




                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice user</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="dubseven" name="bo_user" value="<?php echo $Hebergs['user_backoffice']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Backoffice password</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="test123456" name="bo_passw" value="<?php echo $Hebergs['passw_backoffice']; ?>">
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
                                <input type="text" class="form-control " placeholder="Dynamix" name="nom_heberg" value="<?php echo $Hebergs['nom_heberg']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Date renouvellement</label>
                              <div class="col-md-9">
                                <input type="date" class="form-control " placeholder="00/00/0000" name="date_renouv_heberg" value="<?php echo $Hebergs['date_renouv_heberg']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput1">Prix hébergeur</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control " placeholder="-- €" name="prix_heberg" value="<?php echo $Hebergs['prix_heberg']; ?>">
                              </div>
                            </div>
                          </div>
                    </div>





                      </div>
                      <div class="form-actions right">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-pencil"></i> Modifier
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- Listes client -->
      <div class="content-body">
          <section class="row">
            <!-- factures -->
            <div class="col-6">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">Factures</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="invoices-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                        <thead>
                          <tr>
                            <th>Désignation</th>
                            <th>Numéro</th>
                            <th>Statut</th>
                            <th>Montant</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php include('libs/details-client_tablefactures.php'); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Liste devis -->
            <div class="col-6">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">Devis</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="invoices-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                        <thead>
                          <tr>
                            <th>Designation</th>
                            <th>Devis</th>
                            <th>Statut</th>
                            <th>Montant</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php include('libs/details-client_tabledevis.php'); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </section>
        </div>
        <!-- Fin tableaux client -->
    </div>
  </div>

<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
