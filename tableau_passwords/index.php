<?php include("$_SERVER[DOCUMENT_ROOT]/header.php"); include("$_SERVER[DOCUMENT_ROOT]/menus.php"); ?>
<?php if(!CheckSecurity('tableau_passwords')) { exit("Vous n'avez pas accès à cette page."); } ?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Tableau des mots de passe</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index.php">Accueil</a>
                </li>
                <li class="breadcrumb-item active">Tableau des mots de passe
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-head">
                <div class="card-header">
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                      <!-- HEADER CONTENTS HERE -->
                  </div>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <!-- Tableau -->
                  <div class="table-responsive">
                              <table id="tableau_passwords" class="display table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>URL</th>
                                        <th>Nom du site</th>
                                        <th>Utilisateur</th>
                                        <th>Mot de passe</th>
                                        <th>Commentaires</th>
                                    </tr>
                                </thead>
                              </table>


                              <script>
                                    window.onload = function(){
                                            var editor = new $.fn.dataTable.Editor({
                                                ajax:  'api/api_editor.php',
                                                table: '#tableau_passwords',
                                                fields: [
                                            			{
                                            				"label": "URL du site:",
                                            				"name": "URL"
                                            			},
                                            			{
                                            				"label": "Nom du site:",
                                            				"name": "Site"
                                            			},
                                                  {
                                            				"label": "Nom d'utilisateur:",
                                            				"name": "User"
                                            			},
                                                  {
                                            				"label": "Mot de passe:",
                                            				"name": "Password"
                                            			},
                                                  {
                                            				"label": "Commentaires:",
                                            				"name": "Commentaires"
                                            			}
                                            		]
                                            });

                                            // Activate an inline edit on click of a table cell
                                            jQuery('#tableau_passwords').on( 'click', 'tbody td:not(:first-child)', function (e) {
                                                editor.inline( this );
                                            } );


                                            jQuery('#tableau_passwords').DataTable({
                                                ajax: 'api/api.php',
                                                dom: 'Bfrtip',
                                                columns: [
                                                  { data: 'id' },
                                                  { data: 'URL' }, // ** Valeur name in API
                                                  { data: 'Site' },
                                                  { data: 'User' },
                                                  { data: 'Password' },
                                                  { data: 'Commentaires' },
                                                ],
                                                select: true,
                                                buttons: [
                                                    { extend: 'create', editor: editor },
                                                    { extend: 'edit',   editor: editor },
                                                    { extend: 'remove', editor: editor }
                                                ],
                                                language: {
                                                    url: '/app-assets/vendors/js/tables/datatable/fr_FR.json'
                                                },
                                                pageLength: 50
                                            });
                                    }
                              </script>
                  </div>
                  <!--/ Tableau -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



<?php include("$_SERVER[DOCUMENT_ROOT]/footer.php"); ?>
