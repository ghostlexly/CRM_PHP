<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('clients')) { exit("Vous n'avez pas accès à cette page."); } ?>

<?php
      $stmt = $pdo->prepare("SELECT c.id, c.nom_societe, h.* FROM Clients as c
      INNER JOIN Clients_hebergements as h ON h.id_client = c.id");
      $stmt->execute();
      $data_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if(file_exists("extractions/export_data.zip")) unlink("extractions/export_data.zip");
      if(file_exists("extractions/tmp_file.csv")) unlink("extractions/tmp_file.csv");
      file_put_contents("extractions/tmp_file.csv",
                              iconv("UTF-8", "UTF-16LE", "ID Client;Nom de la société;MySQL Host;MySQL Port;MySQL DB;MySQL User;MySQL Password;FTP Host;FTP Port;FTP User;FTP Password;Backoffice URL;Backoffice User;Backoffice Password;Nom d'hébergement;" . "\r\n"), FILE_APPEND);


      foreach($data_list as $this_data) {
            file_put_contents("extractions/tmp_file.csv",
                                    iconv("UTF-8", "UTF-16LE", "$this_data[id];$this_data[nom_societe];$this_data[mysql_host];$this_data[mysql_port];$this_data[mysql_db];$this_data[mysql_user];$this_data[mysql_passw];$this_data[ftp_host];$this_data[ftp_port];$this_data[ftp_user];$this_data[ftp_passw];$this_data[url_backoffice];$this_data[user_backoffice];$this_data[passw_backoffice];$this_data[nom_heberg];" . "\r\n"), FILE_APPEND);
      }


      shell_exec("zip --encrypt -P WatsAgency2019 extractions/export_data.zip extractions/tmp_file.csv");
      if(file_exists("extractions/tmp_file.csv")) unlink("extractions/tmp_file.csv");
?>




<meta http-equiv="refresh" content="2;URL=extractions/export_data.zip">


<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Extraction de données</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item"><a href="liste-clients.php">Clients</a>
                </li>
                <li class="breadcrumb-item active">Extraction
                </li>
              </ol>
            </div>
          </div>
        </div>

      </div>




      <div class="content-body">
        <section id="horizontal-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form class="form form-horizontal">
                      <div class="form-body">
                        <h1>
                              Le mot de passe de l'archive est <font color="red">WatsAgency2019</font>
                        </h1>
                        Ce document contient des données hautement sensibles. <br>
                        Vous êtes responsable de ce fichier. Veuillez à ne pas vous en servir dans des environnements non-sécurisés et à ne pas communiquer ce mot de passe oralement.
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
