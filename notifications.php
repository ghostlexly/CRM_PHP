<?php
if(!isset($pdo)) include("$_SERVER[DOCUMENT_ROOT]/header.php");

    $notifications = array();
    $notifications_readed = false;


    // ** Ajouter les notifications d'hébergeur ** //
    $stmt = $pdo->prepare("SELECT h.id_client, h.date_renouv_heberg, h.prix_heberg, c.nom_societe FROM Clients_hebergements AS h
                          INNER JOIN Clients AS c ON c.id = h.id_client
                          WHERE NOW() > DATE_SUB(h.date_renouv_heberg, INTERVAL 6 DAY)
                          ORDER BY date_renouv_heberg DESC");
    $stmt->execute();
    $stmt = $stmt->fetchAll();
    foreach  ($stmt as $hebergement) {

        $notifications[] = array(
          "titre" => sprintf("Expiration de l'hébergement %s", $hebergement['nom_societe']),
          "message" => sprintf("L'hébergement pour la société %s arrive à expiration le %s. Une facture d'un montant de %s est attendue.", $hebergement['nom_societe'], TransformDateFR($hebergement['date_renouv_heberg']), "$hebergement[prix_heberg] €"),
          "id_client" => $hebergement['id_client']
        );

    }



    if(isset($_COOKIE['readed_notifs']) && $notifications == unserialize($_COOKIE['readed_notifs'], ["allowed_classes" => false])) $notifications_readed = true;

    if(isset($_POST['readed_notifs_post'])) {
        setcookie('readed_notifs', serialize($notifications), time() + 365*24*3600, '/', null, false, true);
    }
?>
