<?php
/**
 *
 * @package giorg
 */
?>
<aside id="secondary">

	<div class="list-group m-b-md">
		<div class="list-group-item"><h3 class="text-uc text-gray-dark m-b-0">Recent Posts</h3></div>
		<!-- // Define our WP Query Parameters -->
		<?php $the_query = new WP_Query( 'posts_per_page=5&ignore_sticky_posts=1' ); ?>
		
		<!-- // Start our WP Query -->
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		
		<!-- // Display the Post Title with Hyperlink -->
		<a class="list-group-item text-500 text-normal" href="<?php the_permalink() ?>"><span class="text-primary"><?php the_title(); ?></span></a>
		
		<!-- // Repeat the process and reset once it hits the limit -->
		<?php 
			endwhile;
			wp_reset_postdata();
		?>
	</div>

	<div class="list-group m-b-md">
		<div class="list-group-item"><h3 class="text-uc text-gray-dark m-b-0">Tags</h3></div>
		<div class="list-group-item">
			<?php wp_tag_cloud( 'smallest=7&largest=30' ); ?>
		</div>
	</div>
	
	<?php
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
	?>
	<div class="widget-area">adfs
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>

</aside>