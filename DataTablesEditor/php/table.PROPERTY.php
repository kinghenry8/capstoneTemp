<?php

/*
 * Editor server script for DB table PROPERTY
 * Automatically generated by http://editor.datatables.net/generator
 */

// DataTables PHP library
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Validate;


// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'PROPERTY','PROPID' )
	->fields(
		Field::inst( 'BLOCK' ),
		Field::inst( 'LOT' ),
		Field::inst( 'WARD' ),
		Field::inst( 'ADDRNUM' ),
		Field::inst( 'STREET' ),
		Field::inst( 'CITY' ),
		Field::inst( 'ZIP' ),
		Field::inst( 'STATE' ),
		Field::inst( 'BOARDED' ),
		Field::inst( 'PDESC' ),
		Field::inst( 'LCOMMENT' )
	)
	->process( $_POST )
	->json();

