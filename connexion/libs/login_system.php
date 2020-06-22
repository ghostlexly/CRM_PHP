<?php
if(isset($_POST['user-name']) && isset($_POST['user-password'])) {

	//Recaptcha
	if(isset($_POST['g-recaptcha-response'])) {
		if(CheckRecaptcha($_POST['g-recaptcha-response']) == false) {
			?> <div class="alert alert-danger">Vous avez tenté de tricher sur le reCaptcha !</div> <?php
			exit();
		}
	} else {
		?> <div class="alert alert-danger">Vous avez tenté de tricher sur le reCaptcha !</div> <?php
		exit();
	}

	$stmt = $pdo->prepare("SELECT id, password FROM Users WHERE username = :username");
	$stmt->bindValue('username', $_POST['user-name'], PDO::PARAM_STR); // OU PDO::PARAM_INT
	$stmt->execute();
	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$MDP_Decryptee = unHASH_MDP($stmt['password']);
	if($MDP_Decryptee == md5($_POST['user-password'])) {


		
		// CONNEXION OK
		$_SESSION['gauth_id'] = $stmt['id'];
		$_SESSION['gauth_pass'] = $stmt['password'];
		header('Location: 2fa_auth.php');

	} else {
		?> <div class="alert alert-danger">Identifiant ou mot de passe incorrect !</div> <?php
	}
}
?>