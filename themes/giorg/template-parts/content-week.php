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

	<div class="container p-t-lg">
		
		<ul class="list-unstyled">

		<?php

			if( have_rows('week_item') ):

			$count = 0;

				// loop through the slides
				while ( have_rows('week_item') ) : the_row();
					
					// set counter
					$count++;
			
					// Variables
					$week_headline = get_sub_field('week_headline'); 
					$week_description = get_sub_field('week_description');
					$week_cta = get_sub_field('week_cta'); 

		?>

		<li id="<?php echo $count; ?>">

			<div class="row">

				<?php if ( have_rows( 'week_images' ) ) : ?>
					<div class="col-md-4 col-xs-12">
						<?php while ( have_rows( 'week_images' ) ) : the_row();
							$week_image = get_sub_field('week_image');
							$week_caption = get_sub_field('week_caption');
							$week_image_size = $week_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
						?>
						<div class="m-b">
							<?php if($week_image): echo '<div class="text-center border-1 border-a border-gray-light p-a-sm"><img src="' . $week_image_size. '"></div>'; endif; ?>
							<?php if($week_caption): echo '<p class="m-t-sm text-muted text-sm text-center">' . $week_caption. '</p>'; endif; ?>
						</div>
					</div>
				<?php endwhile; endif; ?>
		
				<?php if ( have_rows( 'week_images' ) ) : ?>
					<div class="col-md-8 col-xs-12">
				<?php else : ?>
					<div class="col-xs-12">
				<?php endif; ?>
					<?php echo $week_description; ?>
					<?php if($week_url): ?>
						<a href="$week_url" class="btn btn-primary">Learn More</a>
					<?php endif; ?>
				</div>
				
			</div>

		</li>

	</ul>

	<?php
		
		endwhile;

		else :

			// no layouts found

		endif;

	?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
