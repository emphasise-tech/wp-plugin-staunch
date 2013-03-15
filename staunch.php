<?php
/*
Plugin Name: Staunch
Plugin URI: https://github.com/bigfishdesign/staunch
Description: Remove update roles from admin users so updates cannot be done on a live system.
Version: 1.0
Author: Scott Cariss
Author URI: http://l3rady.com
*/

// Stop direct access
! defined( 'ABSPATH' ) and exit;

function bf_staunch_remove_roles_on_live()
{
	// If not defined then by default set to FALSE
	if( ! defined( "CAN_UPDATE" ) ) {
		define( "CAN_UPDATE", FALSE );
	}

	$can_update = ( CAN_UPDATE ) ? "true" : "false";
	$setting = get_option("bf_staunch_can_update");

	if( $can_update === $setting ) {
		return;
	}

	$role_obj = get_role( "administrator" );

	// Did we fail to get admin role?
	if( ! $role_obj ) {
		return;
	}

	if( CAN_UPDATE === TRUE )
	{
		$role_obj->add_cap( "install_plugins" );
		$role_obj->add_cap( "update_plugins" );
		$role_obj->add_cap( "delete_plugins" );
		$role_obj->add_cap( "install_themes" );
		$role_obj->add_cap( "update_themes" );
		$role_obj->add_cap( "delete_themes" );

		update_option( "bf_staunch_can_update", "true" );
	} else
	{
		$role_obj->remove_cap( "install_plugins" );
		$role_obj->remove_cap( "update_plugins" );
		$role_obj->remove_cap( "delete_plugins" );
		$role_obj->remove_cap( "install_themes" );
		$role_obj->remove_cap( "update_themes" );
		$role_obj->remove_cap( "delete_themes" );

		update_option( "bf_staunch_can_update", "false" );
	}

	// Never allow WP core update via auto update.
	// WP setup as git sub module and should be updated via
	// git fetch --tags
	// git checkout {desired version}
	$role_obj->remove_cap( "update_core" );
}
add_action( "init", "bf_staunch_remove_roles_on_live" );