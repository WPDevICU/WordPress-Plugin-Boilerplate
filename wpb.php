<?php
/**
 * WordPress Plugin Boilerplate
 *
 * @package           WordPressPluginBoilerplate
 * @author            TheNameSpace
 * @copyright         2022 TheNameSpace
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        https://wordpress.org/plugins/wpb/
 * Description:       The awesome plugin.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.3
 * Author:            TheNameSpace
 * Author URI:        https://TheNameSpace.com
 * Text Domain:       wpb
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://wordpress.org/plugins/wpb/
 */

/*
WordPress Plugin Boilerplate is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

WordPress Plugin Boilerplate is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress Plugin Boilerplate. If not, see http://www.gnu.org/licenses/gpl-2.0.txt
*/

use TheNameSpace\WordPressPluginBoilerplate\WordPressPluginBoilerplate;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

if ( ! defined( 'WPB_FILE' ) ) {
	define( 'WPB_FILE', __FILE__ );
}

if ( ! defined( 'WPB_DIR' ) ) {
	define( 'WPB_DIR', __DIR__ );
}

if ( ! defined( 'WPB_VERSION' ) ) {
	define( 'WPB_VERSION', '1.0.0' );
}

/**
 * WordPress Plugin Boilerplate main function
 *
 * @since WPB_SINCE
 *
 * @return WordPressPluginBoilerplate
 */
function WPB(): WordPressPluginBoilerplate {
	return WordPressPluginBoilerplate::get_instance();
}
WPB();
