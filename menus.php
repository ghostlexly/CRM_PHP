  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
            <a href="/index.php">
                <i class="la la-area-chart"></i><span class="menu-title">Statistiques</span>
            </a>
        </li>




        <?php if(CheckSecurity('factures')) { ?>
        <li class="nav-item">
            <a href="#">
                <i class="la la-euro"></i><span class="menu-title" >Factures</span>
            </a>
          <ul class="menu-content">
            <li>
                <a class="menu-item" href="/factures/liste-factures-enattente.php">En attente</a>
            </li>
            <li>
                <a class="menu-item" href="/factures/liste-factures-reglees.php">Réglées</a>
            </li>
            <li>
                <a class="menu-item" href="/factures/liste-factures-suspendu.php">Suspendues</a>
            </li>
          </ul>
        </li>
        <?php } ?>




        <?php if(CheckSecurity('avoirs')) { ?>
        <li class="nav-item">
            <a href="/avoirs/liste-avoirs.php">
                <i class="la la-server"></i><span class="menu-title">Avoirs</span>
            </a>
        </li>
        <?php } ?>



        <?php if(CheckSecurity('devis')) { ?>
        <li class="nav-item">
          <a href="#">
              <i class="la la-clipboard"></i><span class="menu-title" >Devis</span>
          </a>
          <ul class="menu-content">
            <li>
                <a class="menu-item" href="/devis/liste-devis-enattente.php">En attente</a>
            </li>
            <li>
                <a class="menu-item" href="/devis/liste-devis-regles.php">Validés</a>
            </li>
            <li>
                <a class="menu-item" href="/devis/liste-devis-refuses.php">Refusés</a>
            </li>
          </ul>
        </li>
        <?php } ?>



        <?php if(CheckSecurity('hebergements')) { ?>
        <li class="nav-item">
            <a href="/hebergements/liste-hebergements.php">
                <i class="la la-server"></i><span class="menu-title">Hébergements</span>
            </a>
        </li>
        <?php } ?>


        <?php if(CheckSecurity('clients')) { ?>
        <li class="nav-item">
            <a href="/clients/liste-clients.php">
                <i class="la la-user"></i><span class="menu-title">Clients</span>
            </a>
        </li>
        <?php } ?>


        <?php if(CheckSecurity('gestion_des_marges')) { ?>
         <li class="nav-item">
            <a href="/marges/marges-edit.php">
                <i class="la la-line-chart"></i><span class="menu-title">Gestion des marges</span>
            </a>
         </li>
        <?php } ?>




        <?php if(CheckSecurity('tableau_passwords')) { ?>
         <li class="nav-item">
            <a href="/tableau_passwords/">
                <i class="la la-server"></i><span class="menu-title">Tableau des mots de passe</span>
            </a>
         </li>
        <?php } ?>


      </ul>
    </div>
  </div>
