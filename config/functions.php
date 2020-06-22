<?php
// ANTI HACK
ob_start();


try {
?>






<?php
function calcul_distance_gps($latitude, $longtitude, $dist) {
	$lat = $latitude; //latitude
	$lon = $longtitude; //longitude
	$distance = $dist; //your distance in KM
	$R = 6371; //constant earth radius. You can add precision here if you wish
	$OUT = array();

	$OUT['maxLat'] = $lat + rad2deg($distance/$R);
	$OUT['minLat'] = $lat - rad2deg($distance/$R);
	$OUT['maxLon'] = $lon + rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
	$OUT['minLon'] = $lon - rad2deg(asin($distance/$R) / cos(deg2rad($lat)));

		return $OUT;
}
?>








<?php
function MenuActiveIfRightPage($pageURL) {
	if(strpos($_SERVER['SCRIPT_NAME'], $pageURL) !== false) {
		return 'active';
	}
	if(strpos($_SERVER['QUERY_STRING'], $pageURL) !== false) {
		return 'active';
	}

	return '';
}
?>



<?php
// Limiter texte et remplacer par des "..." quand ça dépasse
function LimitTxt($text, $limit_char) {
	return mb_strimwidth($text, 0, $limit_char, "..");
}
?>



<?php
function TransformDateFR($engdate) {
	return date("d/m/Y", strtotime($engdate));
}
?>




<?php
function CheckIfIsPrix($amount) {
	if(empty($amount)) { return true; }
	if(!preg_match("/^[0-9-]{1,}[.][0-9-]{2}$/", $amount) && !preg_match("/^[0-9-]{1,}$/", $amount)) {
		return false;
	}
	return true;
}
?>


<?php
function ConvertTTC($amount, $tva_applicable = 1) {
	if($tva_applicable == 0) return $amount;
	return ($amount * (1 + (20 / 100)));
}
?>


<?php
function C_Input_Frm_Post($Post_Name) {
	if(isset($_POST[$Post_Name])) {
		return $_POST[$Post_Name];
	}
}
?>



<?php
function CheckRecaptcha($Response) {
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array('secret' => '6LcxyGYUAAAAAPu2PoLTOBK9gzK5-LnSO2Uyk6HG', 'response' => $Response);

	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ return false; }

	$result = json_decode($result);

	if($result->{'success'} == 'true') { return true; } else { return false; }
}
?>

<?php
function ctype_alnum_FR($text) {
    return (preg_match("/^[\p{L}-0-9 '-?!]*$/u", $text));
}
?>



<?php
function check_tel_number($Num_Tel) { // Prend le + au début (pas obligatoire) et chiffres
	if (preg_match("/^\+?\d+$/", $Num_Tel)) {
		return true;
	} else {
		return false;
	}
}
?>






