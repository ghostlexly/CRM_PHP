<?php
include("$_SERVER[DOCUMENT_ROOT]/header.php");
if(!CheckSecurity('factures')) { exit("Vous n'avez pas accès à cette page."); }


	if(isset($_GET['id'])) {

		$stmt = $pdo->prepare("DELETE FROM Factures WHERE id = :id_facture");
		$stmt->bindValue('id_facture', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();

		$stmt = $pdo->prepare("DELETE FROM Factures_designations WHERE id_facture = :id_facture");
		$stmt->bindValue('id_facture', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();


		$stmt = $pdo->prepare("DELETE FROM Marges_DB WHERE id_facture = :id_facture");
		$stmt->bindValue('id_facture', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();


		$stmt = $pdo->prepare("DELETE FROM Marges_externalisation WHERE id_facture = :id_facture");
		$stmt->bindValue('id_facture', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();


		// Remettre l'incrémentation à zéro
		$stmt = $pdo->prepare("SELECT COUNT(id) FROM Factures");
		$stmt->bindValue('id_facture', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();
		$stmt = $stmt->fetch();
		$Nbr_facts = $stmt[0]+1;


		$pdo->beginTransaction();
		$pdo->exec("ALTER TABLE Factures AUTO_INCREMENT = $Nbr_facts");
		$pdo->commit();
	}
?>
