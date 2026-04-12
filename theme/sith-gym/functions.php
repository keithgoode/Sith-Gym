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

/**
 * Register editor styles.
 *
 * Loads the child theme stylesheet inside the block editor so that authors
 * see dark backgrounds, brand typography, and accent colors while editing.
 * WordPress automatically scopes the rules under .editor-styles-wrapper.
 */
function sith_gym_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'sith_gym_editor_styles' );
