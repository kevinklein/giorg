<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package giorg
 */

get_header();
?>
<div class="row m-b-lg">
	<div id="primary" class="content-area col-md-9 col-xs-12">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="col-md-3 col-xs-12">
		<?php get_sidebar( '' ); ?>
	</div>
</div>

<?php
get_footer();
