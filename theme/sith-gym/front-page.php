<?php
/**
 * Front page template.
 *
 * Displays the Sith Gym homepage when a static front page is configured
 * in Settings → Reading. Outputs four sections:
 *
 *   1. Hero         — page title + excerpt + CTA
 *   2. Positioning   — page content from the WordPress editor
 *   3. Latest        — three most recent published posts
 *   4. Closing CTA   — short call to action
 *
 * Content sources:
 *   - Hero headline:    the page title (editable in WP)
 *   - Hero subtitle:    the page excerpt (editable in WP → Screen Options → Excerpt)
 *   - Positioning copy: the page body content (editable in the WP block editor)
 *   - Latest posts:     automatic via WP_Query
 *   - Closing CTA:      hardcoded (edit below if needed)
 *
 * @package Sith_Gym
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main sg-front-page" role="main">

	<?php
	/* ================================================================
	   Section 1: Hero
	   ================================================================
	   Uses the page's featured image as a background (if set).
	   Falls back to the dark primary background when no image is set.
	   ================================================================ */

	$hero_classes = 'sg-hero';
	$hero_style   = '';

	if ( has_post_thumbnail() ) {
		$hero_classes .= ' sg-hero--has-image';
		$hero_image    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$hero_style    = ' style="background-image: url(' . esc_url( $hero_image ) . ');"';
	}
	?>
	<section class="<?php echo esc_attr( $hero_classes ); ?>"<?php echo $hero_style; ?>>
		<div class="sg-hero__inner sg-container">
			<h1 class="sg-hero__title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="sg-hero__subtitle"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>

			<a href="#sg-latest" class="sg-hero__cta">Explore the Work</a>
		</div>
	</section>


	<?php
	/* ================================================================
	   Section 2: Brand Positioning
	   ================================================================
	   Renders the page body content from the WordPress editor.
	   Write your brand positioning copy there — headings, paragraphs,
	   whatever makes sense. This section only renders if the page
	   has content.
	   ================================================================ */

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$page_content = get_the_content();

			if ( ! empty( trim( $page_content ) ) ) :
	?>
	<section class="sg-positioning">
		<div class="sg-positioning__inner sg-container">
			<div class="sg-positioning__content entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
			endif;
		endwhile;
	endif;
	?>


	<?php
	/* ================================================================
	   Section 3: Latest Content
	   ================================================================
	   Pulls the three most recent published posts. If no posts exist
	   yet, this entire section is hidden — no empty grid, no "no
	   posts found" message.
	   ================================================================ */

	$latest_posts = new WP_Query( array(
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	) );

	if ( $latest_posts->have_posts() ) :
	?>
	<section id="sg-latest" class="sg-latest">
		<div class="sg-container">
			<h2 class="sg-section-title">Latest</h2>

			<div class="sg-latest__grid">
				<?php
				while ( $latest_posts->have_posts() ) :
					$latest_posts->the_post();
				?>
				<article class="sg-post-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="sg-post-card__image" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'medium_large' ); ?>
						</a>
					<?php endif; ?>

					<div class="sg-post-card__body">
						<time class="sg-post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>

						<h3 class="sg-post-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php
						$card_excerpt = has_excerpt()
							? get_the_excerpt()
							: wp_trim_words( wp_strip_all_tags( get_the_content() ), 20, '&hellip;' );
						?>
						<p class="sg-post-card__excerpt"><?php echo esc_html( $card_excerpt ); ?></p>
					</div>
				</article>
				<?php endwhile; ?>
			</div>

			<?php
			$blog_page_id = get_option( 'page_for_posts' );
			if ( $blog_page_id ) :
			?>
			<div class="sg-latest__more">
				<a href="<?php echo esc_url( get_permalink( $blog_page_id ) ); ?>">View All Articles &rarr;</a>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
		wp_reset_postdata();
	endif;
	?>


	<?php
	/* ================================================================
	   Section 4: Closing CTA
	   ================================================================
	   Minimal closing statement. Edit the text below directly if the
	   messaging needs to change.
	   ================================================================ */
	?>
	<section class="sg-cta">
		<div class="sg-container">
			<p class="sg-cta__text">The work starts now.</p>
		</div>
	</section>

</main>

<?php
get_footer();
