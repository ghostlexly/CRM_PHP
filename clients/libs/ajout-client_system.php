<?php


if(isset($_POST['nom_societe']) && isset($_POST['nom_interlocuteur']) && isset($_POST['adresse_facturation']) && isset($_POST['adresse_email'])) {

	$_P = $_POST;


	//------- VERIFICATION DES DONNÉES ---------//

	if(!empty($_P['numero_siret']) && !ctype_digit($_P['numero_siret'])) {
		?> <div class="alert alert-danger">Le numéro de SIRET contient des caractères !</div> <?php
		goto EndOfSystem;
	}
	if(!empty($_P['tel_fixe']) && !preg_match("/^[0-9 ]{14}$/", $_P['tel_portable'])) {
		?> <div class="alert alert-danger">Le numéro de téléphone fixe n'est pas entré correctement ! <br> Exemple: 01 23 45 67 89</div> <?php
		goto EndOfSystem;
	}
	if(!empty($_P['tel_portable']) && !preg_match("/^[0-9 ]{14}$/", $_P['tel_portable'])) {
		?> <div class="alert alert-danger">Le numéro de téléphone portable n'est pas entré correctement ! <br> Exemple: 01 23 45 67 89</div> <?php
		goto EndOfSystem;
	}



	// Check date --> https://www.phpliveregex.com/ @@@ LA DATE ARRIVE EN US 2018-07-06
	if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_P['date_ajout'])) {
		?> <div class="alert alert-danger">La date d'ajout n'est pas correctement entrée !</div> <?php
		goto EndOfSystem;
	}


	// Check adresse --> https://www.phpliveregex.com/
	if(!preg_match("/^[^-]{3,} - [^-]{3,}$/", $_P['adresse_facturation'])) {
		?> <div class="alert alert-danger">L'adresse n'est pas correctement entrée ! <br> Suivez l'exemple (avec les espaces): 21, Boulevard de Tunis - 13008 Marseille</div> <?php
		goto EndOfSystem;
	}




// METTRE LES VALEURS DU POST EN NULL POUR LA BD
function drop_empty($var)
{
  return ($var === '') ? NULL : $var;
}
	$_P = array_map('drop_empty', $_P);




