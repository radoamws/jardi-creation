<?php
/**
 * Plugin Name: Local Dev Overrides
 * Description: Désactive les plugins réservés à la production quand WP_ENVIRONMENT_TYPE vaut "local". Sans effet en production.
 * Author: Dev
 */

if ( ! function_exists( 'wp_get_environment_type' ) || 'local' !== wp_get_environment_type() ) {
	return;
}

/** Plugins neutralisés en local (non modifiés en base : simple filtre à la volée). */
const JC_LOCAL_DISABLED_PLUGINS = array(
	'really-simple-ssl/rlrsssl-really-simple-ssl.php',     // force HTTPS -> boucle sur localhost
	'tenweb-speed-optimizer/tenweb_speed_optimizer.php',   // cache / réécriture HTML liée au domaine prod
	'wordfence/wordfence.php',                             // pare-feu
	'all-in-one-wp-security-and-firewall/wp-security.php', // pare-feu
	'updraftplus/updraftplus.php',                         // sauvegardes distantes
	'imagify/imagify.php',                                 // optimisation via API
	'google-site-kit/google-site-kit.php',                 // lié au domaine prod
	'ga-google-analytics/ga-google-analytics.php',         // évite de polluer les stats
	'advanced-google-recaptcha/advanced-google-recaptcha.php', // clés liées au domaine prod
	'wp-smtp/wp-smtp.php',                                 // évite les envois réels
	'akismet/akismet.php',
);

add_filter( 'option_active_plugins', static function ( $plugins ) {
	return is_array( $plugins ) ? array_values( array_diff( $plugins, JC_LOCAL_DISABLED_PLUGINS ) ) : $plugins;
}, 1 );

// Aucun e-mail réel ne part en local.
add_filter( 'pre_wp_mail', '__return_true' );

// La validation reCAPTCHA v2 custom (Divi/functions.php) échoue hors du domaine de prod : on la retire en local.
add_action( 'after_setup_theme', static function () {
	remove_filter( 'wpcf7_validate', 'valider_recaptcha_v2_cf7', 10 );
}, 99 );
