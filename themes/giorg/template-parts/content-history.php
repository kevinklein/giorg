<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

		if( have_rows('history_slide') ):

			// loop through the slides
			while ( have_rows('history_slide') ) : the_row();
		
				// Variables
				$history_year = get_sub_field('history_year'); 
				$history_description = get_sub_field('history_description');

	?>

		<div>

			<h2><?php echo $history_year; ?></h2>

			<p><?php echo $history_description; ?></p>

			<?php if ( have_rows( 'history_images' ) ) : 
				while ( have_rows( 'history_images' ) ) : the_row();
					$history_image = get_sub_field('history_image');
					$history_caption = get_sub_field('history_caption');
					$history_image_size = $history_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
			?>

				<?php if($history_image): echo '<img src="' . $history_image_size. '">'; endif; ?>

				<?php if($history_caption): echo '<p>' . $history_caption. '</p>'; endif; ?>

			<?php endwhile; endif; ?>

		</div>

	<?php
		
		endwhile;

		else :

			// no layouts found

		endif;

	?>

</article><!-- #post-<?php the_ID(); ?> -->
