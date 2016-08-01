<?php
/**
 * Plugin Name: f(x) Share
 * Plugin URI: http://genbu.me/plugins/fx-share/
 * Description: Simple sharing plugin. Easily add Facebook, Twitter, and Google+ share button to your content.
 * Version: 1.0.0
 * Author: David Chandra Purnama
 * Author URI: http://shellcreeper.com/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/* Plugin Version. */
define( 'FX_SHARE_VERSION', '1.0.0' );

/* Path to plugin directory. */
define( 'FX_SHARE_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/* Plugin URL. */
define( 'FX_SHARE_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/* Load it on init */
add_action( 'plugins_loaded', 'fx_share_load' );

/**
 * Do Stuff.
 * @since 0.1.0
 */
function fx_share_load(){

	/* Load Functions  */
	require_once( FX_SHARE_PATH . 'includes/functions.php' );

	/* Load Customizer Settings */
	require_once( FX_SHARE_PATH . 'includes/customizer.php' );

	/* Load Sanitize Functions */
	require_once( FX_SHARE_PATH . 'includes/sanitize.php' );

	/* Load Setup Functions */
	require_once( FX_SHARE_PATH . 'includes/setup.php' );

}