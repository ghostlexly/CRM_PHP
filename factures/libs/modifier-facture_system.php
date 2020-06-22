<?php
if(isset($_GET['id'])) {
$_P = $_POST;
$this_facture_id = $_GET['id'];

try {
	if(isset($_P['choix_client']) && isset($_P['email']) && isset($_P['adresse_facturation']) && isset($_P['designation_facture']) && isset($_P['repeater-list-prestations'])) {
		$prestations = $_P['repeater-list-prestations'];

		//------- VERIFICATION DES DONNÉES ---------//
		if(Verification_des_Donnees($_P) == true) { goto EndOfSystem; }

		foreach ($prestations as $presta) {
			if(!ctype_digit($presta['quantite'])) {
				?> <div class="alert alert-danger">La quantité entrée dans les prestations ne doit contenir que des chiffres !</div> <?php
				goto EndOfSystem;
			}

			if(!preg_match("/^[0-9-]{1,}[.][0-9-]{2}$/", $presta['prix_unitaire']) && !preg_match("/^[0-9-]{1,}$/", $presta['prix_unitaire'])) {
				?> <div class="alert alert-danger">Le prix entré dans les prix unitaire doit respecter le format ! <br> Exemple: 1234.56 ou 1234.00 ou 1234</div> <?php
				goto EndOfSystem;
			}
		}


		//------- CREATION DES VARIABLES --------//
		$id_client = $_P['choix_client'];
		$nom_designation = $_P['designation_facture'];
		$email = $_P['email'];
		$adresse_facturation = $_P['adresse_facturation'];
		$tel_fixe = $_P['tel_fixe'];
		$tel_portable = $_P['tel_portable'];
		$date_facture = $_P['date_ajout'];
		$numero_facture = $_P['numero_facturation'];

		if(isset($_P['tva_applicable'])) { $tva_applicable = '1'; } else { $tva_applicable = '0'; }


		if(isset($_P['facture_reglee'])) {
				$statut = '1';
		} elseif(isset($_P['facture_suspendue'])) {
				$statut = '2';
		} else {
			$statut = '0';
		}




		// CALCUL TOTAL HT
		$calc_total_ht = "0.00";

		foreach ($prestations as $presta) {
			$amt = ($presta['prix_unitaire'] * $presta['quantite']);
			$calc_total_ht = ($calc_total_ht + $amt);
		}
		$calc_total_ht = number_format($calc_total_ht, 2, '.', '');




		// METTRE LES VALEURS DU POST EN NULL POUR LA BD
		function drop_empty($var)
		{
		  return ($var === '') ? NULL : $var;
		}
		$_P = array_map('drop_empty', $_P);






		// CREER LA FACTURE //
		$stmt = $pdo->prepare("UPDATE Factures SET id_client = :id_client, nom_designation = :nom_designation, email = :email, adresse_facturation = :adresse_facturation, tel_fixe = :tel_fixe, tel_portable = :tel_portable,
			 date_facture = :date_facture, numero_facture = :numero_facture, tva_applicable = :tva_applicable, total_ht = :total_ht, statut = :statut WHERE id = :this_facture_id");
		$stmt->bindValue('id_client', $id_client, PDO::PARAM_STR);
		$stmt->bindValue('nom_designation', $nom_designation, PDO::PARAM_STR);
		$stmt->bindValue('email', $email, PDO::PARAM_STR);
		$stmt->bindValue('adresse_facturation', $adresse_facturation, PDO::PARAM_STR);
		$stmt->bindValue('tel_fixe', $tel_fixe, PDO::PARAM_STR);
		$stmt->bindValue('tel_portable', $tel_portable, PDO::PARAM_STR);
		$stmt->bindValue('date_facture', $date_facture, PDO::PARAM_STR);
		$stmt->bindValue('numero_facture', $numero_facture, PDO::PARAM_STR);
		$stmt->bindValue('tva_applicable', $tva_applicable, PDO::PARAM_STR);
		$stmt->bindValue('total_ht', $calc_total_ht, PDO::PARAM_STR);
		$stmt->bindValue('statut', $statut, PDO::PARAM_STR);
		$stmt->bindValue('this_facture_id', $this_facture_id, PDO::PARAM_INT);
		$stmt->execute();

		?> <div class="alert alert-success">La facture a bien été modifiée !</div> <?php





		// SUPPRIMER LES DESIGNATIONS ET LES MARGES POUR LES RECREER
		$stmt = $pdo->prepare("DELETE FROM Factures_designations WHERE id_facture = :this_facture_id");
		$stmt->bindValue('this_facture_id', $this_facture_id, PDO::PARAM_INT);
		$stmt->execute();
		$stmt = $pdo->prepare("DELETE FROM Marges_DB WHERE id_facture = :this_facture_id");
		$stmt->bindValue('this_facture_id', $this_facture_id, PDO::PARAM_INT);
		$stmt->execute();






		// CREER LES DESIGNATIONS
			$query_c = "INSERT INTO Factures_designations (id_facture, designation, quantite, montant_ht) VALUES ";

			//Création requête prepare
			foreach ($prestations as $presta) {
				$query_c .= "(?, ?, ?, ?),";
			}
			$query_c = substr($query_c, 0, strlen($query_c) - 1);
			$stmt = $pdo->prepare($query_c);

			//Assignation valeurs
			$it = 1;
			foreach ($prestations as $presta) {
				$stmt->bindValue($it, $this_facture_id, PDO::PARAM_STR);
				$stmt->bindValue($it+1, $presta['designation_prestation'], PDO::PARAM_STR);
				$stmt->bindValue($it+2, $presta['quantite'], PDO::PARAM_STR);
				$stmt->bindValue($it+3, $presta['prix_unitaire'], PDO::PARAM_STR);
				$it = ($it + 4);
			}
			$stmt->execute();


		?> <div class="alert alert-success">Les prestations ont bien été ajoutées à la facture !</div> <?php





		// CREER LES MARGES
		$total_marge = "0.00";
			foreach ($_P['repeater-list-intervenants'] as $this_marge) {
				$this_heures_passes = $this_marge['temps_passe'];
				$this_idinter = $this_marge['choix_intervenant'];
				$this_taux_h = array_search($this_idinter, array_column($List_Intervenants, 'id'));
				$this_taux_h = $List_Intervenants[$this_taux_h]['taux_horaire'];

				$total_marge = ($total_marge + ($this_taux_h * $this_heures_passes));

				$stmt = $pdo->prepare("INSERT INTO Marges_DB (id_facture, id_intervenant, taux_horaire, heures) VALUES (:id_facture, :id_inter, :taux_horaire, :heures_passes)");
				$stmt->bindValue('id_facture', $this_facture_id, PDO::PARAM_INT);
				$stmt->bindValue('id_inter', $this_idinter, PDO::PARAM_INT);
				$stmt->bindValue('taux_horaire', $this_taux_h, PDO::PARAM_INT);
				$stmt->bindValue('heures_passes', $this_heures_passes, PDO::PARAM_INT);
				$stmt->execute();
			}

		$total_marge = ($total_marge + $_P['couts_externes']);
		$total_marge = ($total_marge + (($calc_total_ht * $FraisInternes) / 100)); // Frais internes (10%)
		$total_marge = ($calc_total_ht - $total_marge);
		$total_marge = number_format($total_marge, 2, '.', '');



			$stmt = $pdo->prepare("UPDATE Factures SET total_marge = :total_marge WHERE id = :id_facture");
			$stmt->bindValue('total_marge', $total_marge, PDO::PARAM_STR);
			$stmt->bindValue('id_facture', $this_facture_id, PDO::PARAM_INT);
			$stmt->execute();



			$stmt = $pdo->prepare("UPDATE Marges_externalisation  SET montant = :montant_ext WHERE id_facture = :id_facture");
			$stmt->bindValue('id_facture', $this_facture_id, PDO::PARAM_INT);
			$stmt->bindValue('montant_ext', $_P['couts_externes'], PDO::PARAM_STR);
			$stmt->execute();

		?> <div class="alert alert-success">Les marges et intervenants ont bien été ajoutés à la facture !</div> <?php







		// MOYEN DE PAIEMENT
		if(isset($_P['facture_reglee']) && $_P['moyen_paiement'] !== null) {
			$type_reglement = $_P['moyen_paiement'];
			$date_paiement = $_P['date_paiement'];

			$stmt = $pdo->prepare("UPDATE Factures SET type_reglement = :type_reglement, date_paiement = :date_paiement WHERE id = :id_facture");
			$stmt->bindValue('type_reglement', $type_reglement, PDO::PARAM_STR);
			$stmt->bindValue('date_paiement', $date_paiement, PDO::PARAM_STR);
			$stmt->bindValue('id_facture', $this_facture_id, PDO::PARAM_STR);
			$stmt->execute();
		}






		EndOfSystem:
	}
} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de la création de la facture !</div> <?php
}
}
?>
