<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

get_header();
?>

<div class="row">
	<main id="main" class="col-md-9 col-xs-12">

		<?php if ( have_posts() ) : ?>

			<header class="page-header m-b-md">
				<?php
				the_archive_title( '<p class="text-600 text-lg">', '</p><hr>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<ul>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
				get_template_part( 'template-parts/content-search', get_post_type() );

			endwhile;

			the_posts_pagination( array( 'mid_size' => 2 ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</ul>

	</main>

	<div class="col-md-3 col-xs-12 hidden-sm-down">
		<?php get_sidebar(); ?>
	</div>
	
</div>

<?php
get_footer();
