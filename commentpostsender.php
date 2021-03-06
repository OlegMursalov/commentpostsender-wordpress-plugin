<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/OlegMursalov/
 * @since             1.0.0
 * @package           Commentpostsender
 *
 * @wordpress-plugin
 * Plugin Name:       CommentPostSender
 * Plugin URI:        https://github.com/OlegMursalov/
 * Description:       When somebody comments a post, your partners receive an email
 * Version:           1.0.0
 * Author:            Oleg Mursalov
 * Author URI:        https://github.com/OlegMursalov/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       commentpostsender
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COMMENTPOSTSENDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-commentpostsender-activator.php
 */
function activate_commentpostsender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-commentpostsender-activator.php';
	Commentpostsender_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-commentpostsender-deactivator.php
 */
function deactivate_commentpostsender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-commentpostsender-deactivator.php';
	Commentpostsender_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_commentpostsender' );
register_deactivation_hook( __FILE__, 'deactivate_commentpostsender' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-commentpostsender.php';

require plugin_dir_path(__FILE__) . 'includes/class-config.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_commentpostsender() {
	$plugin = new Commentpostsender();
	$plugin->run();
    add_action('comment_post' , 'sendEmail');
}

add_action('init', 'run_commentpostsender');

function sendEmail($commentId) {
    $newComment = get_comment($commentId);
    $emailList = get_option('comment-post-sender-email-list');
    $emails = explode(",", $emailList);
    for ($i = 0; $i < count($emails); $i++) {
        wp_mail(trim($emails[$i]), 'New comment on web site from ' . $newComment->comment_author, $newComment->comment_content);
    }
}