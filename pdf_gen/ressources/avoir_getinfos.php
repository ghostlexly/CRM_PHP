<?php
require("$_SERVER[DOCUMENT_ROOT]/config/database.php");
ob_end_clean();


if(isset($_GET['id_avoir'])) {

	$Fact_id = $_GET['id_avoir'];
	if(!ctype_digit($Fact_id)) {
		exit("Tentative de piratage détecté. Votre adresse IP a été communiqué à nos services.");
	}


	$_GET['id'] = $Fact_id;
	include("$_SERVER[DOCUMENT_ROOT]/avoirs/libs/modifier-avoir_getinfos.php");

	$_GET['id'] = $AvoirInfos['id_client'];
	include("$_SERVER[DOCUMENT_ROOT]/clients/libs/details-client_getinfos.php");


	$Address_Line1 = explode('-', $ClientInfos['adresse_facturation'])[0];
	$Address_Line1 = substr($Address_Line1, 0, strlen($Address_Line1) -1);

	$Address_Line2 = explode('-', $ClientInfos['adresse_facturation'])[1];
	$Address_Line2 = substr($Address_Line2, 1);

} else {
	exit("Un problème est survenu lors de l'assignation des données sur l'avoir.");
}

?>
