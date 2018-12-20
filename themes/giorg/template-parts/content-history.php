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

	<div class="history-hero">
		<div class="container text-center">
			<img src="/wp-content/themes/giorg/img/history-bg-text.png" width="90%">
		</div>
	</div>

	<div id="timeline">

		<div class="bg-primary-lighter text-inverse">
			<div class="container p-b-md position-relative">
				<div class="overflow-hidden p-b-sm">
				<ul id="dates">

				<?php

					if( have_rows('history_slide') ):

					$count = 0;

						// loop through the slides
						while ( have_rows('history_slide') ) : the_row();
					
							// Variables
							$history_year = get_sub_field('history_year'); 

				?>

				<li><a href="#"><?php echo $history_year; ?></a></li>

				<?php
					
					endwhile;

					else :

						// no layouts found

					endif;

				?>

				</ul>
				</div>

			</div>
		</div>

		<div class="container-sm p-t-lg">
			<ul id="issues">

			<?php

				if( have_rows('history_slide') ):

				$count = 0;

					// loop through the slides
					while ( have_rows('history_slide') ) : the_row();
						
						// set counter
						$count++;
				
						// Variables
						$history_year = get_sub_field('history_year'); 
						$history_description = get_sub_field('history_description');

			?>

			<li id="<?php echo $history_year; ?>">

				<div class="row">
					<div class="col-md-4 col-xs-12">
						<?php if ( have_rows( 'history_images' ) ) : 
							while ( have_rows( 'history_images' ) ) : the_row();
								$history_image = get_sub_field('history_image');
								$history_caption = get_sub_field('history_caption');
								$history_image_size = $history_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
						?>

							<div class="m-b">

								<?php if($history_image): echo '<div class="text-center border-1 border-a border-gray-light p-a-sm"><img src="' . $history_image_size. '"></div>'; endif; ?>

								<?php if($history_caption): echo '<p class="m-t-sm text-muted text-sm text-center">' . $history_caption. '</p>'; endif; ?>

							</div>

						<?php endwhile; endif; ?>
					</div>
					<div class="col-md-8 col-xs-12">
						<p><?php echo $history_description; ?></p>
					</div>
				</div>

			</li>

		<?php
			
			endwhile;

			else :

				// no layouts found

			endif;

		?>

			</ul>

			<a href="#" id="next">+</a> <!-- optional -->
			<a href="#" id="prev">-</a> <!-- optional -->
		
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
