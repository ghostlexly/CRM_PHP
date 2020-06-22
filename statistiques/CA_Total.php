<?php
require("$_SERVER[DOCUMENT_ROOT]/config/database.php");


$res = array("packets" => array());

$stmt = $pdo->prepare("SELECT SUM(ifnull(f.total_ht, 0)) + SUM(DISTINCT ifnull(a.total_ht, 0)) AS total_ht_with_avoirs, f.date_facture FROM Factures AS f
											 LEFT JOIN Avoirs AS a ON MONTH(a.date) = MONTH(f.date_facture)
											 GROUP BY MONTH(f.date_facture)
											 ORDER BY f.date_facture ASC");
$stmt->execute();
$stmt = $stmt->fetchAll();

foreach  ($stmt as $thisFacture) {
			$Liste_ThisYearRev[] = array("timestamp" => date("M/Y", strtotime($thisFacture['date_facture'])),
				"payloadString" => $thisFacture['total_ht_with_avoirs']);
	}



$res['packets'] = $Liste_ThisYearRev;
$res['max_CA'] = max(array_column($Liste_ThisYearRev, 'payloadString'));
echo json_encode($res);

?>
