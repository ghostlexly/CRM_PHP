<?php
$_P = $_POST;

if(isset($_P['taux_interne']) && isset($_P['repeater-list-intervenants'])) {

	// Vérification données
	if(!ctype_digit($_P['taux_interne'])) {
	  ?> <div class="alert alert-danger">Le taux interne n'est pas correctement entré !</div> <?php
	  goto EndOfSystem;
	}



	// Save taux_interne
	$stmt = $pdo->prepare("UPDATE Marges_Config SET taux_horaire = :new_fraisinterne WHERE id='0'");
	$stmt->bindValue('new_fraisinterne', $_P['taux_interne'], PDO::PARAM_INT); // OU PDO::PARAM_INT
	$stmt->execute();



	
	foreach($_P['repeater-list-intervenants'] as $inter) {
		if(!CheckIfIsPrix($inter['taux_horaire'])) {
			?> <div class="alert alert-danger">Le taux horaire n'est pas correctement entré dans l'un des intervenants !</div> <?php
	 		goto EndOfSystem;
		}


		if(isset($inter['exist_id']) && !empty($inter['exist_id'])) {
			// On tente d'update
			$stmt = $pdo->prepare("UPDATE Marges_Config SET nom = :nom, taux_horaire = :taux_horaire WHERE id = :exist_id");
			$stmt->bindValue('nom', $inter['membre_equipe'], PDO::PARAM_STR);
			$stmt->bindValue('taux_horaire', $inter['taux_horaire'], PDO::PARAM_STR);
			$stmt->bindValue('exist_id', $inter['exist_id'], PDO::PARAM_INT);
			$stmt->execute();
		} else {
			try {
				// N'existe pas, on ajoute
				$stmt = $pdo->prepare("INSERT INTO Marges_Config (nom, taux_horaire) VALUES (:nom, :taux_horaire)");
				$stmt->bindValue('nom', $inter['membre_equipe'], PDO::PARAM_STR);
				$stmt->bindValue('taux_horaire', $inter['taux_horaire'], PDO::PARAM_STR);
				$stmt->execute();
			} catch(PDOException $e) {
				?> <div class="alert alert-danger"> Un problème est survenu lors de l'ajout de l'intervenant : <?php echo $inter['membre_equipe']; ?>. </div> <?php
			}
		}
	}



	?> <div class="alert alert-success"> Les informations ont bien été mises à jour. </div> <?php
}

EndOfSystem:
?>