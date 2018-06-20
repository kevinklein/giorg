<?php if ( !get_field( 'hide_breadcrumbs' ) ): ?>
	<nav class="breadcrumb p-y border-bottom border-top">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('
		<div class="container"><svg class="icon icon-home2"><use xlink:href="#icon-home2"></use></svg>','</div>
		');
		}
		?>
	</nav>
<?php endif; ?>