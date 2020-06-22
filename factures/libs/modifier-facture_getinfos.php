<?php

if(isset($_GET['id'])) {

	$FactureInfos = $pdo->prepare("SELECT * FROM Factures WHERE id = :thisid");
	$FactureInfos->bindValue('thisid', $_GET['id'], PDO::PARAM_INT);
	$FactureInfos->execute();

	if($FactureInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Cette facture n'existe plus !</div> <?php
		exit();
	}

	$FactureInfos = $FactureInfos->fetch(PDO::FETCH_ASSOC);




	$FactureDesigs = $pdo->prepare("SELECT * FROM Factures_designations WHERE id_facture = :idfacture");
	$FactureDesigs->bindValue('idfacture', $FactureInfos['id'], PDO::PARAM_INT);
	$FactureDesigs->execute();



	$Externalisation = $pdo->prepare("SELECT montant FROM Marges_externalisation WHERE id_facture = :idfacture");
	$Externalisation->bindValue('idfacture', $FactureInfos['id'], PDO::PARAM_INT);
	$Externalisation->execute();
	$Externalisation = $Externalisation->fetch(PDO::FETCH_ASSOC);
	$FactureInfos['externalisation'] = $Externalisation['montant'];




	$Intervs = $pdo->prepare("SELECT * FROM Marges_DB WHERE id_facture = :idfacture");
	$Intervs->bindValue('idfacture', $FactureInfos['id'], PDO::PARAM_INT);
	$Intervs->execute();



} else {
	?> <div class="alert alert-danger">Il n'y a pas d'ID de facture défini dans les paramètres !</div> <?php
	exit();
}

?>