try {
	$stmt = $pdo->prepare("INSERT INTO Clients (nom_societe, nom_interlocuteur, email, adresse_facturation, numero_fixe, numero_portable, siret, tva, echeance_paiement, infos_compl, date_ajout) 
		VALUES (:nom_societe, :nom_interlocuteur, :email, :adresse_facturation, :numero_fixe, :numero_portable, :siret, :tva, :echeance_paiement, :infos_compl, :date_ajout)");
	$stmt->bindValue('nom_societe', $_P['nom_societe'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$stmt->bindValue('nom_interlocuteur', $_P['nom_interlocuteur'], PDO::PARAM_STR);
	$stmt->bindValue('email', $_P['adresse_email'], PDO::PARAM_STR);
	$stmt->bindValue('adresse_facturation', $_P['adresse_facturation'], PDO::PARAM_STR);
	$stmt->bindValue('numero_fixe', $_P['tel_fixe'], PDO::PARAM_INT);
	$stmt->bindValue('numero_portable', $_P['tel_portable'], PDO::PARAM_INT);
	$stmt->bindValue('siret', $_P['numero_siret'], PDO::PARAM_INT);
	$stmt->bindValue('tva', $_P['numero_tva'], PDO::PARAM_STR);
	$stmt->bindValue('echeance_paiement', $_P['echeance_paiement'], PDO::PARAM_STR);
	$stmt->bindValue('infos_compl', $_P['infos_complementaires'], PDO::PARAM_STR);
	$stmt->bindValue('date_ajout', $_P['date_ajout'], PDO::PARAM_STR);
	$stmt->execute();



	// Obtenir l'id du nouveau client
	$stmt_newid = $pdo->prepare("SELECT id FROM Clients ORDER BY id DESC LIMIT 1");
	$stmt_newid->execute();
	$stmt_newid = $stmt_newid->fetch(PDO::FETCH_ASSOC);

	?> <div class="alert alert-success">Le client a été ajouté avec succès ! <br> <a href="details-client.php?id=<?php echo $stmt_newid['id']; ?>">Cliquez ici</a> pour accéder à sa fiche.</div> <?php

} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de l'ajout du client à la base de données. Veuillez réessayer. <br> (Le client existe peut-être déjà dans la base de données?)</div> <?php
}
	
		









	// ------ HEBERGEMENTS ------
	

	// __ Vertification des données
	if(!empty($_P['mysql_port']) && !preg_match("/^[0-9]{2,}$/", $_P['mysql_port'])) {
		?> <div class="alert alert-danger">Le port MySQL n'est pas entré correctement ! <br> Exemple: 3306</div> <?php
		goto NoAddHeberg;
	}

	if(!empty($_P['ftp_port']) && !preg_match("/^[0-9]{2,}$/", $_P['ftp_port'])) {
		?> <div class="alert alert-danger">Le port FTP n'est pas entré correctement ! <br> Exemple: 21</div> <?php
		goto NoAddHeberg;
	}

	if(!CheckIfIsPrix($_P['prix_heberg'])) {
		?> <div class="alert alert-danger">Le prix entré dans le prix de l'hébergeur doit respecter le format ! <br> Exemple: 1234.56 ou 1234.00 ou 1234</div> <?php
		goto NoAddHeberg;
	}





try {
	if(isset($stmt_newid) && !empty($stmt_newid['id'])) {
		$stmt = $pdo->prepare("INSERT INTO Clients_hebergements (id_client, mysql_host, mysql_port, mysql_db, mysql_user, mysql_passw, ftp_host, ftp_port, ftp_user, ftp_passw, url_backoffice, user_backoffice, passw_backoffice, nom_heberg, date_renouv_heberg, prix_heberg) 
			VALUES (:id_client, :mysql_host, :mysql_port, :mysql_db, :mysql_user, :mysql_passw, :ftp_host, :ftp_port, :ftp_user, :ftp_passw, :url_backoffice, :user_backoffice, :passw_backoffice, :nom_heberg, :date_renouv_heberg, :prix_heberg)");
		$stmt->bindValue('id_client', $stmt_newid['id'], PDO::PARAM_INT);
		$stmt->bindValue('mysql_host', $_P['mysql_hote'], PDO::PARAM_STR);
		$stmt->bindValue('mysql_port', $_P['mysql_port'], PDO::PARAM_STR);
		$stmt->bindValue('mysql_db', $_P['mysql_db'], PDO::PARAM_STR);
		$stmt->bindValue('mysql_user', $_P['mysql_user'], PDO::PARAM_STR);
		$stmt->bindValue('mysql_passw', $_P['mysql_passw'], PDO::PARAM_STR);
		$stmt->bindValue('ftp_host', $_P['ftp_hote'], PDO::PARAM_STR);
		$stmt->bindValue('ftp_port', $_P['ftp_port'], PDO::PARAM_INT);
		$stmt->bindValue('ftp_user', $_P['ftp_user'], PDO::PARAM_STR);
		$stmt->bindValue('ftp_passw', $_P['ftp_passw'], PDO::PARAM_STR);
		$stmt->bindValue('url_backoffice', $_P['bo_url'], PDO::PARAM_STR);
		$stmt->bindValue('user_backoffice', $_P['bo_user'], PDO::PARAM_STR);
		$stmt->bindValue('passw_backoffice', $_P['bo_passw'], PDO::PARAM_STR);
		$stmt->bindValue('nom_heberg', $_P['nom_heberg'], PDO::PARAM_STR);
		$stmt->bindValue('date_renouv_heberg', $_P['date_renouv_heberg'], PDO::PARAM_STR);
		$stmt->bindValue('prix_heberg', $_P['prix_heberg'], PDO::PARAM_STR);
		$stmt->execute();

		?> <div class="alert alert-success">Les informations des hébergeurs ont bien été ajoutées ! <?php
	}
} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de l'ajout des informations d'hébergeur. Veuillez réessayer. <br> (Le client existe peut-être déjà dans la base de données?)</div> <?php
}



	NoAddHeberg:

	



}

EndOfSystem:
?>