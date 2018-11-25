<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $postThumb = get_the_post_thumbnail(); if( !empty( $postThumb ) ) : ?>
	
		<a href="<?php the_permalink(); ?>" class="post-thumbnail pull-left m-r m-b">
			<?php the_post_thumbnail('medium'); ?> 
		</a>

	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="text-sm text-muted m-b">
				<?php
				giorg_posted_on();
				giorg_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		
		<?php
			if ( !is_singular() ) :
		?>

			<?php the_excerpt(); ?>

			<hr class="m-b-md">

		<?php else :
			the_content();
		endif; ?>
		
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) : ?>
		<footer class="entry-footer text-sm m-t-lg bg-primary-pale p-a text-hover-underline">
			<?php giorg_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
