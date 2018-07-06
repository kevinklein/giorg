<?php

/**
* Template Name: Page Builder Template
* Description: Used as a drag n'drop page builder using ACF
**/

get_header();
?>

	<?php require_once( 'partials/page-title.php' ); ?>
	<?php require_once( 'partials/breadcrumbs.php' ); ?>

	<?php
		$containerSize = get_field('container_size');
	?>

	<main class="
		<?php echo $containerSize ?>
		<?php if ( $containerSize != "none" ) { echo "p-y"; } ?>
		main-content">

		<?php

		// check if the flexible content field has rows of data
		if( have_rows('acf_page_builder') ):

			// loop through the rows of data
			while ( have_rows('acf_page_builder') ) : the_row();

				if( get_row_layout() == 'hero_image' ):

					$hero_image = get_sub_field('hero_image');
					$hero_size = $hero_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
					$hero_title = get_sub_field('hero_block_title');
					$hero_title_size = get_sub_field('hero_block_title_size');
					$hero_caption = get_sub_field('hero_block_text');
					$caption_position = get_sub_field('hero_block_caption_position');
					$hero_display_button = get_sub_field('hero_block_display_cta_button');
					$hero_button = get_sub_field('hero_block_hero_cta_button');
					$hero_lightbox = get_sub_field('hero_cta_lightbox');
				
				include ( __DIR__ . '/../views/acf-pagebuilder-hero-image.php');

				elseif( get_row_layout() == 'flexbox_columns' ):
		
					//////////////////////////////////////////// Flexbox Columns repeater Layout ////////////////////
					// Variables
					$flexbox_columns_title = get_sub_field('flexbox_columns_title');                      
		
				include ('views/acf-pagebuilder-flexbox-columns.php'); 

				elseif( get_row_layout() == 'flexbox_cards' ):
		
					//////////////////////////////////////////// Flexbox Cards repeater Layout ////////////////////
					// Variables
					$flexbox_cards_title = get_sub_field('flexbox_cards_title');                      
		
				include ('views/acf-pagebuilder-flexbox-cards.php'); 

				elseif( get_row_layout() == 'content_row' ):
		
					//////////////////////////////////////////// Flexbox Cards repeater Layout ////////////////////
					// Variables
					$content_row_title = get_sub_field('content_row_title'); 
					$content_row_wrap_css_class = get_sub_field('content_row_wrap_css_class');
					$content_row_wrap_inner_css_class = get_sub_field('content_row_wrap_inner_css_class');
					$content_row_html = get_sub_field('content_row_html');                     
		
				include ('views/acf-pagebuilder-content-row.php'); 

				endif;

			endwhile;

		else :

			// no layouts found

		endif;

		?>

	</main><!-- .entry-content -->

<?php
get_footer();