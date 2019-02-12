<?php
global $post;
$post->acgmemberonly = get_post_meta($post->ID, '_acg_gi_cpt_acgmemberonly', true);
if(!current_user_can("publish_pages") || !current_user_can("edit_pages")){
        if($post->acgmemberonly == "acgmemberonly"){
                define('DONOTCACHEPAGE', true);
                if (accts_is_signed_in()){
                        if(!accts_get_account_acg_member_id()){
                                header("location:/about/my-acg-login/?returnurl=".urlencode(curPageURL()));
                        }
                }else{
                        header("location:/about/my-acg-login/?returnurl=".urlencode(curPageURL()));
                }
        }
}
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

get_header();
?>

	<?php
	while ( have_posts() ) :
		the_post();

		if ( is_page( 'gi-fellowship-program-information') ) :

			get_template_part( 'template-parts/content-fellowship', 'page' );

		elseif ( is_page( 'history') ) :

			get_template_part( 'template-parts/content-history', 'page' );

		endif;
	
		get_template_part( 'template-parts/content', 'page' );

		if ( is_page( 'guidelines') ) :

			get_template_part( 'template-parts/content-guidelines', 'page' );

		endif;

	endwhile; // End of the loop.
	?>

<?php
get_footer(); 
?>
