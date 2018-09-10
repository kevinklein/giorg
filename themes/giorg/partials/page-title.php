<?php if ( !get_field( 'hide_header' ) ): ?>
	<header class="border-bottom">
		<div class="item-flex container p-y-md"> 
			<?php if( is_page( 'contentapi' ) ) { ?>
				<h1 class="main-title">
					<!-- TITLEBEGIN -->
					<!-- TITLEEND -->
				</h1>
			<?php } else { ?>
				<?php the_title( '<h1 class="main-title">', '</h1>' ); ?> 
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
<?php endif; ?>