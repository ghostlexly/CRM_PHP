<?php // CUSTOM // ?>
<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); ?>
<?php if(!CheckSecurity('tableau_passwords')) { exit("Vous n'avez pas accès à cette page."); } ?>
<?php ob_end_clean(); ?>
<?php // /CUSTOM // ?>

<?php if (!defined('DATATABLES')) exit(); // Ensure being used in DataTables env.

// Enable error reporting for debugging (remove for production)
error_reporting(E_ALL);
ini_set('display_errors', '1');


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Database user / pass
 */
// $sql_details = array(
// 	"type" => "Mysql",     // Database type: "Mysql", "Postgres", "Sqlserver", "Sqlite" or "Oracle"
// 	"user" => "",          // Database user name
// 	"pass" => "",          // Database password
// 	"host" => "", // Database host
// 	"port" => "",          // Database connection port (can be left empty for default)
// 	"db"   => "",          // Database name
// 	"dsn"  => "",          // PHP DSN extra information. Set as `charset=utf8mb4` if you are using MySQL
// 	"pdoAttr" => array()   // PHP PDO attributes array. See the PHP documentation for all options
// );


$sql_details = array(
	"type" => "Mysql",     // Database type: "Mysql", "Postgres", "Sqlserver", "Sqlite" or "Oracle"
	"pdo" => $pdo   // PHP PDO attributes array. See the PHP documentation for all options
);


// This is included for the development and deploy environment used on the DataTables
// server. You can delete this block - it just includes my own user/pass without making
// them public!
if ( is_file($_SERVER['DOCUMENT_ROOT']."/datatables/pdo.php") ) {
	include( $_SERVER['DOCUMENT_ROOT']."/datatables/pdo.php" );
}
// /End development include
