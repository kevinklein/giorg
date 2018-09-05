
<?php
/**
 * Template Name: Patients
 *
 * @package giorg
 */

get_header();
?>

	<div class="row">
		<div class="col-md-2 col-xs-12">
			sidebar
		</div>
		<div class="col-md-10 col-xs-12">
			<?php
			while ( have_posts() ) :
				the_post();
			
				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
		</div>
	</div>

<?php
get_footer(); 
?>
