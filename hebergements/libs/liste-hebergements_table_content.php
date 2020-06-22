<?php

// -- PAGINATION -- //
$Items_Par_Page = 50;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
if (!ctype_digit($page)) { $page = 1; } $start_from = ($page-1) * $Items_Par_Page;
// ---------------- //

	$stmt_paged = $pdo->prepare("SELECT * FROM Clients_hebergements WHERE date_renouv_heberg IS NOT NULL ORDER BY date_renouv_heberg ASC LIMIT :start_from, :Items_Par_Page");
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
                          <td title="<?php echo $ClientInfos['nom_societe']; ?>">
                            <a href="/clients/details-client.php?id=<?php echo $ent['id_client']; ?>" target="_blank">
                            <?php echo LimitTxt($ClientInfos['nom_societe'], 14); ?>
                            </a>
                          </td>
                          <td><?php echo $ent['nom_heberg']; ?></td>
                          <td><?php echo TransformDateFR($ent['date_renouv_heberg']); ?></td>
                          <td><?php if(strtotime($ent['date_renouv_heberg']) > strtotime("NOW")) { echo DateDiff_FullText(date('Y-m-d'), $ent['date_renouv_heberg'], false); } else { echo "Dépassée"; } ?></td>
                          <td><?php echo FormatEuro($ent['prix_heberg']); ?></td>
                          <td>
                            <span class="dropdown">
                              <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                <a href="#/" class="dropdown-item" OnClick="AjaxPOST_Notify(this, 'Renouvelé avec succès ! - Renouvellement dans 1 Mois.', 'action_update_heberg.php?id=<?php echo $ent['id']; ?>&type=0'); Nettoyer_Cases_TableHebergs(this);"><i class="la la-calendar"></i> Pour 1 mois</a>
                                <a href="#/" class="dropdown-item" OnClick="AjaxPOST_Notify(this, 'Renouvelé avec succès ! - Renouvellement dans 1 An.', 'action_update_heberg.php?id=<?php echo $ent['id']; ?>&type=1'); Nettoyer_Cases_TableHebergs(this);"><i class="la la-calendar"></i> Pour 1 an</a>
                              </span>
                            </span>
                          </td>
                        </tr>
            <?php
	}


?>
