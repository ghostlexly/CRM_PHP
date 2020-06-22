<?php

if(isset($_GET['id'])) {

	$stmt = $pdo->prepare("SELECT * FROM Devis WHERE id_client = :thisid ORDER BY date_devis DESC");
	$stmt->bindValue('thisid', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();
    $stmt = $stmt->fetchAll();


	foreach  ($stmt as $devis) {
	?>

	<tr>
        <td title="<?php echo $devis['nom_designation']; ?>"><a href="/devis/modifier-devis.php?id=<?php echo $devis['id']; ?>" class="text-bold-600"><?php echo LimitTxt($devis['nom_designation'], 15); ?></a></td>

        <td><?php echo $devis['numero_devis']; ?></td>

        <td>
        	<?php
        	if($devis['statut'] == 0) {
        		echo "<span class='badge badge-default badge-warning badge-lg'>En attente</span>";
	        } elseif($devis['statut'] == 1) {
	        	echo "<span class='badge badge-default badge-success badge-lg'>Validé</span>";
					} elseif($devis['statut'] == 2) {
	        	echo "<span class='badge badge-default badge-danger badge-lg'>Refusé</span>";	
	        } else {
	        	echo "<span class='badge badge-default badge-info badge-lg'>Archivé</span>";
	        }
        	 ?>
        </td>

        <td><?php echo number_format($devis['total_ht'], 2, ',', ' '); ?> €</td>

        <td>
	      <span class="dropdown">
            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
								<a href="/devis/modifier-devis.php?id=<?php echo $devis['id']; ?>" class="dropdown-item"><i class="la la-pencil"></i> Modifier</a>
                <a href="/pdf_gen/pdf_gen.php?ressource=devis&id_devis=<?php echo $devis['id']; ?>" target="_blank" class="dropdown-item"><i class="la la-file-pdf-o"></i> PDF</a>
                <a href="#" Onclick="ConfirmDelete(this, '/devis/suppr-devis.php?id=<?php echo $devis['id']; ?>');" class="dropdown-item"><i class="la la-trash"></i> Supprimer</a>
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
