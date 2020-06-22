<?php
declare(strict_types=1);
include_once "$_SERVER[DOCUMENT_ROOT]/src/GoogleAuthenticator/GoogleAuthenticatorInterface.php";
include_once "$_SERVER[DOCUMENT_ROOT]/src/GoogleAuthenticator/FixedBitNotation.php";
include_once "$_SERVER[DOCUMENT_ROOT]/src/GoogleAuthenticator/GoogleAuthenticator.php";
include_once "$_SERVER[DOCUMENT_ROOT]/src/GoogleAuthenticator/GoogleQrUrl.php";
$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();





if(isset($_SESSION['gauth_id']) && isset($_SESSION['gauth_pass'])) {

	$gauth_id = $_SESSION['gauth_id'];
	$gauth_pass = $_SESSION['gauth_pass'];
	$gauth_secret = "";

	// Obtenir clé secrète Google
	$stmt = $pdo->prepare("SELECT googleauthenticator, nom, prenom FROM Users WHERE id = :iduser");
	$stmt->bindValue('iduser', $gauth_id, PDO::PARAM_STR); // OU PDO::PARAM_INT
	$stmt->execute();
	$stmt = $stmt->fetch(PDO::FETCH_ASSOC);

	$Nom_User = strtoupper($stmt['nom']);
	$Prenom_User = ucfirst(strtolower($stmt['prenom']));

	if($stmt['googleauthenticator'] == NULL) {
		//Créer une nouvelle clé
		$gauth_secret = $g->generateSecret();

		$stmt = $pdo->prepare("UPDATE Users SET googleauthenticator = :newsecret WHERE id = :iduser");
		$stmt->bindValue('newsecret', $gauth_secret, PDO::PARAM_STR);
		$stmt->bindValue('iduser', $gauth_id, PDO::PARAM_STR);
		$stmt->execute();

		echo "Votre nouvelle clé Google Authenticator a été générée. Veuillez la scanner à l'aide de l'application Google Authenticator. <br><br> Clé secrète: $gauth_secret <br><br>";
		echo "<center><img src='" . \Sonata\GoogleAuthenticator\GoogleQrUrl::generate("$Nom_User $Prenom_User", $gauth_secret, 'CRM WATS') . "'></center>";

	} else {
		$gauth_secret = $stmt['googleauthenticator'];
	}


	


	if(isset($_POST['auth_code'])) {
		if($_POST['auth_code'] == $g->getCode($gauth_secret)) {
			// CODE OK, GO CONNEXION
			setcookie('AdminRSA', $gauth_id . "|" . $gauth_pass, time() + 24*3600, '/');
			session_destroy();
			header('Location: /index.php');

		} else {
			?> <div class="alert alert-danger">Le code saisie est incorrect !</div> <?php
		}
	}



} else {
	header('Location: login.php');
}

?>