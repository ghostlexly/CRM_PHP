<?php
require("$_SERVER[DOCUMENT_ROOT]/config/database.php");


$res = array("packets" => array());
$Liste_ThisYearRev = array();


$stmt = $pdo->prepare("SELECT SUM(ifnull(f.total_ht, 0)) + SUM(DISTINCT ifnull(a.total_ht, 0)) AS total_ht_with_avoirs, f.date_facture
											 FROM Factures f
											 LEFT JOIN Avoirs a ON a.date LIKE :thisYear AND MONTH(a.date) = MONTH(f.date_facture)
											 WHERE f.date_facture LIKE :thisYear
											 GROUP BY MONTH(f.date_facture)
											 ORDER BY f.date_facture ASC");
$stmt->bindValue('thisYear', date("Y") . "-%", PDO::PARAM_STR);
$stmt->execute();
$stmt = $stmt->fetchAll();

foreach  ($stmt as $thisFacture) {
	$Liste_ThisYearRev[] = array("timestamp" => date("M/Y", strtotime($thisFacture['date_facture'])),
		"payloadString" => $thisFacture['total_ht_with_avoirs']);
	}



$res['packets'] = $Liste_ThisYearRev;

if(count($Liste_ThisYearRev) > 0) {
	$res['max_CA'] = max(array_column($Liste_ThisYearRev, 'payloadString'));
} else {
	$res['max_CA'] = 0;
}
echo json_encode($res);

?>
