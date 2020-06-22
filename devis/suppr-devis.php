<?php
include("$_SERVER[DOCUMENT_ROOT]/header.php");
if(!CheckSecurity('devis')) { exit("Vous n'avez pas accès à cette page."); }


	if(isset($_GET['id'])) {

		$stmt = $pdo->prepare("DELETE FROM Devis WHERE id = :id_devis");
		$stmt->bindValue('id_devis', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();

		$stmt = $pdo->prepare("DELETE FROM Devis_designations WHERE id_devis = :id_devis");
		$stmt->bindValue('id_devis', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();


		// Remettre l'incrémentation à zéro
		$stmt = $pdo->prepare("SELECT COUNT(id) FROM Devis");
		$stmt->bindValue('id_devis', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();
		$stmt = $stmt->fetch();
		$Nbr_facts = $stmt[0]+1;


		$pdo->beginTransaction();
		$pdo->exec("ALTER TABLE Devis AUTO_INCREMENT = $Nbr_facts");
		$pdo->commit();
	}
?>
