<?php

if(isset($_GET['id'])) {

	$DevisInfos = $pdo->prepare("SELECT * FROM Devis WHERE id = :thisid");
	$DevisInfos->bindValue('thisid', $_GET['id'], PDO::PARAM_INT);
	$DevisInfos->execute();

	if($DevisInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce devis n'existe plus !</div> <?php
		exit();
	}

	$DevisInfos = $DevisInfos->fetch(PDO::FETCH_ASSOC);




	$DevisDesigs = $pdo->prepare("SELECT * FROM Devis_designations WHERE id_devis = :iddevis");
	$DevisDesigs->bindValue('iddevis', $DevisInfos['id'], PDO::PARAM_INT);
	$DevisDesigs->execute();



} else {
	?> <div class="alert alert-danger">Il n'y a pas d'ID de devis défini dans les paramètres !</div> <?php
	exit();
}

?>
