<?php
if(isset($_GET['id'])) {
$_P = $_POST;
$this_avoir_id = $_GET['id'];

try {
	if(isset($_P['choix_client']) && isset($_P['designation_avoir']) && isset($_P['repeater-list-prestations'])) {
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
    $id_facture = $_P['choix_facture'];
    $nom_designation = $_P['designation_avoir'];
    $date_avoir = $_P['date_ajout'];
    $numero_avoir = $_P['numero_avoir'];

		if(isset($_P['tva_applicable'])) { $tva_applicable = '1'; } else { $tva_applicable = '0'; }




		// CALCUL TOTAL HT
		$calc_total_ht = "0.00";

		foreach ($prestations as $presta) {
      // ** C'est un avoir, on ajoute un - au début
          if($presta['prix_unitaire'] > 0) {
              $presta['prix_unitaire'] = "-" . $presta['prix_unitaire'];
          }
      // ------------------------------------------

			$amt = ($presta['prix_unitaire'] * $presta['quantite']);
			$calc_total_ht = ($calc_total_ht + $amt);
		}
		$calc_total_ht = number_format($calc_total_ht, 2, '.', '');



    // C'EST UN AVOIR, ON AJOUTE UN MOINS !
    if($calc_total_ht > 0) {
        $calc_total_ht = "-" . $calc_total_ht;
    }



		// METTRE LES VALEURS DU POST EN NULL POUR LA BD
		function drop_empty($var)
		{
		  return ($var === '') ? NULL : $var;
		}
		$_P = array_map('drop_empty', $_P);






		// MODIFIER L'AVOIR //
    $stmt = $pdo->prepare("UPDATE Avoirs SET id_client = :id_client, id_facture = :id_facture, nom_designation = :nom_designation, date = :date, numero_avoir = :numero_avoir, tva_applicable = :tva_applicable, total_ht = :total_ht WHERE id = :this_avoir_id");
		$stmt->bindValue('id_client', $id_client, PDO::PARAM_STR);
    $stmt->bindValue('id_facture', $id_facture, PDO::PARAM_STR);
		$stmt->bindValue('nom_designation', $nom_designation, PDO::PARAM_STR);
		$stmt->bindValue('date', $date_avoir, PDO::PARAM_STR);
		$stmt->bindValue('numero_avoir', $numero_avoir, PDO::PARAM_STR);
		$stmt->bindValue('tva_applicable', $tva_applicable, PDO::PARAM_STR);
		$stmt->bindValue('total_ht', $calc_total_ht, PDO::PARAM_STR);
    $stmt->bindValue('this_avoir_id', $this_avoir_id, PDO::PARAM_STR);
		$stmt->execute();

		?> <div class="alert alert-success">L'avoir a bien été modifié !</div> <?php





		// SUPPRIMER LES DESIGNATIONS ET LES MARGES POUR LES RECREER
		$stmt = $pdo->prepare("DELETE FROM Avoirs_designations WHERE id_avoir = :this_avoir_id");
		$stmt->bindValue('this_avoir_id', $this_avoir_id, PDO::PARAM_INT);
		$stmt->execute();






		// CREER LES DESIGNATIONS
			$query_c = "INSERT INTO Avoirs_designations (id_avoir, designation, quantite, montant_ht) VALUES ";

			//Création requête prepare
			foreach ($prestations as $presta) {
				$query_c .= "(?, ?, ?, ?),";
			}
			$query_c = substr($query_c, 0, strlen($query_c) - 1);
			$stmt = $pdo->prepare($query_c);

			//Assignation valeurs
			$it = 1;
			foreach ($prestations as $presta) {
				// ** C'est un avoir, on ajoute un - au début
				if($presta['prix_unitaire'] > 0) {
						$presta['prix_unitaire'] = "-" . $presta['prix_unitaire'];
				}
				// ------------------------------------------

				$stmt->bindValue($it, $this_avoir_id, PDO::PARAM_STR);
				$stmt->bindValue($it+1, $presta['designation_prestation'], PDO::PARAM_STR);
				$stmt->bindValue($it+2, $presta['quantite'], PDO::PARAM_STR);
				$stmt->bindValue($it+3, $presta['prix_unitaire'], PDO::PARAM_STR);
				$it = ($it + 4);
			}
			$stmt->execute();


		?> <div class="alert alert-success">Les prestations ont bien été ajoutées à l'avoir !</div> <?php





		EndOfSystem:
	}
} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de la modification de l'avoir !</div> <?php
}
}
?>
