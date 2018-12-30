<style>
.grid-item {
	width: 33.3333%;
}
.grid-item .card {
	min-height: 205px;
}
</style>

<?php the_content(); ?>

<div class="text-center container-sm m-b-md p-lg-x-xl">
	<form role="search" method="get" class="input-group" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="form-control" name="s" id="s" value="" placeholder="Search for Guidelines and Other Clinical Documents">
		<input type="hidden" name="post_type" value="guideline">
		<span class="input-group-btn"><input type="submit" class="btn btn-orange" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /></span>
	</form>
</div>

<?php

// WP_Query arguments
$args = array (
	'post_type'              => array( 'guideline' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page' 		 => '-1',
	'nopaging'               => true,
	'order'                  => 'ASC',
	'orderby'                => 'title',
);

$linkurl = htmlspecialchars(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));

// The Query
$guidelines = new WP_Query( $args );

?>

<div class="btn-group-responsive-overflow text-center">
    <div class="btn-group button-group" id="filters">
		<button class="button btn btn-outline" data-filter="*">
			ACG Guidelines
		</button>
		<button class="button btn btn-outline" data-filter=".monographs">
			Monographs
		</button>
		<button class="button btn btn-outline" data-filter=".competencies-in-endoscopy">
			Competencies in Endoscopy
		</button>
		<button class="button btn btn-outline" data-filter=".Progress">
			Guidelines in Progress
		</button>
	</div>
</div>

<div class="text-right m-t m-b text-sm">
	<div class="btn-group sort-by-button-group">
		<button class="button btn btn-xs btn-outline" data-sort-by="name">
			Sort A to Z
		</button>
		<button class="button btn btn-xs btn-outline" data-sort-by="date">
			Sort by Date
		</button>
	</div>
</div>

