<?php
if(isset($_GET['idclient'])) {

      $stmt = $pdo->prepare("SELECT * FROM Factures WHERE id_client = :id_client ORDER BY id ASC");
      $stmt->bindValue('id_client', $_GET['idclient'], PDO::PARAM_STR);
      $stmt->execute();
      $stmt = $stmt->fetchAll();
      foreach  ($stmt as $facture) {
      	echo "<option value='$facture[id]'>$facture[nom_designation] - $facture[numero_facture] - $facture[total_ht] €</option>";
      }

}
?>
