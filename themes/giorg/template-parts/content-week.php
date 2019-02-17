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

	<div class="container">

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
					$week_url = get_sub_field('week_url'); 
					$week_url_label = get_sub_field('week_url_label'); 

		?>

		<div id="item<?php echo $count; ?>">

			<div class="week-row p-b-lg">

				<h3 class="p-a-sm text-inverse bg-primary text-md"><?php echo $week_headline; ?></h3>

					<div class="item-flex item-flex-reponsive align-items-flex-start">

						<div class="item-flex-main">
							<?php echo $week_description; ?>
						</div>

						<?php if ( have_rows( 'week_images' ) ) : ?>
							<div class="item-flex-addon m-lg-l-md" style="max-width:30%">
								<?php while ( have_rows( 'week_images' ) ) : the_row();
									$week_image = get_sub_field('week_image');
									$week_caption = get_sub_field('week_caption');
									$week_image_size = $week_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
								?>
								<div class="m-b">
									<?php if($week_image): echo '<div class="text-center"><img src="' . $week_image_size. '"></div>'; endif; ?>
									<?php if($week_caption): echo '<p class="m-t-sm text-muted text-sm text-center">' . $week_caption. '</p>'; endif; ?>
								</div>
							</div>
						<?php endwhile; endif; ?>

					</div>

					<?php if($week_url) : ?>
						<a href="<?php echo $week_url ?>" class="btn btn-primary-outline">
							<?php if($week_url_label) : ?>
								<?php echo $week_url_label ?>
							<?php else : ?>
								Learn More
							<?php endif; ?>
						</a>
					<?php endif; ?>

				</div>
				
			</div>

		</div>

	<?php
		
		endwhile;

		else :

			// no layouts found

		endif;

	?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
