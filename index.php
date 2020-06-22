<?php include('header.php'); include('menus.php'); ?>

<?php include('statistiques/GetStats.php'); ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">



<?php if(CheckSecurity('stats')) { ?>

        <!-- Vue d'ensemble financier -->
        <div class="row">
          <div class="col-xl-6 col-12">
            <div class="card" style="height: 52vh;">
              <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body pt-0">
                  <div class="row mb-1">
                    <div class="col-6 col-md-4">
                      <h5>Année en cours</h5>
                      <h2 class="danger"><?php echo FormatEuro($CA_HT_AN_EN_COURS); ?></h2>
                    </div>
                    <div class="col-6 col-md-4">
                      <h5>Année précédente</h5>
                      <h2 class="text-muted"><?php echo FormatEuro($CA_HT_AN_DERNIERE); ?></h2>
                    </div>
                  </div>
                  <div class="chartjs">
                    <canvas id="thisYearRevenue" width="400" style="position: absolute;"></canvas>
                    <canvas id="lastYearRevenue" width="400" style="padding-bottom: 23px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-12">
            <div class="row">
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-header bg-hexagons">
                    <h4 class="card-title">Marge</h4>
                    <input type="hidden" id="marge_pourcentage" value="<?php echo number_format($MARGE_POURCENTAGE, 0); ?>">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content collapse show bg-hexagons">
                    <div class="card-body pt-0">
                      <div class="chartjs">
                        <canvas id="hit-rate-doughnut" height="275"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content collapse show bg-gradient-directional-danger ">
                    <div class="card-body bg-hexagons-danger">
                      <h4 class="card-title white">Taux de conversion
                        <span class="float-right">
                          <span class="white"><?= $CONVERSION_DEVIS_VALIDEES; ?></span>
                          <span class="red lighten-4">/<?= $CONVERSION_DEVIS_ENATTENTE; ?></span>
                          <input type="hidden" id="CONVERSION_DEVIS_VALIDEES" value="<?= $CONVERSION_DEVIS_VALIDEES; ?>">
                          <input type="hidden" id="CONVERSION_DEVIS_ENATTENTE" value="<?= $CONVERSION_DEVIS_ENATTENTE; ?>">
                          <input type="hidden" id="CONVERSION_POURCENTAGE" value="<?= $CONVERSION_POURCENTAGE; ?>">
                        </span>
                      </h4>
                      <div class="chartjs">
                        <canvas id="deals-doughnut" height="275"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <h6 class="text-muted">Marge (<?php echo date("Y"); ?>)</h6>
                          <h3><?php echo FormatEuro($MARGE_THIS_YEAR); ?></h3>
                        </div>
                        <div class="align-self-center">
                          <i class="icon-pie-chart success font-large-2 float-right"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <h6 class="text-muted">Clients</h6>
                          <h3><?php echo number_format($CLIENTS_COUNT, 0, "", ","); ?></h3>
                        </div>
                        <div class="align-self-center">
                          <i class="icon-user danger font-large-2 float-right"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Vue d'ensemble financier -->

        <!-- CA + Top clients  -->
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="card">
              <div class="card-content">
                <div class="earning-chart position-relative">
                  <div class="chart-title position-absolute mt-2 ml-2">
                    <h1 class="display-4"><?php echo FormatEuro($CA_HT_DEPUIS_DEBUT); ?></h1>
                    <span class="text-muted">CA Total</span>
                  </div>
                  <canvas id="earning-chart" class="height-450"></canvas>
                  <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3">
                    <a href="#/" class="btn round btn-danger mr-1 btn-glow">Statistiques <i class="ft-bar-chart"></i></a>
                    <span class="text-muted">pour <a href="#/" class="danger darken-2">depuis le début.</a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="recent-sales" class="col-12 col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Top clients</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"
                      href="/clients/liste-clients.php" target="_blank">Voir tous les clients</a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content mt-1">
                <div class="table-responsive">
                  <table id="recent-orders" class="table table-hover table-xl mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">Client</th>
                        <th class="border-top-0">Anciennetée</th>
                        <th class="border-top-0">Factures en cours</th>
                        <th class="border-top-0">CA Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php include("statistiques/liste_top_clients.php"); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ CA + top clients  -->



<?php } ?>






<?php if(CheckSecurity('home_factures_en_attente')) { ?>
        <!-- Recap factures en attente -->
        <div class="content-body">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">Factures en attente</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                    <div class="alert alert-info" role="alert" style="margin-top: 15px; margin-bottom: -15px;">
                      TOTAL FACTURES EN ATTENTE: <b><?php echo FormatEuro($FACTURES_EN_ATTENTE_TOTAL); ?></b>
                    </div>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
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
                        <?php include('factures/libs/liste-factures-enattente_table_content.php'); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!--/ Recap factures en attente -->
<?php } ?>


      </div>
    </div>
  </div>


<?php include('footer.php'); ?>
