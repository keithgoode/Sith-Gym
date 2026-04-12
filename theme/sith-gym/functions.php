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

/**
 * Force full-width (no sidebar) layout where appropriate.
 *
 * GeneratePress defaults to a content + sidebar layout. We remove the
 * sidebar on:
 *   - Front page:   uses its own full-width template (front-page.php)
 *   - Single posts:  articles use a focused, single-column reading layout
 *
 * Uses GP's `generate_sidebar_layout` filter, which controls the layout
 * on a per-page basis. Return 'no-sidebar' to disable the sidebar.
 */
function sith_gym_sidebar_layout( $layout ) {
	if ( is_front_page() || is_single() ) {
		return 'no-sidebar';
	}
	return $layout;
}
add_filter( 'generate_sidebar_layout', 'sith_gym_sidebar_layout' );

/**
 * Remove GP's default content wrapper on the front page.
 *
 * GP wraps page content in .inside-article with padding. Our front-page
 * template handles its own structure, so we remove GP's content padding
 * to prevent it from interfering with the full-width hero section.
 */
function sith_gym_front_page_content_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'sg-front-page';
	}
	return $classes;
}
add_filter( 'body_class', 'sith_gym_front_page_content_classes' );
