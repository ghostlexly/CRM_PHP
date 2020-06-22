<?php
if(isset($_GET['id'])) {
$_P = $_POST;
$this_devis_id = $_GET['id'];

try {
	if(isset($_P['choix_client']) && isset($_P['email']) && isset($_P['adresse_facturation']) && isset($_P['designation_devis']) && isset($_P['repeater-list-prestations'])) {
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
		$nom_designation = $_P['designation_devis'];
		$email = $_P['email'];
		$adresse_facturation = $_P['adresse_facturation'];
		$tel_fixe = $_P['tel_fixe'];
		$tel_portable = $_P['tel_portable'];
		$date_devis = $_P['date_ajout'];
		$numero_devis = $_P['numero_facturation'];

		if(isset($_P['tva_applicable'])) { $tva_applicable = '1'; } else { $tva_applicable = '0'; }


		if(isset($_P['devis_reglee'])) {
			$statut = '1';
		} elseif(isset($_P['devis_refuse'])) {
			$statut = "2";
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






		// CREER LE DEVIS //
		$stmt = $pdo->prepare("UPDATE Devis SET id_client = :id_client, nom_designation = :nom_designation, email = :email, adresse_facturation = :adresse_facturation, tel_fixe = :tel_fixe, tel_portable = :tel_portable,
			 date_devis = :date_devis, numero_devis = :numero_devis, tva_applicable = :tva_applicable, total_ht = :total_ht, statut = :statut WHERE id = :this_devis_id");
		$stmt->bindValue('id_client', $id_client, PDO::PARAM_STR);
		$stmt->bindValue('nom_designation', $nom_designation, PDO::PARAM_STR);
		$stmt->bindValue('email', $email, PDO::PARAM_STR);
		$stmt->bindValue('adresse_facturation', $adresse_facturation, PDO::PARAM_STR);
		$stmt->bindValue('tel_fixe', $tel_fixe, PDO::PARAM_STR);
		$stmt->bindValue('tel_portable', $tel_portable, PDO::PARAM_STR);
		$stmt->bindValue('date_devis', $date_devis, PDO::PARAM_STR);
		$stmt->bindValue('numero_devis', $numero_devis, PDO::PARAM_STR);
		$stmt->bindValue('tva_applicable', $tva_applicable, PDO::PARAM_STR);
		$stmt->bindValue('total_ht', $calc_total_ht, PDO::PARAM_STR);
		$stmt->bindValue('statut', $statut, PDO::PARAM_STR);
		$stmt->bindValue('this_devis_id', $this_devis_id, PDO::PARAM_INT);
		$stmt->execute();

		?> <div class="alert alert-success">Le devis a bien été modifié !</div> <?php





		// SUPPRIMER LES DESIGNATIONS ET LES MARGES POUR LES RECREER
		$stmt = $pdo->prepare("DELETE FROM Devis_designations WHERE id_devis = :this_devis_id");
		$stmt->bindValue('this_devis_id', $this_devis_id, PDO::PARAM_INT);
		$stmt->execute();






		// CREER LES DESIGNATIONS
			$query_c = "INSERT INTO Devis_designations (id_devis, designation, quantite, montant_ht) VALUES ";

			//Création requête prepare
			foreach ($prestations as $presta) {
				$query_c .= "(?, ?, ?, ?),";
			}
			$query_c = substr($query_c, 0, strlen($query_c) - 1);
			$stmt = $pdo->prepare($query_c);

			//Assignation valeurs
			$it = 1;
			foreach ($prestations as $presta) {
				$stmt->bindValue($it, $this_devis_id, PDO::PARAM_STR);
				$stmt->bindValue($it+1, $presta['designation_prestation'], PDO::PARAM_STR);
				$stmt->bindValue($it+2, $presta['quantite'], PDO::PARAM_STR);
				$stmt->bindValue($it+3, $presta['prix_unitaire'], PDO::PARAM_STR);
				$it = ($it + 4);
			}
			$stmt->execute();


		?> <div class="alert alert-success">Les prestations ont bien été ajoutées au devis !</div> <?php









		// MOYEN DE PAIEMENT
		if(isset($_P['devis_reglee']) && $_P['moyen_paiement'] !== null) {
			$type_reglement = $_P['moyen_paiement'];
			$date_paiement = $_P['date_paiement'];

			$stmt = $pdo->prepare("UPDATE Devis SET type_reglement = :type_reglement, date_paiement = :date_paiement WHERE id = :id_devis");
			$stmt->bindValue('type_reglement', $type_reglement, PDO::PARAM_STR);
			$stmt->bindValue('date_paiement', $date_paiement, PDO::PARAM_STR);
			$stmt->bindValue('id_devis', $this_devis_id, PDO::PARAM_STR);
			$stmt->execute();
		}






		EndOfSystem:
	}
} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de la création du devis !</div> <?php
}
}
?>