<div class="grid row">

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
			$post->podcast = get_post_meta($post->ID, '_acg_gi_cpt_podcast', true); 
			$post->datepublicationdate = getdate(strtotime($post->publicationdate));
			$post->displaydatepublicationdate = strlen($post->publicationdate) > 0 ? $post->datepublicationdate["month"]." ".$post->datepublicationdate["year"] : "";

		?>
		
		<div class="grid-item <?php echo $post->updategl . ' '; 
				$posttags = get_the_tags();
				if ($posttags) {
					foreach($posttags as $tag) {
						echo $tag->slug . ' '; 
					}
				}
				?>" data-date-created="<?php echo $post->publicationdate; ?>" data-title="<?php the_title(); ?>">
			<div class="card display-flex flex-column">
				<div class="card-block flex-1">
					<?php if (strlen($post->updategl) > 0) : ?>
						<b class="text-uppercase text-400 text-xxs item-flex m-b-sm"><b class="circle circle-xxs bg-success m-r-xs"></b> <?php echo $post->updategl; ?></b>
					<?php endif; ?>
					<h3 class="text-md m-b-xs text-700">
						<?php if ($post->hashtmlguideline === 'hashtmlguideline') : ?><a href="<?php the_permalink() ?>"><?php endif; ?>
							<span class="name"><?php the_title(); ?></span>
						<?php if ($post->hashtmlguideline === 'hashtmlguideline') : ?></a><?php endif; ?>
					</h3>
					<p class="text-sm text-mute m-b-xs date"><?php echo $post->displaydatepublicationdate; ?></p>
					<p class="text-sm m-b-0"><svg class="icon icon-user2"><use xlink:href="#icon-user2"></use></svg> <?php echo $post->primaryauthor; ?></p>
				</div>
				<div class="card-footer bg-gray-lighter p-y-sm text-uc item-flex">
					<div class="item-flex-main">
						<?php if (strlen($post->decisionsupporttoolurl) > 0) : ?>
							<a href="<?php echo $post->decisionsupporttoolurl; ?>" target="_blank">Decision Support Tool</a> <span class="text-pipe">|</span>
						<?php endif; ?>
						<?php if (strlen($post->summaryurl) > 0) : ?>
							<a href="<?php echo $post->summaryurl; ?>" target="_blank">Summary</a>
						<?php endif; ?>
					</div>
					<div class="item-flex-addon">
						<?php if (strlen($post->downloadurl) > 0) : ?>
							<a href="<?php echo $post->downloadurl; ?>" class="text-muted" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon"><path d="m451.7 99.72-71.4-71.44c-15.6-15.55-46.3-28.28-68.3-28.28h-240c-22 0-40 18-40 40v432c0 22 18 40 40 40h368c22 0 40-18 40-40v-304c0-22-12.7-52.7-28.3-68.28z"></path><path fill="#fff" d="m448 472c0 4.3-3.7 8-8 8h-368c-4.34 0-8-3.7-8-8v-432c0-4.34 3.66-8 8-8h240c2.4 0 5.1.30 8 .85v127.2h127.1c.6 2.9.9 5.6.9 8v304z"></path><path d="m414.5 316.8c-2.1 1.3-8.1 2.1-11.9 2.1-12.4 0-27.6-5.7-49.1-14.9 8.3-.6 15.8-.9 22.6-.9 12.4 0 16 0 28.2 3.1 12.1 3 12.2 9.3 10.2 10.6zm-215.1 1.9c4.8-8.4 9.7-17.3 14.7-26.8 12.2-23.1 20-41.3 25.7-56.2 11.5 20.9 25.8 38.6 42.5 52.8 2.1 1.8 4.3 3.5 6.7 5.3-34.1 6.8-63.6 15-89.6 24.9zm39.8-218.9c6.8 0 10.7 17.06 11 33.16.3 16-3.4 27.2-8.1 35.6-3.9-12.4-5.7-31.8-5.7-44.5 0 0-.3-24.26 2.8-24.26zm-133.4 307.2c3.9-10.5 19.1-31.3 41.6-49.8 1.4-1.1 4.9-4.4 8.1-7.4-23.5 37.6-39.3 52.5-49.7 57.2zm315.2-112.3c-6.8-6.7-22-10.2-45-10.5-15.6-.2-34.3 1.2-54.1 3.9-8.8-5.1-17.9-10.6-25.1-17.3-19.2-18-35.2-42.9-45.2-70.3.6-2.6 1.2-4.8 1.7-7.1 0 0 10.8-61.5 7.9-82.3-.4-2.9-.6-3.7-1.4-5.9l-.9-2.5c-2.9-6.76-8.7-13.96-17.8-13.57l-5.3-.17h-.1c-10.1 0-18.4 5.17-20.5 12.84-6.6 24.3.2 60.5 12.5 107.4l-3.2 7.7c-8.8 21.4-19.8 43-29.5 62l-1.3 2.5c-10.2 20-19.5 37-27.9 51.4l-8.7 4.6c-.6.4-15.5 8.2-19 10.3-29.6 17.7-49.28 37.8-52.54 53.8-1.04 5-.26 11.5 5.01 14.6l8.4 4.2c3.63 1.8 7.53 2.7 11.43 2.7 21.1 0 45.6-26.2 79.3-85.1 39-12.7 83.4-23.3 122.3-29.1 29.6 16.7 66 28.3 89 28.3 4.1 0 7.6-.4 10.5-1.2 4.4-1.1 8.1-3.6 10.4-7.1 4.4-6.7 5.4-15.9 4.1-25.4-.3-2.8-2.6-6.3-5-8.7z"></path><path fill="#fff" d="m429.1 122.3c1.6 1.6 3.1 3.5 4.6 5.7h-81.7v-81.73c2.2 1.52 4.1 3.08 5.7 4.64l71.4 71.39z"></path></svg> PDF</a>
						<?php endif; ?>
						<?php if (strlen($post->podcast) > 0) : ?>
							<a href="<?php echo $post->podcast; ?>" class="text-muted m-l-sm" target="_blank">
								<svg class="icon"><use xlink:href="#icon-microphone"></use></svg>
								Podcast
							</a>
						<?php endif; ?>
					</div>
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