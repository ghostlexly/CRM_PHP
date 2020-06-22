<?php
//------------------- FAIRE DES POST SANS POUVOIR REFRESH ---------------->
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND sizeof($_FILES) < 1){
    $_SESSION['POST'] = $_POST;
    unset($_POST);
		if(!empty($_SERVER['QUERY_STRING'])) {
			header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
		} else {
			header('Location:'.$_SERVER['PHP_SELF']);
		}
    exit;
}

if(isset($_SESSION['POST'])) {
	$_POST = $_SESSION['POST'];
	
	//ENLEVER APRES PAGE LOAD
	?>
<script>
$( document ).ready(function() {
	block: {
     while(true){
			$.get("/config/functions.php?PHPSessionClear=dubseven").fail(function() { 
				console.log("Error: Les POSTS n'ont pas pu être nettoyés.");
				continue;
			});
			
			break block;
	 }
   }
});
</script>	
	<?php
}
?>	