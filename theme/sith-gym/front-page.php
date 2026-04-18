<?php
/**
 * Front page template.
 *
 * @package Sith_Gym
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$front_page_id = get_queried_object_id();

$page_title   = get_the_title( $front_page_id );
$page_excerpt = has_excerpt( $front_page_id ) ? get_the_excerpt( $front_page_id ) : '';
$page_content = get_post_field( 'post_content', $front_page_id );
$page_content = apply_filters( 'the_content', $page_content );

$hero_classes = 'sg-hero';
$hero_style   = '';

if ( has_post_thumbnail( $front_page_id ) ) {
	$hero_classes .= ' sg-hero--has-image';
	$hero_image    = get_the_post_thumbnail_url( $front_page_id, 'full' );
	$hero_style    = ' style="background-image: url(' . esc_url( $hero_image ) . ');"';
}
?>

<main id="main" class="site-main sg-front-page" role="main">

	<section class="<?php echo esc_attr( $hero_classes ); ?>"<?php echo $hero_style; ?>>
		<div class="sg-hero__inner sg-container">
			<h1 class="sg-hero__title"><?php echo esc_html( $page_title ); ?></h1>

			<?php if ( ! empty( $page_excerpt ) ) : ?>
				<p class="sg-hero__subtitle"><?php echo esc_html( $page_excerpt ); ?></p>
			<?php endif; ?>

			<a href="#sg-latest" class="sg-hero__cta">Explore the Work</a>
		</div>
	</section>

	<?php if ( ! empty( trim( wp_strip_all_tags( $page_content ) ) ) ) : ?>
	<section class="sg-positioning">
		<div class="sg-positioning__inner sg-container">
			<div class="sg-positioning__content entry-content">
				<?php echo $page_content; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
	$latest_posts = new WP_Query(
		array(
			'posts_per_page'      => 3,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);

	if ( $latest_posts->have_posts() ) :
	?>
	<section id="sg-latest" class="sg-latest">
		<div class="sg-container">
			<h2 class="sg-section-title">Latest</h2>

			<div class="sg-latest__grid">
				<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
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

	<section class="sg-cta">
		<div class="sg-container">
			<p class="sg-cta__text">The work starts now.</p>
		</div>
	</section>

</main>

<?php get_footer(); ?>