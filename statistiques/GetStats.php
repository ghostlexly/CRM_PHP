<?php
// ********************* CA CETTE ANNEEE ****************** //
$Annee_Actu = date("Y");
$Annee_Derniere = date("Y", strtotime('-1 year'));


$stmt = $pdo->prepare("SELECT SUM(ifnull(f.total_ht, 0)) + SUM(DISTINCT ifnull(a.total_ht, 0)) AS total_ht_with_avoirs
											 FROM Factures f
											 LEFT JOIN Avoirs a ON a.date LIKE :Annee_Actu
											 WHERE f.date_facture LIKE :Annee_Actu");
$stmt->bindValue('Annee_Actu', $Annee_Actu . "-%", PDO::PARAM_STR);
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$CA_HT_AN_EN_COURS = $stmt['total_ht_with_avoirs'];



// ********************* CA ANNE D'AVANT **************** //
$stmt = $pdo->prepare("SELECT SUM(ifnull(f.total_ht, 0)) + SUM(DISTINCT ifnull(a.total_ht, 0)) AS total_ht_with_avoirs
											 FROM Factures f
											 LEFT JOIN Avoirs a ON a.date LIKE :Annee_Derniere
											 WHERE f.date_facture LIKE :Annee_Derniere");
$stmt->bindValue('Annee_Derniere', $Annee_Derniere . "-%", PDO::PARAM_STR);
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$CA_HT_AN_DERNIERE = $stmt['total_ht_with_avoirs'];




// ******************* CA DEPUIS LE DEBUT **************** //
$stmt = $pdo->prepare("SELECT SUM(ifnull(f.total_ht, 0)) + SUM(DISTINCT ifnull(a.total_ht, 0)) AS total_ht_with_avoirs
											 FROM Factures f
											 LEFT JOIN Avoirs AS a ON true");
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$CA_HT_DEPUIS_DEBUT = $stmt['total_ht_with_avoirs'];




// ***************** FACTURES EN ATTENTE ***************** //
$stmt = $pdo->prepare("SELECT SUM(total_ht) FROM Factures WHERE statut = '0'");
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$FACTURES_EN_ATTENTE_TOTAL = $stmt['SUM(total_ht)'];



// *********** TOTAL MARGE ************** //
$stmt = $pdo->prepare("SELECT SUM(total_marge) FROM Factures WHERE date_facture LIKE :Annee_Actu");
$stmt->bindValue('Annee_Actu', $Annee_Actu . "-%", PDO::PARAM_STR);
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$MARGE_THIS_YEAR = $stmt['SUM(total_marge)'];

if($CA_HT_AN_EN_COURS == 0) {
	$MARGE_POURCENTAGE = "0";
} else {
	$MARGE_POURCENTAGE = (($MARGE_THIS_YEAR * 100) / $CA_HT_AN_EN_COURS);
}




// ****** COMPTER LES CLIENTS ****** //
$stmt = $pdo->prepare("SELECT COUNT(id) FROM Clients");
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


$CLIENTS_COUNT = $stmt['COUNT(id)'];




// ******* CALCUL MARGE % ******* //
$stmt = $pdo->prepare("SELECT COUNT(DISTINCT d.id) devis_en_attente,
															COUNT(DISTINCT a.id) devis_validees
											 FROM Devis d
											 LEFT JOIN Devis a ON a.statut = 1");
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);

$CONVERSION_DEVIS_VALIDEES = $stmt['devis_validees'];
$CONVERSION_DEVIS_ENATTENTE = $stmt['devis_en_attente'];
$CONVERSION_POURCENTAGE = number_format((($stmt['devis_validees'] * 100) / $stmt['devis_en_attente']), 0, "", "");
?>
