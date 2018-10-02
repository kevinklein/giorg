<?php

// WP_Query arguments
$args = array (
	'post_type'              => array( 'guideline' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page' 		 => '-1',
	'nopaging'               => true,
	'order'                  => 'ASC',
	'orderby'                => 'menu_order',
);

$linkurl = htmlspecialchars(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));

// The Query
$guidelines = new WP_Query( $args );

?>

<div class="row">

<?php
// The Loop
if ( $guidelines->have_posts() ) {
	while ( $guidelines->have_posts() ) {
		$guidelines->the_post(); 
			
			$post->hashtmlguideline = get_post_meta($post->ID, '_acg_gi_cpt_hashtmlguideline', true); 
			$post->titlesortby = get_post_meta($post->ID, '_acg_gi_cpt_titlesortby', true); 
			$post->boldedtitle = str_replace($post->titlesortby, "<strong>".$post->titlesortby."</strong>", $post->post_title);
			$post->publicationdate = get_post_meta($post->ID, '_acg_gi_cpt_publicationdate', true); 
			$post->primaryauthor = get_post_meta($post->ID, '_acg_gi_cpt_primaryauthor', true); 
			$post->primaryauthor_last = get_post_meta($post->ID, '_acg_gi_cpt_primaryauthor_last', true); 
			$post->secondaryauthors = get_post_meta($post->ID, '_acg_gi_cpt_secondaryauthors', true); 
			$post->downloadurl = get_post_meta($post->ID, '_acg_gi_cpt_downloadurl', true); 
			$post->decisionsupporttoolurl = get_post_meta($post->ID, '_acg_gi_cpt_decisionsupporttoolurl', true); 
			$post->summaryurl = get_post_meta($post->ID, '_acg_gi_cpt_summaryurl', true); 
			$post->partnermessage = get_post_meta($post->ID, '_acg_gi_cpt_partnermessage', true); 
			$post->updategl = get_post_meta($post->ID, '_acg_gi_cpt_updategl', true); 
			$post->datepublicationdate = getdate(strtotime($post->publicationdate));
			$post->displaydatepublicationdate = strlen($post->publicationdate) > 0 ? $post->datepublicationdate["month"]." ".$post->datepublicationdate["year"] : "";

		?>
		
		<div class="col-md-4 col-xs-12 display-flex flex-column">
			<div class="card display-flex flex-column flex-1">
				<div class="card-block flex-1">
					<h3 class="text-md m-b-xs text-700">
						<?php if ($post->hashtmlguideline === 'hashtmlguideline') : ?><a href="<?php the_permalink() ?>"><?php endif; ?>
							<?php the_title(); ?>
						<?php if ($post->hashtmlguideline === 'hashtmlguideline') : ?></a><?php endif; ?>
					</h3>
					<p class="text-sm text-mute m-b-xs"><?php echo $post->displaydatepublicationdate; ?></p>
					<p class="text-sm m-b-0"><svg class="icon icon-user2"><use xlink:href="#icon-user2"></use></svg> <?php echo $post->primaryauthor; ?></p>
				</div>
			</div>
		</div>
        

<?php		
	} ?>

</div>

<?php	
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>