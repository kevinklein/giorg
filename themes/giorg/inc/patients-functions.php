<?php
/**
 * Patients functions
 *
 * @package giorg
 */

if(!function_exists( 'get_podcastsvideos_by_category_for_topic_2' )){
	function get_podcastsvideos_by_category_for_topic_2( $topic ){

		if(!$topic){
			$args = array(
				'post_type' => 'podcasts',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
			);
		}else{
			$args = array(
				'post_type' => 'podcasts',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'meta_key' => '_acg_gi_patients_cpt_topic',
				'meta_query' => array(
					array(
						'key' => '_acg_gi_patients_cpt_topic',
						'value' => '"'.$topic.'"',
						'compare' => 'LIKE'
					)
				)
			);
		}
/*
		$podcastsvideos = new WP_Query();
		$podcastsvideos->query($args);
*/
		$podcasts = get_posts($args);

		if(!$topic){
			$args = array(
				'post_type' => 'videos',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
			);
		}else{
			$args = array(
				'post_type' => 'videos',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'meta_key' => '_acg_gi_patients_cpt_topic',
				'meta_query' => array(
					array(
						'key' => '_acg_gi_patients_cpt_topic',
						'value' => '"'.$topic.'"',
						'compare' => 'LIKE'
					)
				)
			);
		}

		$videos = get_posts($args);

		$podcastsvideos = array_merge($podcasts,$videos);
		$podcastscategories = array();
		$podcastpresenters = array();
		$authorsbycategories = array();

		foreach($podcastsvideos as $post) :
			if($post->post_type == "podcasts"){
				$post->external_link = get_post_meta($post->ID, '_acg_gi_patients_cpt_external_link', true);
			}else{
				$post->external_link = get_post_meta($post->ID, '_acg_gi_patients_cpt_video_external_link', true);
			}
			$post->podcast_presenter = get_post_meta($post->ID, '_acg_gi_patients_cpt_podcast_presenter', true);
			if(!in_array($post->podcast_presenter,$podcastpresenters)){
				$podcastpresenters[] = $post->podcast_presenter;
			}
			$post_categories = wp_get_post_categories( $post->ID );
			$cats = array();
			foreach($post_categories as $c){
				$cat = get_category( $c );
				$currentcat = $cat->name;
				if(!in_array($cat->name,$podcastscategories)){
					$podcastscategories[] = $currentcat;
					$authorsbycategories[$currentcat] = array($post->podcast_presenter);
					$currarray = $authorsbycategories[$currentcat];
					$currarray[] = $post->podcast_presenter;
				}else{
					if(!in_array($post->podcast_presenter,$authorsbycategories[$currentcat])){
						$currarray = $authorsbycategories[$currentcat];
						$currarray[] = $post->podcast_presenter;
					}
				}
/* 				$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug ); */
				$cats[] = $currentcat;
			}
			$post->categories = $cats;
/*
			$args2 = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
			$attachments = get_posts($args2);
*/
			$post->picture = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
			$post->picture = $post->picture[0];
/*
			if (has_post_thumbnail( 'single-post-thumbnail' )){
				$post->picture = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			}else{
				$post->picture = "";
			}
*/
		endforeach;
		ksort($authorsbycategories);
		foreach($authorsbycategories as $cat => $pres){
			$pvs = 0;
			foreach($pres as $presenter){
				$i = 0;
				$pvs++;
				foreach($podcastsvideos as $podcastvideo) :
					if($presenter == $podcastvideo->podcast_presenter && in_array($cat,$podcastvideo->categories)){
						$i++;					
						if($i == 1){
					?>
						<div class="podcast">
							<div class="podcast-photo"><img class="<?php if($podcastvideo->post_type == 'podcasts'){ echo 'rounded'; } ?>" src="<?php echo $podcastvideo->picture; ?>" alt="<?php echo $post->podcast_presenter; ?>"/></div>
							<div class="podcast-content">
					<?php
								echo '<h3>'.$cat.' - '.$presenter.'</h3>';
								echo '<ul>';
						}
						if($i == 6){
								echo '</ul><ul>';
						}
					?>
	
							<li><a href="<?php echo $podcastvideo->external_link; ?>" target="_blank"><?php echo $podcastvideo->post_title; ?></a></li>
					<?php
					}
				endforeach;
								echo '</ul>'
					?>
							</div>
							<div class="clear"></div>
						</div>
					<?php
			}
		}
/*
		sort($podcastpresenters);
		foreach($podcastpresenters as $presenter) :
		endforeach;
		sort($podcastscategories);
		$pvs = 0;
		foreach($podcastscategories as $category) :
			$i = 0;
			$opened = false;
			$pvs++;
			echo '<a name="podcastvideo_'.$pvs.'"></a><h3 id="podcastvideo_'.$pvs.'">'.$category.'</h3>';
			foreach($podcastsvideos as $podcastvideo) :
				if(in_array($category,$podcastvideo->categories)){
					if( $i % 3 == 0 && $i != 0){
						echo '</div>';
						echo '<div class="split three group">';
						$opened = true;
					}
					$i++;
					if($i == 1){
						echo '<div class="split three group">';
						$opened = true;
					}
					?>
						<div>
							<?php if(strlen($podcastvideo->picture) > 0){ ?>
								<div class="center"><img class="<?php if($podcastvideo->post_type == 'podcasts'){ echo 'rounded'; } ?>" src="<?php echo $podcastvideo->picture; ?>" alt="<?php echo $post->podcast_presenter; ?>"/></div>
							<?php } ?>
							<h4><a href="<?php echo $podcastvideo->external_link; ?>" target="_blank"><?php echo $podcastvideo->post_title; ?></a></h4>
							<p class="small"><?php echo $podcastvideo->podcast_presenter; ?></p>
						</div>
					<?php
				}
			endforeach;
			if($opened){
				echo '</div>';
				$opened = false;
			}
		endforeach;
*/
/*
		echo '<pre>';
		print_r($podcastsvideos);
		print_r($podcastscategories);
		echo '</pre>';		
		die();
*/
		wp_reset_query();
	}
}

if(!function_exists( 'get_podcastsvideos_categories' )){
	function get_podcastsvideos_categories( $topic ){
		$args = array(
			'post_type' => 'podcasts',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_key' => '_acg_gi_patients_cpt_topic',
			'meta_query' => array(
				array(
					'key' => '_acg_gi_patients_cpt_topic',
					'value' => '"'.$topic.'"',
					'compare' => 'LIKE'
				)
			)
		);

		$podcasts = get_posts($args);

		$args = array(
			'post_type' => 'videos',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_key' => '_acg_gi_patients_cpt_topic',
			'meta_query' => array(
				array(
					'key' => '_acg_gi_patients_cpt_topic',
					'value' => '"'.$topic.'"',
					'compare' => 'LIKE'
				)
			)
		);

		$videos = get_posts($args);

		$podcastsvideos = array_merge($podcasts,$videos);
		$podcastscategories = array();

		foreach($podcastsvideos as $post) :
			$post_categories = wp_get_post_categories( $post->ID );
			foreach($post_categories as $c){
				$cat = get_category( $c );
				if(!in_array($cat->name,$podcastscategories)){
					$podcastscategories[] = $cat->name;
				}
			}
		endforeach;

		sort($podcastscategories);

		return $podcastscategories;
		
		wp_reset_query();
	}
}