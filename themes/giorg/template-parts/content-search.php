<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( sprintf( '<a href="%s" rel="bookmark"><h2 class="text-lg text-700 m-b-sm">', esc_url( get_permalink() ) ), '</h2>' ); ?>

	<div class="row">
		<div class="text-muted col-lg-9 col-md-12"><?php the_excerpt(); ?></div>
	</div>

	</a>

</li><!-- #post-<?php the_ID(); ?> -->