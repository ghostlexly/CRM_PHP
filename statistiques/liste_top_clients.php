<?php


	$stmt = $pdo->prepare("SELECT id_client, SUM(total_ht) AS total_ht_full FROM Factures WHERE YEAR(date_facture) = YEAR(NOW())  GROUP BY id_client ORDER BY total_ht_full DESC LIMIT 5");
	$stmt->execute();
	$stmt = $stmt->fetchAll();
	foreach  ($stmt as $this_entity) {
			$ClientInfos = GetClientInfos_FromID($this_entity['id_client']);
			$DateAnciennetee = DateDiff_FullText($ClientInfos['date_ajout'], date("Y-m-d"));
?>

			 <tr>
                <td class="text-truncate"><a href="/clients/details-client.php?id=<?php echo $this_entity['id_client']; ?>" target="_blank"><?php echo $ClientInfos['nom_societe']; ?></a></td>
                <td class="text-truncate"><?php echo $DateAnciennetee; ?></td>
                <td class="text-truncate"><?php echo CountFacturesAttenteFromID($this_entity['id_client']); ?></td>
                <td class="text-truncate"><?php echo FormatEuro($this_entity['total_ht_full']); ?></td>
              </tr>

<?php
	}


?>
