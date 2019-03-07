<?php if ( !get_field( 'hide_header' ) ): ?>
	<?php if ( is_blog() ) { ?>
		<div class="bg-triangles-primary text-inverse">
			<div class="container">
				<?php if ( !is_single() ) { ?>
					<div class="p-y-lg">
						<a href="/acg-blog/"><img src="<?php echo get_template_directory_uri(); ?>/img/acgblog@2x.png" alt="ACG Blog" class="display-block" width="300"></a>
					</div>
				<?php } else { ?>
					<div class="p-y-md">
						<?php the_title( '<h1 class="main-title">', '</h1>' ); ?> 
					</div>
				<?php } ?> 
			</div>
		</div>
	<?php } else { ?>
		<header class="bg-triangles-primary text-inverse">
			<div class="item-flex container p-y-md"> 
				<?php if( is_page( 'contentapi' ) ) { ?>
					<h1 class="main-title">
						<!-- TITLEBEGIN -->
						<!-- TITLEEND -->
					</h1>
				<?php } elseif ( is_search() ) { ?>
					<h1 class="main-title">Search Results</h1>
				<?php } else { ?>
					<h1 class="main-title">
						<?php if ( is_singular( 'week' ) ) {
							echo 'This Week in Washington DC – ';	
						} ?>
						<?php the_title(); ?> 
					</h1>
				<?php } ?> 
				<?php if( is_singular( 'topics' ) ) : ?>
					<div class="m-l-auto">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e6d5ca75f9e63b2"></script>
						<!-- AddThis Button END -->
					</div>
				<?php endif; ?>   
			</div>
		</header>
	<?php } ?> 
<?php endif; ?>