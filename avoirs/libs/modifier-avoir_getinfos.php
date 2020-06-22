<?php

if(isset($_GET['id'])) {

	$AvoirInfos = $pdo->prepare("SELECT a.*, f.numero_facture FROM Avoirs AS a
															LEFT JOIN Factures as f ON f.id = a.id_facture
															WHERE a.id = :thisid");
	$AvoirInfos->bindValue('thisid', $_GET['id'], PDO::PARAM_INT);
	$AvoirInfos->execute();

	if($AvoirInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Cet avoir n'existe plus !</div> <?php
		exit();
	}

	$AvoirInfos = $AvoirInfos->fetch(PDO::FETCH_ASSOC);




	$AvoirDesigs = $pdo->prepare("SELECT * FROM Avoirs_designations WHERE id_avoir = :id_avoir");
	$AvoirDesigs->bindValue('id_avoir', $AvoirInfos['id'], PDO::PARAM_INT);
	$AvoirDesigs->execute();



} else {
	?> <div class="alert alert-danger">Il n'y a pas d'ID d'avoir défini dans les paramètres !</div> <?php
	exit();
}










if(isset($AvoirInfos['id_client'])) {
	$ClientInfos = $pdo->prepare("SELECT * FROM Clients WHERE id = :thisid");
	$ClientInfos->bindValue('thisid', $AvoirInfos['id_client'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$ClientInfos->execute();

	if($ClientInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce client n'existe plus !</div> <?php
		exit();
	}

	$ClientInfos = $ClientInfos->fetch(PDO::FETCH_ASSOC);


	$_GET['idclient'] = $AvoirInfos['id_client'];
}



function GetVarClient($InfoName) {
	global $ClientInfos;
	global $AvoirInfos;

	if(isset($_POST["$InfoName"])) {
		return $_POST["$InfoName"];
	}


	if(isset($ClientInfos) && isset($AvoirInfos['id_client'])) {
		return $ClientInfos["$InfoName"];
	} else {
		return "";
	}
}

?>
