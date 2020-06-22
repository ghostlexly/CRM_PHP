<?php
include("../lib/DataTables.php"); // edit file (lib/config.php)
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;


$editor = Editor::inst( $db, 'tableau_passwords', 'id') // $db , $table_name, $primary_key_name !important
->fields(
         Field::inst( 'id' ), // primary key !important
         Field::inst( 'URL' )->validator('Validate::notEmpty' ), // $column_name -> validator
         Field::inst( 'Site' )->validator('Validate::notEmpty' ),
         Field::inst( 'User' )->validator('Validate::notEmpty' ),
         Field::inst( 'Password' )->validator('Validate::notEmpty' ),
         Field::inst( 'Commentaires' )
    )
    ->process( $_POST )
    ->json();
