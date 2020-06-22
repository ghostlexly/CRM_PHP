<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('clients')) { exit("Vous n'avez pas accès à cette page."); } ?>


  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Contacts</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item">Clients</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
              <a class="dropdown-item" href="libs/extraction_identifiants.php"><i class="la la-cog"></i> Extraire les identifiants de connexion</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
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
                    <h4 class="card-title">Tous les clients</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements"><a href="ajout-client.php">
                      <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i> Ajouter</button>
                    </a></div>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <!-- Task List table -->
                    <div class="table-responsive">
                      <table id="users-contacts" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                        <thead>
                          <tr>
                            <th class="sorting_asc" tabindex="0" aria-controls="invoices-list" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 32px;">
                               <input type="checkbox" class="input-chk">
                          </th>
                            <th>Société</th>
                            <th>Interlocuteur</th>
                            <th>E-mail</th>
                            <th>Tél. fixe</th>
                            <th>Tél. portable</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>

<?php include('libs/liste-clients-table_content.php'); ?>


                        </tbody>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>Société</th>
                            <th>Interlocuteur</th>
                            <th>E-mail</th>
                            <th>Tél. fixe</th>
                            <th>Tél. portable</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
                      </table>
<center><?php include("$_SERVER[DOCUMENT_ROOT]/pagination.php"); ?></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
