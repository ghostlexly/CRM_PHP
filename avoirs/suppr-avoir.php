<?php
include("$_SERVER[DOCUMENT_ROOT]/header.php");
if(!CheckSecurity('avoirs')) { exit("Vous n'avez pas accès à cette page."); }


	if(isset($_GET['id'])) {

		$stmt = $pdo->prepare("DELETE FROM Avoirs WHERE id = :id_avoir");
		$stmt->bindValue('id_avoir', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();

		$stmt = $pdo->prepare("DELETE FROM Avoirs_designations WHERE id_avoir = :id_avoir");
		$stmt->bindValue('id_avoir', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();


		// Remettre l'incrémentation à zéro
		$stmt = $pdo->prepare("SELECT COUNT(id) FROM Avoirs");
		$stmt->bindValue('id_avoir', $_GET['id'], PDO::PARAM_INT); // OU PDO::PARAM_INT
		$stmt->execute();
		$stmt = $stmt->fetch();
		$Nbr_facts = $stmt[0]+1;


		$pdo->beginTransaction();
		$pdo->exec("ALTER TABLE Avoirs AUTO_INCREMENT = $Nbr_facts");
		$pdo->commit();
	}
?>
