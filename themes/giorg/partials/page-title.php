<?php if ( !get_field( 'hide_header' ) ): ?>
	<header class="border-bottom">
		<div class="container p-y-md"> 
			<?php if( is_page( 'contentapi' ) ){ ?>
				<h1 class="main-title">
					<!-- TITLEBEGIN -->
					<!-- TITLEEND -->
				</h1>
			<?php } else { ?>
				<?php the_title( '<h1 class="main-title">', '</h1>' ); ?> 
			<?php } ?>     
		</div>
	</header>
<?php endif; ?>