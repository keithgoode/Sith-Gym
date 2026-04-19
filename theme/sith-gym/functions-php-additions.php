<?php
/**
 * ============================================================
 *  functions.php — EDIT INSTRUCTIONS
 * ============================================================
 *
 *  This file is NOT a drop-in replacement. It contains the five
 *  snippets from Step 5 with paste-in instructions for each.
 *
 *  Open your existing theme/sith-gym/functions.php and apply the
 *  changes in the order below.
 * ============================================================
 */


/* ============================================================
 * 5a. ADD — Google Fonts enqueue
 * ------------------------------------------------------------
 * WHERE: At the top of the file, immediately after the opening
 *        <?php block and before the first existing function.
 * ============================================================ */

function sith_gym_enqueue_fonts() {
	wp_enqueue_style(
		'sith-gym-fonts',
		'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'sith_gym_enqueue_fonts' );


/* ============================================================
 * 5b. ADD — Editor font loader
 * ------------------------------------------------------------
 * WHERE: Immediately after the 5a hook above.
 * ============================================================ */

function sith_gym_editor_fonts() {
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap' );
}
add_action( 'after_setup_theme', 'sith_gym_editor_fonts' );


/* ============================================================
 * 5c. ADD — Homepage stylesheet enqueue
 * ------------------------------------------------------------
 * WHERE: After the 5b hook.
 * ============================================================ */

function sith_gym_enqueue_homepage_styles() {
	if ( is_front_page() ) {
		wp_enqueue_style(
			'sith-gym-homepage',
			get_stylesheet_directory_uri() . '/sg-homepage.css',
			array( 'sith-gym-style' ),
			wp_get_theme()->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'sith_gym_enqueue_homepage_styles' );


/* ============================================================
 * 5d. REPLACE — sith_gym_sidebar_layout()
 * ------------------------------------------------------------
 * WHERE: Find the existing sith_gym_sidebar_layout() function
 *        in your current file and replace it entirely with the
 *        version below. If you cannot find it, STOP and ask.
 * ============================================================ */

function sith_gym_sidebar_layout( $layout ) {
	if ( is_front_page() || is_single() ) {
		return 'no-sidebar';
	}
	return $layout;
}
add_filter( 'generate_sidebar_layout', 'sith_gym_sidebar_layout' );


/* ============================================================
 * 5e. ADD — Front-page post layout filter
 * ------------------------------------------------------------
 * WHERE: At the very end of the file, before any closing ?> tag
 *        if present (or simply at the bottom if the file has no
 *        closing tag — closing ?> is optional in PHP).
 * ============================================================ */

function sith_gym_front_page_post_layout( $layout ) {
	if ( is_front_page() ) {
		return 'no-paddings';
	}
	return $layout;
}
add_filter( 'generate_post_layout', 'sith_gym_front_page_post_layout' );
