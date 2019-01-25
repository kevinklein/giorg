<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

get_header();
?>

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		if ( is_page( 'gi-fellowship-program-information') ) :

			get_template_part( 'template-parts/content-fellowship', 'page' );

		elseif ( is_page( 'guidelines') ) :

			get_template_part( 'template-parts/content-guidelines', 'page' );

		elseif ( is_page( 'history') ) :

			get_template_part( 'template-parts/content-history', 'page' );

		endif;

	endwhile; // End of the loop.
	?>

<?php
get_footer(); 
?>
