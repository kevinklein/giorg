<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package giorg
 */

get_header();
?>

<div class="container">
	<?php if ( have_posts() ) : ?>

		<p class="text-muted text-lg">
		<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'You searched for %s', 'giorg' ), '<b class="text-black">' . get_search_query() . '</b>' );
		?>
		</p>

		<hr>

		<ul>

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'search-guidelines' );

		endwhile;

		echo "</ul><hr>";

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
</div>

<?php
get_sidebar();
get_footer();