<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumbers($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>







<?php

Function HASH_MDP($MDP="")
{
	$MDP = md5($MDP);

	$MDP = generateRandomString(44) . $MDP . generateRandomString(36);

	return $MDP;
}

?>
<?php

function unHASH_MDP($MDP="")
{
	$MDP = substr($MDP, 44, (strlen($MDP) - 80)); // 44 - 36 = 80

	return $MDP;
}

?>






<?php

Function HASH_RIB($MDP="")
{
	$MDP = generateRandomNumbers(44) . $MDP . generateRandomNumbers(36);

	return $MDP;
}

?>
<?php

function unHASH_RIB($MDP="")
{
	$MDP = substr($MDP, 44, (strlen($MDP) - 80)); // 44 - 36 = 80

	return $MDP;
}

?>












<?php
function deplacement_fichier($image, $dossier_path, $connexion_ID)
{
    $extension_upload = strtolower(substr(  strrchr($image['name'], '.')  ,1));
    $name = $connexion_ID;
    $nomimage = str_replace(' ','',$name).".".$extension_upload;
    $name = $dossier_path.str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($image['tmp_name'],$name);
    return $nomimage;
}
?>










<?php
function mround($val, $f=2, $d=6){
    return sprintf("%".$d.".".$f."f", $val);
}
?>













<?php
function resultatEnArray($result) {
$rows = array();
while($row = $result->fetch_assoc()) {
$rows[] = $row;
}
return $rows;
}
?>






<?php
function Format_Nbr_Espaces($chiffre) {
	if ($chiffre == NULL) { return "0"; } //anti-bug

	return number_format($chiffre, 0, '', ' ');
}
?>







<?php
// Date Aujourd'hui
		$actual_date = date("d-m-Y H:i:s");
?>















<?php
function Envoyer_Mail_Bienvenue($email_temp_du_user, $nom_d_utilisateur, $mot_de_passe, $c_Nom_Site){


$HTML_INSCRIPTION_CONFIRMEE_MAIL=<<<EOF

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Message de $c_Nom_Site</title>


		<style>	@media only screen and (max-width: 300px){
				body {
					width:218px !important;
					margin:auto !important;
				}
				.table {width:195px !important;margin:auto !important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}
				span.title{font-size:20px !important;line-height: 23px !important}
				span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}
				td.box p{font-size: 12px !important;font-weight: bold !important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 200px!important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
	@media only screen and (min-width: 301px) and (max-width: 500px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 295px !important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}

			}
	@media only screen and (min-width: 501px) and (max-width: 768px) {
				body {width:478px!important;margin:auto!important;}
				.table {width:450px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
			}
	@media only screen and (max-device-width: 480px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}

				.table-recap{width: 295px!important;}
				.table-recap tr td, .conf_body td{text-align:center!important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
</style>







	</head>
	<body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
		<table class="table table-mail" style="width:100%;margin-top:10px;-moz-box-shadow:0 0 5px #afafaf;-webkit-box-shadow:0 0 5px #afafaf;-o-box-shadow:0 0 5px #afafaf;box-shadow:0 0 5px #afafaf;filter:progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5)">
			<tr>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
				<td align="center" style="padding:7px 0">
					<table class="table" bgcolor="#ffffff" style="width:100%">
						<tr>
							<td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
								<a title="$c_Nom_Site" href="http://$_SERVER[HTTP_HOST]" style="color:#337ff1">
									<img src="http://$_SERVER[HTTP_HOST]/img/logo_ouistage.png" width="150" height="110"/>
								</a>
							</td>
						</tr>







<tr>
	<td align="center" class="titleblock" style="padding:7px 0">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title" style="font-weight:500;font-size:28px;text-transform:uppercase;line-height:33px">Bonjour $nom_d_utilisateur,</span><br/>
			<span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Merci d'avoir créé votre compte sur $c_Nom_Site.</span>
		</font>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>







<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
							Vos codes d'accès sur $c_Nom_Site.						</p>


					<span style="color:#777">
							<span style="color:#333"><strong>E-mail:</strong></span> $email_temp_du_user <br />
							<span style="color:#333"><strong>Mot de passe:</strong></span> $mot_de_passe
						</span>
					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>






<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Conseils de sécurité importante :</p>


						<ol style="margin-bottom:0">
							<li>Vos informations de compte doivent rester confidentielles.</li>
							<li>Ne les communiquez jamais à qui que ce soit.</li>
							<li>Changez votre mot de passe régulièrement.</li>
							<li>Si vous pensez que quelqu'un utilise votre compte illégalement, veuillez nous prévenir immédiatement.</li>
						</ol>


					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>









<tr>
	<td class="linkbelow" style="padding:7px 0">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span>Vous pouvez dès a présent vous inscrire pour des stages sur notre site: <a href="http://$_SERVER[HTTP_HOST]" style="color:#337ff1">$c_Nom_Site</a></span>
		</font>
	</td>
</tr>

						<tr>
							<td class="space_footer" style="padding:0!important">&nbsp;</td>
						</tr>

					</table>
				</td>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>


EOF;


mail($email_temp_du_user, "$c_Nom_Site - Confirmation d'inscription", $HTML_INSCRIPTION_CONFIRMEE_MAIL, "Content-Type: text/html; charset=UTF8\r\n");
}
?>











<?php
function Envoyer_Mail_MdpOubliee($email_temp_du_user, $NouveauCodeReinitialisation, $c_Nom_Site){


$HTML_INSCRIPTION_CONFIRMEE_MAIL=<<<EOF

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Message de $c_Nom_Site</title>


		<style>	@media only screen and (max-width: 300px){
				body {
					width:218px !important;
					margin:auto !important;
				}
				.table {width:195px !important;margin:auto !important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}
				span.title{font-size:20px !important;line-height: 23px !important}
				span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}
				td.box p{font-size: 12px !important;font-weight: bold !important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 200px!important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
	@media only screen and (min-width: 301px) and (max-width: 500px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 295px !important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}

			}
	@media only screen and (min-width: 501px) and (max-width: 768px) {
				body {width:478px!important;margin:auto!important;}
				.table {width:450px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
			}
	@media only screen and (max-device-width: 480px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}

				.table-recap{width: 295px!important;}
				.table-recap tr td, .conf_body td{text-align:center!important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
</style>







	</head>
	<body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
		<table class="table table-mail" style="width:100%;margin-top:10px;-moz-box-shadow:0 0 5px #afafaf;-webkit-box-shadow:0 0 5px #afafaf;-o-box-shadow:0 0 5px #afafaf;box-shadow:0 0 5px #afafaf;filter:progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5)">
			<tr>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
				<td align="center" style="padding:7px 0">
					<table class="table" bgcolor="#ffffff" style="width:100%">
						<tr>
							<td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
								<a title="$c_Nom_Site.com" href="http://$_SERVER[HTTP_HOST]" style="color:#337ff1">
									<img src="http://$_SERVER[HTTP_HOST]/img/logo_ouistage.png" width="150" height="110"/>
								</a>
							</td>
						</tr>







<tr>
	<td align="center" class="titleblock" style="padding:7px 0">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title" style="font-weight:500;font-size:28px;text-transform:uppercase;line-height:33px">Bonjour,</span><br/>
			<span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Vous avez demandé à réinitialiser votre mot de passe sur $c_Nom_Site.</span>
		</font>
	    <!--<br><span style="color:#630"><strong>SI VOUS N'ÊTES PAS A L'ORIGINE DE CETTE DEMANDE, IGNOREZ CET MAIL.</strong></span>--></td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>







<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
							Pour réinitialiser votre mot de passe sur $c_Nom_Site, cliquez sur le lien suivant.						</p>


					<span style="color:#777">
							<span style="color:#333"><strong><a href="http://$_SERVER[HTTP_HOST]/connexion/mdp_oublie.php?codereinitialisation=$NouveauCodeReinitialisation">http://$_SERVER[HTTP_HOST]/connexion/mdp_oublie.php?codereinitialisation=$NouveauCodeReinitialisation</a></strong><br />
						</span>
					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>






<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Conseils de sécurité importante :</p>


						<ol style="margin-bottom:0">
							<li>Vos informations de compte doivent rester confidentielles.</li>
							<li>Ne les communiquez jamais à qui que ce soit.</li>
							<li>Changez votre mot de passe régulièrement.</li>
							<li>Si vous pensez que quelqu'un utilise votre compte illégalement, veuillez nous prévenir immédiatement.</li>
						</ol>


					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>

						<tr>
							<td class="space_footer" style="padding:0!important">&nbsp;</td>
						</tr>

					</table>
				</td>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>


EOF;


mail($email_temp_du_user, "$c_Nom_Site - Réinitialisation de mot de passe", $HTML_INSCRIPTION_CONFIRMEE_MAIL, "Content-Type: text/html; charset=UTF8\r\n");
}
?>























<?php
function Envoyer_Mail_ValidationEmail($email_temp_du_user, $NouveauCode, $c_Nom_Site){


$HTML_INSCRIPTION_CONFIRMEE_MAIL=<<<EOF

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Message de $c_Nom_Site</title>


		<style>	@media only screen and (max-width: 300px){
				body {
					width:218px !important;
					margin:auto !important;
				}
				.table {width:195px !important;margin:auto !important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}
				span.title{font-size:20px !important;line-height: 23px !important}
				span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}
				td.box p{font-size: 12px !important;font-weight: bold !important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 200px!important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
	@media only screen and (min-width: 301px) and (max-width: 500px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
				.table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
					display: block !important;
				}
				.table-recap{width: 295px !important;}
				.table-recap tr td, .conf_body td{text-align:center !important;}

			}
	@media only screen and (min-width: 501px) and (max-width: 768px) {
				body {width:478px!important;margin:auto!important;}
				.table {width:450px!important;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
			}
	@media only screen and (max-device-width: 480px) {
				body {width:308px!important;margin:auto!important;}
				.table {width:285px;margin:auto!important;}
				.logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}

				.table-recap{width: 295px!important;}
				.table-recap tr td, .conf_body td{text-align:center!important;}
				.address{display: block !important;margin-bottom: 10px !important;}
				.space_address{display: none !important;}
			}
</style>







	</head>
	<body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
		<table class="table table-mail" style="width:100%;margin-top:10px;-moz-box-shadow:0 0 5px #afafaf;-webkit-box-shadow:0 0 5px #afafaf;-o-box-shadow:0 0 5px #afafaf;box-shadow:0 0 5px #afafaf;filter:progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5)">
			<tr>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
				<td align="center" style="padding:7px 0">
					<table class="table" bgcolor="#ffffff" style="width:100%">
						<tr>
							<td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
								<a title="$c_Nom_Site.com" href="http://$_SERVER[HTTP_HOST]" style="color:#337ff1">
									<img src="http://$_SERVER[HTTP_HOST]/img/logo_ouistage.png" width="150" height="110"/>
								</a>
							</td>
						</tr>







<tr>
	<td align="center" class="titleblock" style="padding:7px 0">
		<font size="2" face="Open-sans, sans-serif" color="#555454">
			<span class="title" style="font-weight:500;font-size:28px;text-transform:uppercase;line-height:33px">Bonjour,</span><br/>
			<span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Vous avez demandé à réinitialiser votre mot de passe sur $c_Nom_Site.</span>
		</font>
	    <!--<br><span style="color:#630"><strong>SI VOUS N'ÊTES PAS A L'ORIGINE DE CETTE DEMANDE, IGNOREZ CET MAIL.</strong></span>--></td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>







<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
							Pour confirmer votre inscription sur $c_Nom_Site, cliquez sur le lien suivant.						</p>


					<span style="color:#777">
							<span style="color:#333"><strong><a href="http://$_SERVER[HTTP_HOST]/compte/libs/inscription_validation_mail.php?code=$NouveauCode">http://$_SERVER[HTTP_HOST]/compte/libs/inscription_validation_mail.php?code=$NouveauCode</a></strong><br />
						</span>
					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>






<tr>
	<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
		<table class="table" style="width:100%">
			<tr>
				<td width="10" style="padding:7px 0">&nbsp;</td>
				<td style="padding:7px 0">


					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<p style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Conseils de sécurité importante :</p>


						<ol style="margin-bottom:0">
							<li>Vos informations de compte doivent rester confidentielles.</li>
							<li>Ne les communiquez jamais à qui que ce soit.</li>
							<li>Changez votre mot de passe régulièrement.</li>
							<li>Si vous pensez que quelqu'un utilise votre compte illégalement, veuillez nous prévenir immédiatement.</li>
						</ol>


					</font>
				</td>
				<td width="10" style="padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="space_footer" style="padding:0!important">&nbsp;</td>
</tr>

						<tr>
							<td class="space_footer" style="padding:0!important">&nbsp;</td>
						</tr>

					</table>
				</td>
				<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>


EOF;


mail($email_temp_du_user, "$c_Nom_Site - Validation de votre inscription", $HTML_INSCRIPTION_CONFIRMEE_MAIL, "Content-Type: text/html; charset=UTF8\r\n");
}
?>






















<?php
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 ||
    (substr($haystack, -$length) === $needle);
}
?>













<?php
function Afficher_Erreur_MSG($Message) {
?>
	   <div class="box-content col-md-12" id="ALERTMESSAGE" style="margin-top: 20px;">
				<center><div class="alert alert-danger">
																<?php echo $Message; ?>
				</div></center>
	   </div>
<?php
}
?>






<?php
function Afficher_OK_MSG($Message) {
?>
	   <div class="box-content col-md-12" id="ALERTMESSAGE" style="margin-top: 20px;">
				<center><div class="alert alert-success">
																<?php echo $Message; ?>
				</div></center>
	   </div>
<?php
}
?>













<?php
function getToken($length){
$d = date ("d");
$m = date ("m");
$y = date ("Y");
$t = time();
$dmt = $d+$m+$y+$t;


$ran = rand(0,10000000);
$dmtran = $dmt+$ran;


$un = uniqid();
$dmtun = $dmt.$un;


$mdun = md5($dmtran.$un);


if ($length > strlen($mdun)) { return $mdun; }
$sort = substr($mdun, 0, $length); // if you want sort length code.

return $sort;
}
?>








<?php
function getTokenOnlyNumbers(){
$d = date ("d");
$m = date ("m");
$y = date ("Y");
$t = time();
$dmt = $d+$m+$y+$t;


$ran = rand(0,10000000);
$dmtran = $dmt+$ran;

return $dmtran;
}
?>














<?php
function FormatEuro($montant) {
return number_format($montant, 2, ",", " ") . " €";
}
?>









<?php
function CheckDateFormat($Date) {
return preg_match("#^[0-9]{2}+[-]+[0-9]{2}+[-]+[0-9]{4}$#" , $Date);
}
?>







<?php
function DateDiff_Jours($from, $to) {
    $from = new DateTime($from);
    $to = new DateTime($to);
    $diff = $to->diff($from);

    if($diff->days == "0") { return "Aujourd'hui"; }

    $txt_Jour = "jour"; if($diff->days <> 1) { $txt_Jour .= 's'; };
    return $diff->days . " $txt_Jour";
}
?>






<?php
function DateDiff_FullText($from, $to, $full = true) {
    $from = new DateTime($from);
    $to = new DateTime($to);
    $diff = $to->diff($from);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'an',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
        	// $k = nbr ET $v = an/mois/semaine etc
            $CreateText = $diff->$k . ' ' . $v;

			if($diff->$k > 1 && $v != 'mois') {
				$CreateText .= 's';
			}

			$v = $CreateText;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    //return $string ? implode(', ', $string) . ' ago' : 'just now';
	return $string ? implode(', ', $string) : 'Il y a quelques instants';
}
?>














<?php
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['PHPSessionClear'])) {
	// @@@ NETTOYAGE POSTS @@@ //
	if(isset($_SESSION['POST'])) {
		unset($_SESSION['POST']);
		echo "SESSION CLEARED!";
	}
}
?>










<?php
$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
?>




<?php
} catch (Exception $e) {
     //echo $e;
     //echo "error";
	 ob_end_clean();
	header("Location: index.php");
}
?>
