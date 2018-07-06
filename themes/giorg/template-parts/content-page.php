<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>

<?php
	$containerSize = get_field('container_size');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<main class="
		<?php echo $containerSize ?>
		<?php if ( $containerSize != "none" ) { echo "p-y"; } ?>
		main-content">
		<?php
		the_content();
		?>
	</main><!-- /.entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
