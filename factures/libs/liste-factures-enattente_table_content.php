<?php

// -- PAGINATION -- //
$Items_Par_Page = 50;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
if (!ctype_digit($page)) { $page = 1; } $start_from = ($page-1) * $Items_Par_Page;
// ---------------- //

	$stmt_paged = $pdo->prepare("SELECT * FROM Factures WHERE statut = '0' ORDER BY numero_facture DESC LIMIT :start_from, :Items_Par_Page");
  $stmt_paged->bindValue('start_from', $start_from, PDO::PARAM_INT);
  $stmt_paged->bindValue('Items_Par_Page', $Items_Par_Page, PDO::PARAM_INT);
	$stmt_paged->execute();
    $stmt_paged = $stmt_paged->fetchAll();
	foreach  ($stmt_paged as $ent) {
    $ClientInfos = GetClientInfos_FromID($ent['id_client']);
		?>
                        <tr>
                          <td class="sorting_1">
                              <input type="checkbox" class="input-chk">
                          </td>
                          <td title="<?php echo $ent['nom_designation']; ?>"><?php echo LimitTxt($ent['nom_designation'], 14); ?></td>
                          <td title="<?php echo $ClientInfos['nom_societe']; ?>">
                            <a href="/clients/details-client.php?id=<?php echo $ent['id_client']; ?>" target="_blank">
                            <?php echo LimitTxt($ClientInfos['nom_societe'], 14); ?>
                            </a>
                          </td>
                          <td><?php echo TransformDateFR($ent['date_facture']); ?></td>
                          <td><a href="/pdf_gen/pdf_gen.php?ressource=facture&id_facture=<?php echo $ent['id']; ?>" target="_blank"><?php echo $ent['numero_facture']; ?></a></td>
                          <td><?php echo DateDiff_Jours($ent['date_facture'], date('Y-m-d')); ?></td>
                          <td><?php echo number_format($ent['total_ht'], 2, ',', ' '); ?> €</td>
                          <td><?php if($ent['tva_applicable'] == '1') { echo number_format(ConvertTTC($ent['total_ht']), 2, ',', ' ') . " €"; } else { echo "-- €"; } ?></td>
                          <td><?php echo number_format($ent['total_marge'], 2, ',', ' '); ?> €</td>
                          <td>
                            <span class="badge badge-default badge-warning badge-lg">En attente</span>
                          </td>
                          <td>
                            <span class="dropdown">
                              <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                <a href="/factures/modifier-facture.php?id=<?php echo $ent['id']; ?>" class="dropdown-item"><i class="la la-pencil"></i> Modifier</a>
                                <a href="/pdf_gen/pdf_gen.php?ressource=facture&id_facture=<?php echo $ent['id']; ?>" target="_blank" class="dropdown-item"><i class="la la-file-pdf-o"></i> PDF</a>
                                <a href="#/" class="dropdown-item" Onclick="ConfirmDelete(this, 'suppr-facture.php?id=<?php echo $ent['id']; ?>');"><i class="la la-trash"></i> Supprimer</a>
                              </span>
                            </span>
                          </td>
                        </tr>
            <?php              
	}


?>		