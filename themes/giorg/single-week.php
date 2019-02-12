<?php
/**
 * The template for Single Guideline
 *
 * @package giorg
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>

<div class="row">
	<div class="col-xs-12">

		<?php get_template_part( 'template-parts/content-week', get_post_type() ); ?>
		
	</div>
</div>

<?php endwhile; // End of the loop.
?>

<?php
get_footer();
