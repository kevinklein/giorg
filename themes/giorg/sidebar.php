<?php
/**
 *
 * @package giorg
 */
?>
<aside id="secondary">

	<?php if ( is_single() ) : ?>
		<!-- <div class="m-b">
			<a href="/acg-blog/" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/acgblog@2x.png" alt="ACG Blog"></a>
		</div> -->
	<?php endif; ?>

	<div class="list-group m-b-md">
		<div class="list-group-item"><h3 class="text-uc text-gray-dark m-b-0">Categories</h3></div>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-5',
			'menu_id' => '',
			'menu_class' => '',
			'container_class' => '',
			'items_wrap' => '<div>%3$s</div>',
			'walker' => new Categories_Walker,
			'depth'=> 1
		) );
		?>
	</div>

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

	<div class="card card-block p-x-sm p-t-sm p-b-0">
		<a class="twitter-timeline" href="https://twitter.com/AmCollegeGastro" data-widget-id="437348425101615104">Tweets by @AmCollegeGastro</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>

	<div class="list-group m-b-md">
		<div class="list-group-item"><h3 class="text-uc text-gray-dark m-b-0">Tags</h3></div>
		<div class="list-group-item text-hover-underline">
			<?php wp_tag_cloud( 'smallest=8&largest=30&number=35' ); ?>
		</div>
	</div>

</aside>