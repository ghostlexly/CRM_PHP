<?php

if(isset($_GET['idclient'])) {

	$ClientInfos = $pdo->prepare("SELECT * FROM Clients WHERE id = :thisid");
	$ClientInfos->bindValue('thisid', $_GET['idclient'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$ClientInfos->execute();

	if($ClientInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce client n'existe plus !</div> <?php
		exit();
	}

	$ClientInfos = $ClientInfos->fetch(PDO::FETCH_ASSOC);
	

}



function GetVarClient($InfoName) {
	global $ClientInfos;
	if(isset($_POST["$InfoName"])) {
		return $_POST["$InfoName"];
	}

	if(isset($ClientInfos) && isset($_GET['idclient'])) {
		return $ClientInfos["$InfoName"];
	} else {
		return "";
	}
}


?>