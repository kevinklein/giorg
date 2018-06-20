<?php if ( !get_field( 'hide_header' ) ): ?>
	<header class="border-bottom">
		<div class="container p-y-md"> 
			<?php the_title( '<h1 class="main-title">', '</h1>' ); ?>      
		</div>
	</header>
<?php endif; ?>