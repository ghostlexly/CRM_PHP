<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('hebergements')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Hébergements</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item active">Hébergements
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-head">
                <div class="card-header">
                  Liste des hébergements liés aux clients. <br>
      					Une notification est envoyée par mail et sur le CRM quand celui-ci arrive à expiration. N'oubliez pas de cliquer sur le bouton 'renouvelé' pour relancer le compteur.
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- Invoices List table -->
                  <div class="table-responsive">
                    <table id="invoices-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                      <thead>
                        <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="invoices-list" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 32px;">
                              <input type="checkbox" class="input-chk">
                          </th>
                          <th>Client</th>
                          <th>Hébergeur</th>
                          <th>Date renouvellement</th>
                          <th>Durée restante</th>
                          <th>Prix</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

<?php include('libs/liste-hebergements_table_content.php'); ?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="invoices-list" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 32px;">
                              <input type="checkbox" class="input-chk">
                          </th>
                          <th>Client</th>
                          <th>Hébergeur</th>
                          <th>Date renouvellement</th>
                          <th>Durée restante</th>
                          <th>Prix</th>
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                    </table>
<center><?php include("$_SERVER[DOCUMENT_ROOT]/pagination.php"); ?></center>
                  </div>
                  <!--/ Invoices table -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
