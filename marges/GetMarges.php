<?php

// Frais internes
$stmt = $pdo->prepare("SELECT taux_horaire FROM Marges_Config WHERE id = '0'");
$stmt->execute();
$stmt = $stmt->fetch(PDO::FETCH_ASSOC);
$FraisInternes = $stmt['taux_horaire'];


// Liste des intervenants
$List_Intervenants = $pdo->prepare("SELECT * FROM Marges_Config WHERE id <> '0'");
$List_Intervenants->execute();
$List_Intervenants = $List_Intervenants->fetchAll();

?>