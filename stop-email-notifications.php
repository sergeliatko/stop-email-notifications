<?php
/**
 * Stop Email Notifications by Serge Liatko
 *
 * @package     SergeLiatko\StopEmailNotifications
 * @author      Serge Liatko
 * @copyright   2020 Serge Liatko https://sergeliatko.com
 * @license     GPL-3.0+
 *
 * @wordpress-plugin
 * Plugin Name: Stop Email Notifications by Serge Liatko
 * Plugin URI:  https://github.com/sergeliatko/stop-email-notifications.git?utm_source=wordpress&utm_medium=plugin&utm_campaign=stop-email-notifications&utm_content=plugin-link
 * Description: Allows you to disable some email notifications sent by WordPress.
 * Version:     0.0.5
 * Author:      Serge Liatko
 * Author URI:  https://sergeliatko.com?utm_source=wordpress&utm_medium=plugin&utm_campaign=stop-email-notifications&utm_content=author-link
 * Text Domain: stop-email-notifications
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

// do not load this file directly
defined( 'ABSPATH' ) or die( sprintf( 'Please do not load %s directly', __FILE__ ) );

// load namespace
require_once( dirname( __FILE__ ) . '/autoload.php' );

//load settings library
require_once( dirname( __FILE__ ) . '/includes/php/html/autoload.php' );
require_once( dirname( __FILE__ ) . '/includes/php/form-fields/autoload.php' );
require_once( dirname( __FILE__ ) . '/includes/php/wpsettings/autoload.php' );

// load plugin text domain
add_action( 'plugins_loaded', function () {

	load_plugin_textdomain(
		'stop-email-notifications',
		false,
		basename( dirname( __FILE__ ) ) . '/languages'
	);
}, 10, 0 );

// load the plugin
add_action( 'plugins_loaded', array( 'SergeLiatko\StopEmailNotifications\Core', 'getInstance' ), 25, 0 );

