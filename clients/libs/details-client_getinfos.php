<?php

if(isset($_GET['id'])) {

	$ClientInfos = $pdo->prepare("SELECT * FROM Clients WHERE id = :thisid");
	$ClientInfos->bindValue('thisid', $_GET['id'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$ClientInfos->execute();

	if($ClientInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce client n'existe plus !</div> <?php
		exit();
	}

	$ClientInfos = $ClientInfos->fetch(PDO::FETCH_ASSOC);
	


	$Hebergs = $pdo->prepare("SELECT * FROM Clients_hebergements WHERE id_client = :thisid");
	$Hebergs->bindValue('thisid', $_GET['id'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$Hebergs->execute();
	$Hebergs = $Hebergs->fetch(PDO::FETCH_ASSOC);


} else {
	?> <div class="alert alert-danger">Il n'y a pas d'ID de client défini dans les paramètres !</div> <?php
	exit();
}

?>