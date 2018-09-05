<?php
/**
 * The template for displaying podcasts and videos.
 *
 */

get_header(); ?>

	<div class="group">
	
		<div id="main" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content(); ?>
			</div>
<?php endwhile; // end of the loop. ?>

		</div>
	<?php get_sidebar(); ?>
	
	</div>

</div>
<?php get_footer(); ?>