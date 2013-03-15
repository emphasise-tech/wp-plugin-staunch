<?php
/*
Plugin Name: Staunch
Plugin URI: https://github.com/bigfishdesign/staunch
Description: Remove update roles from admin users so updates cannot be done on a live system.
Version: 2.0
Author: Scott Cariss
Author URI: http://l3rady.com
*/

// Stop direct access
!defined( 'ABSPATH' ) and exit;

// If not defined then by default set to FALSE
if ( !defined( "CAN_UPDATE" ) ) {
	define( "CAN_UPDATE", FALSE );
}

// Disable the WP file editor.
if ( !CAN_UPDATE && !defined( "DISALLOW_FILE_EDIT" ) ) {
	define( "DISALLOW_FILE_EDIT", TRUE );
}

function bf_staunch_remove_roles_on_live( $caps, $cap, $user_id, $args ) {

	if ( $cap === "update_core" ) {
		$caps[] = 'do_not_allow';
		return $caps;
	}

	if ( CAN_UPDATE ) {
		return $caps;
	}

	$caps_to_disabled = array(
		'update_plugins',
		'update_themes',
		'install_plugins',
		'install_themes',
		'delete_plugins',
		'delete_themes',
		'edit_plugins',
		'edit_themes'
	);

	if ( in_array( $cap, $caps_to_disabled ) ) {
		$caps[] = 'do_not_allow';
	}

	return $caps;
}

add_filter('map_meta_cap', 'bf_staunch_remove_roles_on_live', 10, 4);