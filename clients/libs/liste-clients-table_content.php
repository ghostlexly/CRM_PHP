<?php

// -- PAGINATION -- //
$Items_Par_Page = 50;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
if (!ctype_digit($page)) { $page = 1; } $start_from = ($page-1) * $Items_Par_Page;
// ---------------- //

	$stmt_paged = $pdo->prepare("SELECT * FROM Clients LIMIT :start_from, :Items_Par_Page");
  $stmt_paged->bindValue('start_from', $start_from, PDO::PARAM_INT);
  $stmt_paged->bindValue('Items_Par_Page', $Items_Par_Page, PDO::PARAM_INT);
	$stmt_paged->execute();
  $stmt_paged = $stmt_paged->fetchAll();
	foreach  ($stmt_paged as $ent) {
		?>
			<tr>
            	<td class="sorting_1">
                <input type="checkbox" class="input-chk">
              </td>

                <td>
                	<a href="details-client.php?id=<?php echo $ent['id']; ?>"><?php echo $ent['nom_societe']; ?></a>
                </td>

                <td><?php echo $ent['nom_interlocuteur']; ?></td>

                <td>
                	<a href="mailto:<?php echo $ent['email']; ?>"><?php echo $ent['email']; ?></a>
                </td>

                <td><?php echo $ent['numero_fixe']; ?></td>

                <td><?php echo $ent['numero_portable']; ?></td>


                <td>
                  <span class="dropdown">
                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
	                            	<span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                      <a href="details-client.php?id=<?php echo $ent['id']; ?>" class="dropdown-item"><i class="la la-pencil"></i> Modifier</a>
	                                </span>
                   </span>
                </td>


      </tr>
            <?php              
	}


?>		