<?php

$args = array (
	'post_type'              => array( 'week' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page' 		 => '-1',
	'nopaging'               => true,
	'order'                  => 'DESC',
	'orderby'                => 'date',
);

// The Query
$the_query = new WP_Query( $args );

?>

<?php if( $the_query->have_posts() ): ?>
	<div>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<ul class="p-l-lg">
			<?php
			// subloop through headlines in the week custom post
			if( have_rows('week_item') ):
				// loop through weeks
				while ( have_rows('week_item') ) : the_row();
					// Variables
					$week_headline = get_sub_field('week_headline'); 
			?>

			<li><?php echo $week_headline; ?></li>

			<?php
				endwhile;
			else :
				// nothing found
			endif;
			?>
		</ul>
		<hr>
	<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>