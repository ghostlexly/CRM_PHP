<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); ?>
<?php if(!CheckSecurity('tableau_passwords')) { exit("Vous n'avez pas accès à cette page."); } ?>


<?php
  ob_end_clean();

  // ** GET ALL VALUES ** //
  $stmt = $pdo->prepare("SELECT * FROM tableau_passwords");
  $stmt->execute();
  $stmt = $stmt->fetchAll();

  $tableau_json = array();
  $tableau_json['data'] = array();

  foreach($stmt as $this_key => $this_values) {
        $this_values['DT_RowId'] = $this_values['id']; // Obligatoire primary key pour identify via le plugin editor
        array_push($tableau_json['data'], $this_values);
  }




  echo json_encode($tableau_json);
?>
