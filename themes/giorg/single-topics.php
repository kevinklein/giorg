<?php
global $post;
$post->topic_redirect = get_post_meta($post->ID, '_acg_gi_patients_cpt_topic_redirect', true);
if(strlen($post->topic_redirect) > 0 && $post->topic_redirect != "xx" && is_numeric($post->topic_redirect) ){
	wp_redirect( get_permalink($post->topic_redirect), 301 );
	exit;
}
/**
 * The template for displaying Digestive Health Topics.
 *
 */

get_header(); ?>

	<div class="group">
	
		<div id="main" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php
			$post->includemain = get_post_meta($post->ID, '_acg_gi_patients_cpt_includemain', true);
			$post->includebasics = get_post_meta($post->ID, '_acg_gi_patients_cpt_includebasics', true);
			$post->includefaqs = get_post_meta($post->ID, '_acg_gi_patients_cpt_includefaqs', true);
			$post->includepodcastsvideos = get_post_meta($post->ID, '_acg_gi_patients_cpt_includepodcastsvideos', true);
			$post->includeresources = get_post_meta($post->ID, '_acg_gi_patients_cpt_includeresources', true);
			$post->includepromos = get_post_meta($post->ID, '_acg_gi_patients_cpt_includepromos', true);
			$post->maintabcontent = get_post_meta($post->ID, '_acg_gi_patients_cpt_main_maintabcontent', true);
			$post->basic_items_count = get_post_meta($post->ID, '_acg_gi_patients_cpt_basics_items', true);
			$post->faqs_items_count = get_post_meta($post->ID, '_acg_gi_patients_cpt_faqs_items', true);
			$post->resources_items_count = get_post_meta($post->ID, '_acg_gi_patients_cpt_resources_items', true);
			$post->promos_items_count = get_post_meta($post->ID, '_acg_gi_patients_cpt_promos_items', true);
			$post->podcast_header = get_post_meta($post->ID, '_acg_gi_patients_cpt_topics_podcast_header', true);
			$post->podcast_intro = get_post_meta($post->ID, '_acg_gi_patients_cpt_topics_podcast_intro', true);
			if($post->basic_items_count == ""){
				$post->basic_items_count = 0;
			}else{
				$post->basic_items_count = intval($post->basic_items_count);
			}
			if($post->faqs_items_count == ""){
				$post->faqs_items_count = 0;
			}else{
				$post->faqs_items_count = intval($post->faqs_items_count);
			}
			if($post->resources_items_count == ""){
				$post->resources_items_count = 0;
			}else{
				$post->resources_items_count = intval($post->resources_items_count);
			}
			if($post->promos_items_count == ""){
				$post->promos_items_count = 0;
			}else{
				$post->promos_items_count = intval($post->promos_items_count);
			}
			?>			
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e6d5ca75f9e63b2"></script>
<!-- AddThis Button END -->
			</h1>
			<div id="tabs">
				<ul class="tabs">
					<?php if($post->includemain == "includemain"){ ?>
						<li><a href="#tabs1">Main</a></li>
					<?php } ?>
					<?php if($post->includebasics == "includebasics"){ ?>
						<li><a href="#tabs2">Basics</a></li>
					<?php } ?>
					<?php if($post->includefaqs == "includefaqs"){ ?>
						<li><a href="#tabs3">FAQs</a></li>
					<?php } ?>
					<?php if($post->includepodcastsvideos == "includepodcastsvideos"){ ?>
						<li><a href="#tabs4">Podcasts/Videos</a></li>
					<?php } ?>
					<?php if($post->includeresources == "includeresources"){ ?>
						<li><a href="#tabs5">Resources</a></li>
					<?php } ?>
				</ul>
				<?php if($post->includemain == "includemain"){ ?>
				<div id="tabs1" class="main">
					<!-- <div> -->
						<?php if($post->includepromos == "includepromos"){ ?>
						<div class="article">
						<div class="callout">
							<div id="cycle-main">
								<?php
								$i = 0;
								while($i != $post->promos_items_count){
									$i++;
									$promohtml = get_post_meta( $post->ID, '_acg_gi_patients_cpt_promos_promocontent_'.$i, true );
									if( strlen($promohtml) > 0 ){
									?>
										<div>
										<?php echo $promohtml; ?>
										</div>
									<?php
									}
								}
								?>
							</div>
						</div>
						</div>
						<?php } ?>
						<?php echo $post->maintabcontent; ?>
					<!-- </div> -->
					<!-- <div>
						<ul>
							<?php if($post->includebasics == "includebasics"){ ?>
						    <li class="parent"><a href="#">Basics</a>
								<ul>
									<?php
									$i = 0;
									while($i != $post->basic_items_count){
										$i++;
										$sectiontitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectionname_'.$i, true );
										$sectioncontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i, true );
										if( strlen($sectiontitle) > 0 && strlen($sectioncontent) > 0){
										?>
											<li><a href="#basics_<?php echo $i; ?>" rel="#tabs2"><?php echo $sectiontitle; ?></a></li>
										<?php
										}
									}
									?>
								</ul>
							</li>
							<?php } ?>
							<?php if($post->includefaqs == "includefaqs"){ ?>
							<li class="parent"><a href="#">FAQs</a>
								<ul>
								<?php
								$i = 0;
								while($i != $post->faqs_items_count){
									$i++;
									$question = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_question_'.$i, true );
									$answer = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_answer_'.$i, true );
									if( strlen($question) > 0 && strlen($answer) > 0){
									?>
										<li><a href="#faqs_<?php echo $i; ?>" rel="#tabs3"><?php echo $question; ?></a></li>
									<?php
									}
								}
								?>
								</ul>
							</li>
							<?php } ?>
							<?php if($post->includepodcastsvideos == "includepodcastsvideos"){ ?>
							<li class="parent"><a href="#">Podcasts/Videos</a>
								<ul>
									<?php
									$pvs = get_podcastsvideos_categories( $post->ID );
									$i = 0;
									foreach($pvs as $pv) :
										$i++;
										echo '<li><a href="#podcastvideo_'.$i.'" rel="#tabs4">'.$pv.'</a></li>';
									endforeach;
									?> 
								</ul>
							</li>
							<?php } ?>
							<?php if($post->includeresources == "includeresources"){ ?>
							<li class="parent"><a href="#">Resources</a>
								<ul>
								<?php
								$i = 0;
								while($i != $post->resources_items_count){
									$i++;
									$resourcestitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcesname_'.$i, true );
									$resourcescontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcescontent_'.$i, true );
									if( strlen($resourcestitle) > 0 && strlen($resourcescontent) > 0){
									?>
											<li><a href="#resources_<?php echo $i; ?>" rel="#tabs5"><?php echo $resourcestitle; ?></a></li>
									<?php
									}
								}
								?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>-->
					<div class="clear"></div>
<!--
					<div class="group">
						<a href="#" class="next">Basics</a>
					</div>
-->
				</div>
				<?php } ?>
				<?php if($post->includebasics == "includebasics"){ ?>
				<div id="tabs2">
					<!-- <div> -->
						<?php
						$i = 0;
						while($i != $post->basic_items_count){
							$i++;
							$sectiontitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectionname_'.$i, true );
							$sectioncontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i, true );
							if( strlen($sectiontitle) > 0 && strlen($sectioncontent) > 0){
							?>
								<a name="basics_<?php echo $i; ?>"></a><h2 id="basics_<?php echo $i; ?>"><?php echo $sectiontitle; ?></h2>
								<?php echo $sectioncontent; ?>
							<?php
							}
						}
						?>
					<!-- </div> -->
					<!-- <div>
						<ul>
						<?php
						$i = 0;
						while($i != $post->basic_items_count){
							$i++;
							$sectiontitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectionname_'.$i, true );
							$sectioncontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i, true );
							if( strlen($sectiontitle) > 0 && strlen($sectioncontent) > 0){
							?>
							    <li><a href="#basics_<?php echo $i; ?>"><?php echo $sectiontitle; ?></a></li>
							<?php
							}
						}
						?>
						</ul>
					</div> -->
					<div class="clear"></div>
