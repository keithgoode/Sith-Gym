<?php
/**
 * Sith Gym child theme functions.
 *
 * @package Sith_Gym
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access.
}

/**
 * Enqueue the child theme stylesheet.
 *
 * GeneratePress loads its main stylesheet under the handle `generate-style`,
 * so we declare it as a dependency to ensure parent styles load first.
 */
function sith_gym_enqueue_styles() {
	wp_enqueue_style(
		'sith-gym-style',
		get_stylesheet_uri(),
		array( 'generate-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'sith_gym_enqueue_styles' );
