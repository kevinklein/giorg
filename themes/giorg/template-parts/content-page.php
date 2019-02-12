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
		if ( is_front_page() ) :

			get_template_part( 'template-parts/content-home', 'page' );

		elseif (is_page(147)) :
			?>
				<div class="callout">
					<div class="group">
					<?php
					if (accts_is_signed_in()){
									$account = accts_get_account();
					?>
					Welcome <?php echo $account->firstName; ?> |
					<a href="<?php echo accts_signout_url($returnUrl); ?>">Log Out</a>
					<?php
					if(!accts_get_account_acg_member_id()){
									?>
									<p>Our records show you our not an ACG member and don't have access to member sections of this site. If you feel this is in error, please <a href="/membership/contact-acg/">contact us</a>.</p>
									<?php
					}
					?>
					<?php } else { ?>
						 <div class="left">
													<form name="login" id="login" action="<?php echo ACG_ACCOUNTS_APP; ?>/Account/Login" method="post">
																	<label for="loginemail">Email Address</label>
																	<input type="text" id="loginemail" name="loginemail" class="text">
																	<label for="loginpassword">Password</label>
																	<input type="password" id="loginpassword" name="loginpassword" class="text">
																	<input type="hidden" value="acgmembers" name="app" />
			<?php if(isset($_REQUEST["returnurl"])){ ?>
																					<input type="hidden" value="<?php echo urlencode(urldecode($_REQUEST["returnurl"])); ?>" name="returnUrl" />
			<?php }else{ ?>
																					<input type="hidden" value="<?php echo curPageURL(); ?>" name="returnUrl" />
			<?php } ?>
																	<input type="submit" value="Sign In">
													</form>
													<a href="/membership/forgot-my-password/" class="forgot-password">Forgot/Change My Login</a>
						 </div>
						 <div class="right center">
													<p class="intro">Join ACG, one of the leading organizations for clinical gastroenterologists.</p>
													<a href="https://members.gi.org/acgmembership/" class="button green">Become a Member</a>
													<p class="small collapse"><a href="<?php echo ACG_ACCOUNTS_APP; ?>/Account/Create?app=acgmembers">Create a user account</a>.</p>
						 </div>
					<?php } ?>
					</div>
	</div>
	<?php
		else :

			the_content();

		endif;
	?>
	<!-- MAINCOLUMNEND -->

</article><!-- #post-<?php the_ID(); ?> -->