<!--
					<div class="group">
						<a href="#" class="previous">Main</a>
						<a href="#" class="next">FAQs</a>
					</div>
-->
				</div>
				<?php } ?>
				<?php if($post->includefaqs == "includefaqs"){ ?>
				<div id="tabs3">	
					<?php
					$i = 0;
					while($i != $post->faqs_items_count){
						$i++;
						$question = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_question_'.$i, true );
						$answer = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_answer_'.$i, true );
						if( strlen($question) > 0 && strlen($answer) > 0){
						?>
							<a name="faqs_<?php echo $i; ?>"></a><h2 id="faqs_<?php echo $i; ?>"><?php echo $question; ?></h2>
							<?php echo $answer; ?>
						<?php
						}
					}
					?>
<!--
					<div class="group">
						<a href="#" class="previous">Basics</a>
						<a href="#" class="next">Podcasts/Videos</a>
					</div>
-->
					<span id="dht_faq_section"></span>
				</div>
				<?php } ?>
				<?php if($post->includepodcastsvideos == "includepodcastsvideos"){ ?>
				<div id="tabs4">
					<h2><?php echo $post->podcast_header; ?></h2>
					<?php echo $post->podcast_intro; ?>
					<?php //get_podcastsvideos_by_category_for_topic( $post->ID ); ?>
					<?php get_podcastsvideos_by_category_for_topic_2( $post->ID ); ?>
<!--
					<div class="group">
						<a href="#" class="previous">FAQs</a>
						<a href="#" class="next">Resources</a>
					</div>
-->
				</div>
				<?php } ?>
				<?php if($post->includeresources == "includeresources"){ ?>
				<div id="tabs5">
					<?php
					$i = 0;
					$ii = 0;
					$opened = false;
					while($i != $post->resources_items_count){
						$i++;
						$resourcestitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcesname_'.$i, true );
						$resourcescontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcescontent_'.$i, true );
						if( strlen($resourcestitle) > 0 && strlen($resourcescontent) > 0){
							if( $ii % 2 == 0 && $ii != 0){
								echo '</div>';
								echo '<div class="split group">';
								$opened = true;
							}
							$ii++;
							if($ii == 1){
								echo '<div class="split group">';
								$opened = true;
							}
						?>
							<div>
								<a name="resources_<?php echo $i; ?>"></a><h2 id="resources_<?php echo $i; ?>"><?php echo $resourcestitle; ?></h2>
								<?php echo $resourcescontent; ?>
							</div>
						<?php
						}
					}
					if($opened){
						echo '</div>';
						$opened = false;
					}
					?>
<!--
					<div class="group">
						<a href="#" class="previous">Podcasts/Videos</a>
					</div>
-->
				</div>
				<?php } ?>
					<span id="dht_section"></span>
			</div>			



<?php endwhile; // end of the loop. ?>

		</div>
	
	<?php get_sidebar(); ?>
	
	</div>

</div>
<?php get_footer(); ?>
