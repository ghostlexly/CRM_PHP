<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>




<?
if(isset($_GET['q'])) {


  $search_query = htmlspecialchars($_GET['q']);
  $search_regex = $search_query;
  $results_clients = array();
  $results_factures = array();

  //@ Transformer espaces en search query
  if(strpos($search_regex, ' ')) {
    $exploded_search = explode(" ", $search_regex);
    $search_regex = "";
    foreach($exploded_search as $this_q) {
      $search_regex .= "$this_q|";
    }
    $search_regex = substr($search_regex, 0, (strlen($search_regex) - 1));
  }


  if(empty($search_query)) { exit(); }

      // @ SEARCH DANS LES CLIENTS
        $OrderCases_client = 
          "nom_societe LIKE CONCAT(:search_query, '%') DESC, ifnull(nullif(instr(nom_societe, concat(' ', :search_query)), 0), 99999), ifnull(nullif(instr(nom_societe, :search_query), 0), 99999), nom_societe,
          nom_interlocuteur LIKE CONCAT(:search_query, '%') DESC, ifnull(nullif(instr(nom_interlocuteur, concat(' ', :search_query)), 0), 99999), ifnull(nullif(instr(nom_interlocuteur, :search_query), 0), 99999), nom_interlocuteur,
          email LIKE CONCAT(:search_query, '%') DESC, ifnull(nullif(instr(email, concat(' ', :search_query)), 0), 99999), ifnull(nullif(instr(email, :search_query), 0), 99999), email,
          siret LIKE CONCAT(:search_query, '%') DESC, ifnull(nullif(instr(siret, concat(' ', :search_query)), 0), 99999), ifnull(nullif(instr(siret, :search_query), 0), 99999), siret";
      // -> Send query
        $stmt = $pdo->prepare("SELECT * FROM Clients WHERE nom_societe REGEXP :search_regex
          OR nom_interlocuteur REGEXP :search_regex
          OR email REGEXP :search_regex
          OR siret REGEXP :search_regex
          ORDER BY $OrderCases_client");
        $stmt->bindValue('search_regex', $search_regex, PDO::PARAM_STR);
        $stmt->bindValue('search_query', "%$search_query%", PDO::PARAM_STR);
        $stmt->execute();
        $stmt = $stmt->fetchAll();


        foreach($stmt as $search_r) {
          $results_clients[] = $search_r;
        }



      // @ SEARCH DANS LES FACTURES
        $stmt = $pdo->prepare("SELECT f.*, c.nom_societe FROM Factures AS f
          INNER JOIN Clients AS c ON c.id = f.id_client
          WHERE f.numero_facture REGEXP :search_regex
          OR f.nom_designation REGEXP :search_regex");
        $stmt->bindValue('search_regex', $search_regex, PDO::PARAM_STR); // OU PDO::PARAM_INT
        $stmt->execute();
        $stmt = $stmt->fetchAll();


        foreach($stmt as $search_r) {
          $results_factures[] = $search_r;
        }
        
} else {
  $search_query = "Pas de recherche.";
  $results_clients = array();
  $results_factures = array();
}
?>







<div class="app-content content">
    <div class="content-wrapper">
		<div class="content-header row">
		    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
		      <h3 class="content-header-title mb-0 d-inline-block">Résultats de recherches: <?= $search_query; ?></h3>
		      <div class="row breadcrumbs-top d-inline-block">
		        <div class="breadcrumb-wrapper col-12">
		          <ol class="breadcrumb">
		            <li class="breadcrumb-item">
		            	<a href="/">Accueil</a>
		            </li>		            
		            <li class="breadcrumb-item active">Résultats</li>
		          </ol>
		        </div>
		      </div>
		    </div>
		</div>

		<div class="content-body">
        <!-- Search form-->
	        <section id="search-website" class="card overflow-hidden">
	        	<div class="card-header">
		            <h4 class="card-title">Il y a <?= (sizeof($results_clients) + sizeof($results_factures)); ?> résultat(s).</h4>
		            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
	        	</div>
	    	  </section>


	    	
          <? foreach($results_clients as $r_this_client) { ?>
            <a href="/clients/details-client.php?id=<?= $r_this_client['id']; ?>">
            	<div class="col-xl-6 col-md-12 pull-left">
              		<div class="card overflow-hidden">
                		<div class="card-content">
                  			<div class="media align-items-stretch">
                    			<div class="bg-info p-2 media-middle">
                      				<i class="icon-user font-large-2 text-white"></i>
                    			</div>

                          
                      			<div class="media-body p-2">
                        				<h4><?= $r_this_client['nom_societe']; ?></h4>
  	                      			<span><?= $r_this_client['nom_interlocuteur']; ?></span>
  	                    		</div>
  	                    		<div class="media-right p-2 media-middle">
  	                      			<h1 class="info"><?= date("d/m/Y", strtotime($r_this_client['date_ajout'])); ?></h1>
  	                    		</div>

                  			</div>
                		</div>
              		</div>
           		 </div>
              </a>
            <? } ?>

            <? foreach($results_factures as $r_this_facture) { ?>
              <a href="/pdf_gen/pdf_gen.php?ressource=facture&id_facture=<?= $r_this_facture['id']; ?>" target="_blank">
              	<div class="col-xl-6 col-md-12 pull-right">
                		<div class="card">
                 			<div class="card-content">
                    			<div class="media align-items-stretch">
                      			<div class="bg-warning p-2 media-middle rounded-left">
                        				<i class="icon-docs font-large-2 text-white"></i>
                      			</div>
                      			<div class="media-body p-2">
                        				<h4><?= $r_this_facture['numero_facture']; ?> - <?= $r_this_facture['nom_societe']; ?></h4>
                        				<span><?= date("d/m/Y", strtotime($r_this_facture['date_facture'])); ?> - <?= $r_this_facture['nom_designation']; ?></span>
                      			</div>
                      			<div class="media-right p-2 media-middle">
                        				<h1 class="warning"><?= FormatEuro($r_this_facture['total_ht']); ?> HT</h1>
                      			</div>
                    			</div>
                  		</div>
                		</div>
              	</div>
              </a>
	           <? } ?>
  		</div>
    </div>
</div>


<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>