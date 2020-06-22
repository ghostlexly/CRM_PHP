<?php
// ANTI HACK
ob_start();
session_start();


// ERROR REPORTER
function exception_error_handler($errno, $errstr, $errfile, $errline){

$HTML=<<<EOF
Un problème est survenu sur le site internet: <b> $_SERVER[REQUEST_URI] </b> 

<br> <br>

Erreur Numéro: <b> $errno </b> <br>
Erreur Message: <b> $errstr </b> <br>
Erreur dans le fichier: <b> $errfile </b> <br>
Erreur à la ligne: <b> $errline </b> <br>

EOF;

EnCasDerreur($HTML);
 }
 
 
function exception_handler($exception) {
	
$ErreurMessage = $exception->getMessage();	
$Errfile = $exception->getFile();
$Errline = $exception->getLine();
	
$HTML=<<<EOF
Un problème est survenu sur le site internet: <b> $_SERVER[REQUEST_URI] </b> 

<br> <br>

Erreur Message: <b> $ErreurMessage </b> <br>
Erreur dans le fichier: <b> $Errfile </b> <br>
Erreur à la ligne: <b> $Errline </b> <br>

EOF;

EnCasDerreur($HTML);
}

function EnCasDerreur($HTML) {
  mail("clubdedub@gmail.com", "[" . strftime('%d/%m/%y') . "] ALERTE - Erreur PHP -> $_SERVER[HTTP_HOST]", $HTML, "Content-Type: text/html; charset=UTF8\r\n");
  
  ob_end_clean();
  exit("<b>TOUT EST SOUS CONTRÔLE !</b> <br> Un problème est survenu sur cette page. <br> Nos techniciens ont été avertis et ils sont sur le coup !");	
}

set_error_handler('exception_error_handler');
set_exception_handler('exception_handler');
?>







<?php
try {
	//Connexion SQL GENERALE
$opts  = array(PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE); // Modifie le retour de '0' en '1' dans sql 'update' quand le newrow == oldrow
$pdo = new PDO("mysql:host=127.0.0.1;dbname=CRM_DB;charset=utf8", "root_crm", "X2a6g20cG1mApzmx15z6F3z2Cg", $opts);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Trigger fatal erreurs
$pdo->setAttribute(PDO::MYSQL_ATTR_FOUND_ROWS, TRUE); 
$pdo->query("USE CRM_DB");	
	

$DomaineOnly = "$_SERVER[HTTP_HOST]";
	

} catch (Exception $e) {
     //echo $e;
     //echo "error";
	 ob_end_clean();
	 exit("Nous sommes en maintenance. Veuillez réessayer plus tard.");	
	//header("Location: index.php");
}	
?>



<?php include('functions.php'); include('functions.perso.php'); ?>



<?php
ob_end_clean();
?>