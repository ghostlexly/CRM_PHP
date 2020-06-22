<?php


if(isset($_POST['nom_societe']) && isset($_POST['nom_interlocuteur']) && isset($_POST['adresse_facturation']) && isset($_POST['adresse_email'])) {

	$_P = $_POST;


	//------- VERIFICATION DES DONNÉES ---------//
	if(Verification_des_Donnees($_P) == true) { goto EndOfSystem; }




// METTRE LES VALEURS DU POST EN NULL POUR LA BD
function drop_empty($var)
{
  return ($var === '') ? NULL : $var;
}
	$_P = array_map('drop_empty', $_P);




try {
	$stmt = $pdo->prepare("UPDATE Clients SET nom_societe = :nom_societe, nom_interlocuteur = :nom_interlocuteur, email = :email, adresse_facturation = :adresse_facturation, numero_fixe = :numero_fixe, numero_portable = :numero_portable, siret = :siret, tva = :tva, echeance_paiement = :echeance_paiement, infos_compl = :infos_compl, date_ajout = :date_ajout WHERE id = :clientid");
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
	$stmt->bindValue('clientid', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();

	?> <div class="alert alert-success">Le client a été modifié avec succès !</div> <?php

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
		$stmt = $pdo->prepare("REPLACE INTO Clients_hebergements (id_client, mysql_host, mysql_port, mysql_db, mysql_user, mysql_passw, ftp_host, ftp_port, ftp_user, ftp_passw, url_backoffice, user_backoffice, passw_backoffice, nom_heberg, date_renouv_heberg, prix_heberg) 
			VALUES (:id_client, :mysql_host, :mysql_port, :mysql_db, :mysql_user, :mysql_passw, :ftp_host, :ftp_port, :ftp_user, :ftp_passw, :url_backoffice, :user_backoffice, :passw_backoffice, :nom_heberg, :date_renouv_heberg, :prix_heberg)");
		$stmt->bindValue('id_client', $_GET['id'], PDO::PARAM_INT);
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

		?> <div class="alert alert-success">Les informations des hébergeurs ont bien été ajoutées ! </div> <?php
} catch (PDOException $e) {
	file_put_contents("log_wats.log", date("d-m-Y H:i:s") . " -> " . $e->getMessage() . "\r\n", FILE_APPEND);
	?> <div class="alert alert-danger">Un problème est survenu lors de l'ajout des informations d'hébergeur. Veuillez réessayer.</div> <?php
}



	NoAddHeberg:






		

	



}

EndOfSystem:
?>