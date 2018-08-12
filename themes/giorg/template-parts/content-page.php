<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

		// check if the flexible content field has rows of data
		if( have_rows('acf_page_builder') ):

			// loop through the rows of data
			while ( have_rows('acf_page_builder') ) : the_row();

				if( get_row_layout() == 'flexbox_columns' ):
		
					// Variables
					$flexbox_columns_title = get_sub_field('flexbox_columns_title');                      
		
				include ('views/acf-pagebuilder-flexbox-columns.php'); 

				elseif( get_row_layout() == 'flexbox_cards' ):
		
					// Variables
					$flexbox_cards_title = get_sub_field('flexbox_cards_title');                      
		
					include ('views/acf-pagebuilder-flexbox-cards.php'); 

				elseif( get_row_layout() == 'content_row' ):
		
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

	<!-- MAINCOLUMNBEGIN -->
	<?php
		the_content();
	?>
	<!-- MAINCOLUMNEND -->

</article><!-- #post-<?php the_ID(); ?> -->
