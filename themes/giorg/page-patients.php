
<?php
/**
 * Template Name: Patients
 *
 * @package giorg
 */

get_header();
?>

	<?php get_sidebar( 'patients-before' ); ?>

	<div class="row">
		<div class="col-md-2 col-xs-12">
			<?php get_sidebar( 'patients' ); ?>
		</div>
		<div class="col-md-10 col-xs-12">
			<?php
			while ( have_posts() ) :
				the_post();

				if ( is_page( 'gi-health-and-disease') ) :

				get_template_part( 'template-parts/content-gi-health-and-disease', 'page' );

				else :
			
				get_template_part( 'template-parts/content', 'page' );

				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</div>

<?php
get_footer(); 
?>
