<?php
if(isset($_POST['user-email'])) {

	$password_reset_hash = generateRandomString(25);


	$stmt = $pdo->prepare("SELECT email FROM Users WHERE email = :useremail");
	$stmt->bindValue('useremail', $_POST['user-email'], PDO::PARAM_STR);
	$stmt->execute();
	
	if ($stmt->rowCount() !== 0) {
		// OK LE MAIL EXISTE ON ENVOI SON MDP
		$stmt = $pdo->prepare("UPDATE Users SET password_reset = :hash_reset WHERE email = :useremail");
		$stmt->bindValue('hash_reset', $password_reset_hash, PDO::PARAM_STR);
		$stmt->bindValue('useremail', $_POST['user-email'], PDO::PARAM_STR);
		$stmt->execute();

		Envoyer_Mail_MdpOubliee($_POST['user-email'], $password_reset_hash, "CRM WATS");
	}


	?> <div class="alert alert-success">Si l'adresse e-mail indiqué existe dans notre base de données, vous allez recevoir un mail d'ici peu.</div> <?php
	
}
?>







<?php
if(isset($_GET['codereinitialisation']) && $_GET['codereinitialisation'] !== '0' && !empty($_GET['codereinitialisation'])) {
	$CodeRes = $_GET['codereinitialisation'];

	$NewPass = generateRandomString(8);


	$stmt = $pdo->prepare("UPDATE Users SET password = :newpass WHERE password_reset = :CodeRes");
	$stmt->bindValue('newpass', HASH_MDP($NewPass), PDO::PARAM_STR);
	$stmt->bindValue('CodeRes', $CodeRes, PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() == 0) {
		?> <div class="alert alert-danger">Ce code de réinitialisation n'est plus valide.</div> <?php
	} else {
		?> <div class="alert alert-success">Bravo, votre nouveau mot de passe est : <b><?php echo $NewPass; ?></b></div> <?php
	}


	//Changer le password_reset
	$stmt = $pdo->prepare("UPDATE Users SET password_reset = :newreset WHERE password_reset = :CodeRes");
	$stmt->bindValue('newreset', '0', PDO::PARAM_STR);
	$stmt->bindValue('CodeRes', $CodeRes, PDO::PARAM_STR);
	$stmt->execute();
	
}
?>