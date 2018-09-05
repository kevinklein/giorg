<?php
/**
 * The template for displaying podcasts and videos.
 *
 */

get_header(); ?>

	<div class="group">
	
		<div id="main" role="main">

				<h1 class="page-title">Video and Audio Podcasts</h1>
					<?php get_podcastsvideos_by_category_for_topic_2( false ); ?>

		</div>
	
	<?php get_sidebar(); ?>
	
	</div>

</div>
<?php get_footer(); ?>