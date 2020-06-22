<? include("$_SERVER[DOCUMENT_ROOT]/header.php"); ob_end_clean();

if(isset($_GET['q'])) {


	$search_query = htmlspecialchars($_GET['q']);
	$results = array();


	if(empty($search_query)) { exit(); }

			// @ SEARCH DANS LES CLIENTS
				$stmt = $pdo->prepare("SELECT * FROM Clients WHERE nom_societe LIKE :search_q_like 
					OR nom_interlocuteur LIKE :search_q_like
					OR email LIKE :search_q_like
					OR siret LIKE :search_q_like");
				$stmt->bindValue('search_q_like', "%$search_query%", PDO::PARAM_STR); // OU PDO::PARAM_INT
				$stmt->execute();
				$stmt = $stmt->fetchAll();


				foreach($stmt as $search_r) {
					$results[] = $search_r['nom_societe'];
				}



			// @ SEARCH DANS LES FACTURES
				$stmt = $pdo->prepare("SELECT * FROM Factures WHERE numero_facture LIKE :search_q_like");
				$stmt->bindValue('search_q_like', "%$search_query%", PDO::PARAM_STR); // OU PDO::PARAM_INT
				$stmt->execute();
				$stmt = $stmt->fetchAll();


				foreach($stmt as $search_r) {
					$results[] = $search_r['numero_facture'];
				}




				// @ ENVOYER LES RESULTATS
				echo json_encode($results);
}
?>