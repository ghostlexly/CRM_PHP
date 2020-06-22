<?php

if(isset($_GET['id'])) {

	$stmt = $pdo->prepare("SELECT * FROM Factures WHERE id_client = :thisid ORDER BY date_facture DESC");
	$stmt->bindValue('thisid', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();
  $stmt = $stmt->fetchAll();


	foreach  ($stmt as $facture) {
	?>

	<tr>
        <td title="<?php echo $facture['nom_designation']; ?>"><a href="/factures/modifier-facture.php?id=<?php echo $facture['id']; ?>" class="text-bold-600"><?php echo LimitTxt($facture['nom_designation'], 15); ?></a></td>
        <td><?php echo $facture['numero_facture']; ?></td>
        <td>
          <?php
        	if($facture['statut'] == 0) {
        		echo "<span class='badge badge-default badge-warning badge-lg'>En attente</span>";
	        } elseif($facture['statut'] == 1) {
	        	echo "<span class='badge badge-default badge-success badge-lg'>Payée</span>";
					} elseif($facture['statut'] == 2) {
		        	echo "<span class='badge badge-default badge-danger badge-lg'>Suspendue</span>";
	        }
        	 ?>
        </td>
        <td><?php echo number_format($facture['total_ht'], 2, ',', ' '); ?> €</td>
        <td>
          <span class="dropdown">
            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                <a href="/factures/modifier-facture.php?id=<?php echo $facture['id']; ?>" class="dropdown-item"><i class="la la-pencil"></i> Modifier</a>
                <a href="/pdf_gen/pdf_gen.php?ressource=facture&id_facture=<?php echo $facture['id']; ?>" target="_blank" class="dropdown-item"><i class="la la-file-pdf-o"></i> PDF</a>
                <a href="#" Onclick="ConfirmDelete(this, '/factures/suppr-facture.php?id=<?php echo $facture['id']; ?>');" class="dropdown-item"><i class="la la-trash"></i> Supprimer</a>
              </span>
          </span>
        </td>
    </tr>

	<?php
	}



} else {
	?> <div class="alert alert-danger">Il n'y a pas d'ID de client défini dans les paramètres !</div> <?php
	exit();
}

?>
