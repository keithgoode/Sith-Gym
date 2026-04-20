<?php
/**
 * Front page template — Sith Gym marketing homepage.
 *
 * Replaces the editorial front-page.php with the full brand identity layout:
 * hero → code tenets → brand positioning → CTA.
 *
 * @package Sith_Gym
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main" role="main">

	<!-- ═══════════════════════════════════════════════
	     SECTION 1: HERO
	     Full-viewport opening. Page title + excerpt
	     pulled from WP admin for easy editing.
	     ═══════════════════════════════════════════════ -->
	<section class="sg-hp-hero" aria-label="Hero">

		<!-- Watermark logo pulled from WP custom logo -->
		<?php
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
		if ( $logo_url ) : ?>
			<div class="sg-hp-hero__watermark" aria-hidden="true">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="">
			</div>
		<?php endif; ?>

		<!-- Scan-line texture overlay -->
		<div class="sg-hp-hero__texture" aria-hidden="true"></div>

		<div class="sg-hp-hero__inner sg-hp-container">
			<?php
			$page_id  = get_queried_object_id();
			$hero_sub = has_excerpt( $page_id )
				? get_the_excerpt( $page_id )
				: __( 'The path to self-mastery starts here.', 'sith-gym' );
			?>
			<h1 class="sg-hp-hero__title">
				DISCIPLINE OVER<br>MOTIVATION
			</h1>
			<p class="sg-hp-hero__subtitle">
				<?php echo esc_html( $hero_sub ); ?>
			</p>
		</div>

		<!-- Bottom edge burn -->
		<div class="sg-hp-hero__fade" aria-hidden="true"></div>
	</section>


	<!-- ═══════════════════════════════════════════════
	     SECTION 2: THE SITH GYM CODE
	     Seven tenets. Editable via WP custom fields
	     (falls back to static copy if ACF/meta absent).
	     ═══════════════════════════════════════════════ -->
	<section class="sg-hp-code" aria-labelledby="sg-code-heading">
		<div class="sg-hp-container sg-hp-container--narrow">

			<h2 class="sg-hp-code__heading" id="sg-code-heading">
				THE SITH GYM CODE
			</h2>

			<?php
			// Pull tenets from post meta (key: sg_code_tenets, JSON array)
			// Falls back to hardcoded defaults so the page always renders.
			$tenets_raw = get_post_meta( $page_id, 'sg_code_tenets', true );
			$tenets     = $tenets_raw ? json_decode( $tenets_raw, true ) : array();

			if ( empty( $tenets ) ) {
				$tenets = array(
					'Peace is a lie. There is only friction.',
					'Through friction, I find focus.',
					'Through focus, I build strength.',
					'Through strength, I gain control.',
					'Through control, I create change.',
					'Through change, I break limitations.',
					'Through discipline, I am free.',
				);
			}
			?>

			<ol class="sg-hp-code__list" role="list">
				<?php foreach ( $tenets as $index => $tenet ) : ?>
				<li class="sg-hp-code__item" style="--sg-item-index: <?php echo esc_attr( $index ); ?>">
					<span class="sg-hp-code__tick" aria-hidden="true"></span>
					<span class="sg-hp-code__text"><?php echo esc_html( $tenet ); ?></span>
				</li>
				<?php endforeach; ?>
			</ol>

		</div>
	</section>


	<!-- ═══════════════════════════════════════════════
	     SECTION 3: BRAND POSITIONING
	     Two-column: image left, statement right.
	     Image: WP featured image. Copy: page content.
	     ═══════════════════════════════════════════════ -->
	<section class="sg-hp-position" aria-label="Brand positioning">
		<div class="sg-hp-container">
			<div class="sg-hp-position__grid">

				<!-- Image column -->
				<div class="sg-hp-position__media">
					<img
						src="https://sithgym.com/wp-content/uploads/2026/04/b2cd0700-7796-4c21-b2db-0424fc19dac9-scaled.jpg"
						class="sg-hp-position__img"
						alt=""
						loading="lazy"
					>
					<div class="sg-hp-position__img-overlay" aria-hidden="true"></div>
				</div>

				<!-- Copy column -->
				<div class="sg-hp-position__copy">
					<h2 class="sg-hp-position__heading">
						Discipline creates control.<br>Control creates freedom.
					</h2>

					<?php
					$page_content = get_post_field( 'post_content', $page_id );
					$page_content = apply_filters( 'the_content', $page_content );

					if ( ! empty( trim( wp_strip_all_tags( $page_content ) ) ) ) :
						echo $page_content;
					else : ?>
						<p>Most people wait to feel ready. They wait for motivation, for the right week, for a better mood, for a version of themselves that does not yet exist.</p>
						<p>Sith Gym is built on a different idea: that strength is forged through action, not emotion. That transformation begins when excuses lose their authority. That the body can be trained, the mind can be sharpened, and a better life can be built through deliberate effort repeated over time.</p>
						<p>This is not about performance. It is about command. Over habit. Over weakness. Over drift.</p>
						<p>The work is not glamorous. It is not easy. It is not instant. It is real.</p>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>


	<!-- ═══════════════════════════════════════════════
	     SECTION 4: CTA
	     Single action. Placeholder href — swap when
	     the enlistment form page is ready.
	     ═══════════════════════════════════════════════ -->
	<section class="sg-hp-cta" aria-label="Call to action">
		<div class="sg-hp-container">
			<h2 class="sg-hp-cta__heading">BEGIN THE WORK.</h2>
			<a href="#" class="sg-hp-cta__btn" aria-label="Begin training at Sith Gym">
				THE WORK STARTS NOW
			</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>
