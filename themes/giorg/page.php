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

	<?php require_once( 'partials/breadcrumbs.php' ); ?>
	<?php require_once( 'partials/page-title.php' ); ?>
	
	<?php
		$containerSize = get_field('container_size');
	?>

	<main class="
		<?php echo $containerSize ?>
		<?php if ( $containerSize != "none" ) { echo "p-y-lg"; } ?>
		main-content">

		<?php
		while ( have_posts() ) :
			the_post();
		
			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- .entry-content -->

<?php
get_footer();
