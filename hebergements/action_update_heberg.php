<?php
require("$_SERVER[DOCUMENT_ROOT]/config/database.php"); require("$_SERVER[DOCUMENT_ROOT]/check_connected.php");
if(!CheckSecurity('hebergements')) { exit("Vous n'avez pas accès à cette page."); }


if(isset($_GET['id']) && isset($_GET['type'])) {

	$id_heberg = $_GET['id'];

	$stmt = $pdo->prepare("SELECT date_renouv_heberg FROM Clients_hebergements WHERE id = :getid");
	$stmt->bindValue('getid', $id_heberg, PDO::PARAM_INT);
	$stmt->execute();
	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);



	// Type  0 = Pour 1 mois
	if($_GET['type'] == '0') {
		$New_Date = date("Y-m-d", strtotime("$stmt[date_renouv_heberg] +1 month"));
	}


	// Type  1 = Pour 1 an
	if($_GET['type'] == '1') {
		$New_Date = date("Y-m-d", strtotime("$stmt[date_renouv_heberg] +1 year"));
	}



	$stmt = $pdo->prepare("UPDATE Clients_hebergements SET date_renouv_heberg = :New_Date WHERE id = :getid");
	$stmt->bindValue('getid', $id_heberg, PDO::PARAM_INT);
	$stmt->bindValue('New_Date', $New_Date, PDO::PARAM_STR);
	$stmt->execute();
	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
