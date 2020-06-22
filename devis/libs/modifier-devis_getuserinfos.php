<?php

if(isset($DevisInfos['id_client'])) {

	$ClientInfos = $pdo->prepare("SELECT * FROM Clients WHERE id = :thisid");
	$ClientInfos->bindValue('thisid', $DevisInfos['id_client'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$ClientInfos->execute();

	if($ClientInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce client n'existe plus !</div> <?php
		exit();
	}

	$ClientInfos = $ClientInfos->fetch(PDO::FETCH_ASSOC);

}

?>
