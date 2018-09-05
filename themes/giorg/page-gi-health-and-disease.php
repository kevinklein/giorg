<?php
/**
 * The template for displaying gi health and disease list.
 *
 */

get_header(); ?>

	<div class="group">
	
		<div id="main" role="main">

				<h1 class="page-title"> GI Health and Disease</h1>
				

					<div id="tabs">
						<ul class="tabs">
							<li><a href="#tabs1">A &#8211; D</a></li>
							<li><a href="#tabs2">E &#8211; H</a></li>
							<li><a href="#tabs3">I &#8211; L</a></li>
							<li><a href="#tabs4">M &#8211; P</a></li>
							<li><a href="#tabs5">Q &#8211; Z</a></li>
							<li><a href="#tabs6">GI Procedures</a></li>
						</ul>
						<?php
						$args = array(
							'post_type' => 'topics',
							'orderby' => 'title',
							'posts_per_page' => -1,
							'order' => 'ASC',
							'meta_key' => '_acg_gi_patients_cpt_healthcenter',
							'meta_query' => array(
								array(
									'key' => '_acg_gi_patients_cpt_healthcenter',
									'value' => 'healthcenter',
									'compare' => '!='
								),
								array(
									'key' => '_acg_gi_patients_cpt_giprocedure',
									'value' => 'giprocedure',
									'compare' => '!='
								)
							)
						);
						$healthTopics = new WP_Query();
						$healthTopics->query($args);
						$current_letter = "";
						$tab1written = false;
						$tab2written = false;
						$tab3written = false;
						$tab4written = false;
						$tab5written = false;
						$inaletter = false;
/*
						echo '<pre>';
						print_r($healthTopics);
						echo '</pre>';
*/
						while ($healthTopics->have_posts()) : $healthTopics->the_post();
						$first_letter = strtoupper(substr(apply_filters('the_title',$post->post_title),0,1));
						$post->topic_redirect = get_post_meta($post->ID, '_acg_gi_patients_cpt_topic_redirect', true);
						if($first_letter != $current_letter){
							$current_letter = $first_letter; 
							if($inaletter){
								echo '</ul>';
								echo '<div class="hr"></div>';
								$inaletter = false;
							}
							if(!$tab1written && ($current_letter < "E")){
								//echo '</div>';
								echo '<div id="tabs1">';
								$tab1written = true;
							}
							if(!$tab2written && ($current_letter > "D" && $current_letter < "I")){
								echo '</div>';
								echo '<div id="tabs2">';
								$tab2written = true;
							}
							if(!$tab3written && ($current_letter > "H" && $current_letter < "M")){
								echo '</div>';
								echo '<div id="tabs3">';
								$tab3written = true;
							}
							if(!$tab4written && ($current_letter > "L" && $current_letter < "Q")){
								echo '</div>';
								echo '<div id="tabs4">';
								$tab4written = true;
							}
							if(!$tab5written && ($current_letter > "P")){
								echo '</div>';
								echo '<div id="tabs5">';
								$tab5written = true;
							}
							$inaletter = true;
							echo '<h2 class="section">'.$current_letter.'</h2>';
							echo '<ul class="simple">';
						}
						if(strlen($post->topic_redirect) > 0 && $post->topic_redirect != "xx" && is_numeric($post->topic_redirect) ){
				?>
						<li><a href="<?php echo get_permalink( $post->topic_redirect ); ?>"><?php echo the_title(); ?>&nbsp; (<?php echo get_the_title( $post->topic_redirect ); ?>)</a></li>
				<?php
						} else {
				?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
						}
						endwhile;
						wp_reset_query();
						?>
						</ul>
						</div>
						<div id="tabs6">
						<?php
						$args = array(
							'post_type' => 'topics',
							'orderby' => 'title',
							'order' => 'ASC',
							'posts_per_page' => -1,
							'meta_key' => '_acg_gi_patients_cpt_giprocedure',
							'meta_query' => array(
								array(
									'key' => '_acg_gi_patients_cpt_giprocedure',
									'value' => 'giprocedure'
								),
								array(
									'key' => '_acg_gi_patients_cpt_healthcenter',
									'value' => 'healthcenter',
									'compare' => '!='
								)
							)
						);
						$giProcedures = new WP_Query();
						$giProcedures->query($args);
						$current_letter = "";
						$inaletter = false;

						while ($giProcedures->have_posts()) : $giProcedures->the_post();
						$first_letter = strtoupper(substr(apply_filters('the_title',$post->post_title),0,1));
						if($first_letter != $current_letter){
							$current_letter = $first_letter; 
							if($inaletter){
								echo '</ul>';
								echo '<div class="hr"></div>';
								$inaletter = false;
							}
							$inaletter = true;
							echo '<h2 class="section">'.$current_letter.'</h2>';
							echo '<ul class="simple">';
						}
				?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
						endwhile;
						wp_reset_query();
						?>
							</ul>
						</div>
					</div>


		</div>
	
	<?php get_sidebar(); ?>
	
	</div>

</div>
<?php get_footer(); ?>