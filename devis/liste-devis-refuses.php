<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('devis')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Devis refusés</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item active">Devis refusés
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
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
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <a href="ajout-devis.php"><button class="btn btn-primary btn-sm"><i class="ft-plus white"></i> Créer un devis</button></a>
                    <span class="dropdown">
                      <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i class="ft-download-cloud white"></i></button>
                      <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="la la-level-up"></i> Exporter</a>
                      </span>
                    </span>
                  </div>
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
                          <th>Désignation</th>
                          <th>Client</th>
                          <th>Date</th>
                          <th>Numéro</th>
                          <th>Jours</th>
                          <th>Montant HT</th>
                          <th>Montant TTC</th>
                          <th>Marge</th>
                          <th>Statut</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

<?php include('libs/liste-devis-refuses_table_content.php'); ?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="invoices-list" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 32px;">
                              <input type="checkbox" class="input-chk">
                          </th>
                          <th>Désignation</th>
                          <th>Client</th>
                          <th>Date</th>
                          <th>Numéro</th>
                          <th>Jours</th>
                          <th>Montant HT</th>
                          <th>Montant TTC</th>
                          <th>Marge</th>
                          <th>Statut</th>
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
