
<?php
/**
 * Template Name: Patients
 *
 * @package giorg
 */

get_header();
?>

	<?php get_sidebar( 'patients-before' ); ?>

	<?php
	// get page slug name
	//$slug = get_post_field( 'post_name');
	// echo the $slug
	//echo $slug;
	?>

	<div class="row">
		<div class="col-md-2 col-xs-12">
			<?php get_sidebar( 'patients' ); ?>
		</div>
		<div class="col-md-10 col-xs-12">
			<?php
			while ( have_posts() ) :
				the_post();

				if ( is_page( 'patients') ) :

					get_template_part( 'template-parts/content-patients', 'page' );

				elseif ( is_page( 'gi-health-and-disease') ) :

					get_template_part( 'template-parts/content-gi-health-and-disease', 'page' );

				elseif ( is_page( 'find-a-liver-expert') ) :

					get_template_part( 'template-parts/content-find-a-liver-expert', 'page' );

				elseif ( is_page( 'find-a-gastroenterologist') ) :

					get_template_part( 'template-parts/content-find-a-gastroenterologist', 'page' );

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
