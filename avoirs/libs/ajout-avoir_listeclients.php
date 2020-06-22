<?php

$stmt = $pdo->prepare("SELECT * FROM Clients ORDER BY nom_societe ASC");
$stmt->execute();
$stmt = $stmt->fetchAll();
foreach  ($stmt as $client) {
	echo "<option value='$client[id]'>$client[nom_societe]</option>";
}

?>


<script>
$(function() {
	$("[name='choix_client']").change(function() {
		var ID_Selected = $("[name='choix_client']").val();
		window.location.href = "ajout-avoir.php?idclient=" + ID_Selected;
	});
});
</script>
