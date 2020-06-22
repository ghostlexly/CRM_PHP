<?php
function Gen_Facture_Numero() {
	global $pdo;
	$YYMM = date("ym");
	$format_facture = "FA-$YYMM-";
	$stmt = $pdo->prepare("SELECT numero_facture FROM Factures WHERE numero_facture LIKE '$format_facture%' ORDER BY numero_facture DESC LIMIT 1");
	$stmt->execute();

	if($stmt->rowCount() == 0) { return $format_facture . "001"; }

	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


	$Last_Fac_Num = $stmt['numero_facture'];

	//Decoupage
	$FactSP1 = substr($Last_Fac_Num, 0, strlen($Last_Fac_Num)-3);
	$FactSP2 = substr($Last_Fac_Num, strlen($Last_Fac_Num)-3, 3);
	//Incrémenter
	$FactSP2 = str_pad(($FactSP2+1),3,"0",STR_PAD_LEFT);
	//Re-Associer
	$New_Fac_Num = $FactSP1 . $FactSP2;

	return $New_Fac_Num;
}



function Gen_Devis_Numero() {
	global $pdo;
	$YYMM = date("ym");
	$format_devis = "DE-$YYMM-";
	$stmt = $pdo->prepare("SELECT numero_devis FROM Devis WHERE numero_devis LIKE '$format_devis%' ORDER BY numero_devis DESC LIMIT 1");
	$stmt->execute();

	if($stmt->rowCount() == 0) { return $format_devis . "001"; }

	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


	$Last_Fac_Num = $stmt['numero_devis'];

	//Decoupage
	$FactSP1 = substr($Last_Fac_Num, 0, strlen($Last_Fac_Num)-3);
	$FactSP2 = substr($Last_Fac_Num, strlen($Last_Fac_Num)-3, 3);
	//Incrémenter
	$FactSP2 = str_pad(($FactSP2+1),3,"0",STR_PAD_LEFT);
	//Re-Associer
	$New_Fac_Num = $FactSP1 . $FactSP2;

	return $New_Fac_Num;
}







function Gen_Avoir_Numero() {
	global $pdo;
	$YYMM = date("ym");
	$format_avoir = "AV-$YYMM-";
	$stmt = $pdo->prepare("SELECT numero_avoir FROM Avoirs WHERE numero_avoir LIKE '$format_avoir%' ORDER BY numero_avoir DESC LIMIT 1");
	$stmt->execute();

	if($stmt->rowCount() == 0) { return $format_avoir . "001"; }

	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);


	$Last_Fac_Num = $stmt['numero_avoir'];

	//Decoupage
	$FactSP1 = substr($Last_Fac_Num, 0, strlen($Last_Fac_Num)-3);
	$FactSP2 = substr($Last_Fac_Num, strlen($Last_Fac_Num)-3, 3);
	//Incrémenter
	$FactSP2 = str_pad(($FactSP2+1),3,"0",STR_PAD_LEFT);
	//Re-Associer
	$New_Fac_Num = $FactSP1 . $FactSP2;

	return $New_Fac_Num;
}






function Verification_des_Donnees($_P) {
	$Error_Happened = false;

	if(!empty($_P['numero_siret']) && !ctype_digit($_P['numero_siret'])) {
		?> <div class="alert alert-danger">Le numéro de SIRET contient des caractères !</div> <?php
		$Error_Happened = true;
	}
	if(!empty($_P['tel_fixe']) && !preg_match("/^[0-9 ]{14}$/", $_P['tel_fixe'])) {
		?> <div class="alert alert-danger">Le numéro de téléphone fixe n'est pas entré correctement ! <br> Exemple: 01 23 45 67 89</div> <?php
		$Error_Happened = true;
	}
	if(!empty($_P['tel_portable']) && !preg_match("/^[0-9 ]{14}$/", $_P['tel_portable'])) {
		?> <div class="alert alert-danger">Le numéro de téléphone portable n'est pas entré correctement ! <br> Exemple: 01 23 45 67 89</div> <?php
		$Error_Happened = true;
	}



	// Check date --> https://www.phpliveregex.com/ @@@ LA DATE ARRIVE EN US 2018-07-06
	if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_P['date_ajout'])) {
		?> <div class="alert alert-danger">La date d'ajout n'est pas correctement entrée !</div> <?php
		$Error_Happened = true;
	}


	// Check adresse --> https://www.phpliveregex.com/
	if(!empty($_P['adresse_facturation']) && !preg_match("/^[^-]{3,} - [^-]{3,}$/", $_P['adresse_facturation'])) {
		?> <div class="alert alert-danger">L'adresse n'est pas correctement entrée ! <br> Suivez l'exemple (avec les espaces): 21, Boulevard de Tunis - 13008 Marseille</div> <?php
		$Error_Happened = true;
	}


	return $Error_Happened;
}






function GetClientInfos_FromID($id) {
	global $pdo;
	$ClientInfos = $pdo->prepare("SELECT * FROM Clients WHERE id = :thisid");
	$ClientInfos->bindValue('thisid', $id, PDO::PARAM_STR); // OU PDO::PARAM_INT
	$ClientInfos->execute();

	if($ClientInfos->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce client n'existe plus !</div> <?php
		exit();
	}

	$ClientInfos = $ClientInfos->fetch(PDO::FETCH_ASSOC);
	return $ClientInfos;
}








function CountFacturesAttenteFromID($id_client) {
	global $pdo;

	$stmt = $pdo->prepare("SELECT COUNT(id) FROM Factures WHERE id_client = :id_client AND statut = '0'");
	$stmt->bindValue('id_client', $id_client, PDO::PARAM_INT); // OU PDO::PARAM_INT
	$stmt->execute();
	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);

	return $stmt['COUNT(id)'];
}








function CheckSecurity($security_name) {
		global $UserSecurity;
		if(isset($UserSecurity['security_levels'])) $UserSecurity = $UserSecurity['security_levels'];


		if(!isset($UserSecurity[$security_name]) || empty($UserSecurity[$security_name])) return false;

		if($UserSecurity[$security_name] == 1) {
			 return true;
		} else {
			return false;
		}
}





?>
