<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package giorg
 */

get_header();
?>

<div class="container">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'giorg' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header><!-- .page-header -->

		<?php if ( !get_field( 'hide_header' ) ): ?>
			<header>
				<div class="container p-y-md"> 
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'giorg' ), '<span>' . get_search_query() . '</span>' );
					?>
				</div>
			</header>
		<?php endif; ?>

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			
			if(isset($_GET['post_type'])) :
				$type = $_GET['post_type'];
				if($type == 'guideline') :

					get_template_part( 'template-parts/content', 'search-guidelines' );

				else :

					get_template_part( 'template-parts/content', 'search' );

				endif;
			
			endif;

		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
</div>

<?php
get_sidebar();
get_footer();
