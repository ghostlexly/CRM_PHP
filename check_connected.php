<?php
if (isset($_COOKIE['AdminRSA']) AND $_COOKIE['AdminRSA']!=="0") {

// Vérifier que le mdp correspond au connexion_id dans le cookie  ==>   (connexion_id|mdp)	<== cookie
//Couper le cookie en 2 parties
list($ConnexionID_Cookie, $password_hashed_Cookie) = explode('|', $_COOKIE['AdminRSA']);

	$UserInfos = $pdo->prepare("SELECT * FROM Users WHERE id = :idcookie AND password = :passcookie");
	$UserInfos->bindValue('idcookie', $ConnexionID_Cookie, PDO::PARAM_STR);
	$UserInfos->bindValue('passcookie', $password_hashed_Cookie, PDO::PARAM_STR);
	$UserInfos->execute();

		if ($UserInfos->rowCount() == 0) {
	      		header('Location: /connexion/login.php');
	      		exit("Vous n'êtes pas connecté !");
	      	}

	$UserInfos = $UserInfos->fetch(PDO::FETCH_ASSOC);
	if(!isset($UserInfos['security_levels']) || !is_string($UserInfos['security_levels']) || empty($UserInfos['security_levels'])) $UserInfos['security_levels'] = array();
	$UserSecurity = unserialize($UserInfos['security_levels']);

} else {
	header('Location: /connexion/login.php');
	exit("Vous n'êtes pas connecté !");
}
?>
