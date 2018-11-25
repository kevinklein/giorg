<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

get_header();
?>

<div class="row m-b-lg">

	<div id="primary" class="content-area col-md-9 col-xs-12">

		<div class="row">

			<div class="col-md-2 col-xs-12">
				<ins class="dcmads" style="display: inline-block; width: 160px; height: 600px;" data-dcm-placement="N5215.276416AMERICANJOURNALOFGAS/B20595770.211956287" data-dcm-rendering-mode="iframe" data-dcm-https-only="" data-dcm-resettable-device-id="" data-dcm-app-id="">
				<script src='https://www.googletagservices.com/dcm/dcmads.js'></script>
				</ins>
			</div>

			<main id="main" class="site-main col-md-10 col-xs-12 p-l-lg">

				<div class="bg-gray-lighter m-b-lg position-relative p-t-md">
		
					<div class="swiper-container posts-latest p-b-lg">
						<div class="swiper-wrapper">
						<?php
						$args = array( 
							'post__not_in' => get_option( 'sticky_posts' ), 
							'posts_per_page' => 4,
							'tags' => 'featured',
						);
						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) {
							//echo '<div id="cycle-main">';
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>
								<a class="swiper-slide link-block display-block" href="<?php the_permalink(); ?>" rel="bookmark">
									<div class="p-x-xl">
										<div class="row">
											<div class="col-md-5 col-xs-12 text-center">
												<?php the_post_thumbnail( 'medium' ); ?>
											</div>
											<div class="col-md-7 col-xs-12">
												<h2 class="text-lg"><?php the_title(); ?></h2>
												<?php the_excerpt(); ?>
											</div>
										</div>
									</div>
								</a> 
							<?php }
							//echo '</div>';
						} else {
							// no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
						</div>

						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>

					</div>

				</div>

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_pagination( array( 'mid_size' => 2 ) );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->

		</div>

	</div><!-- #primary -->

	<div class="col-md-3 col-xs-12">
		<?php get_sidebar( '' ); ?>
	</div>

</div>

<?php
get_footer();
