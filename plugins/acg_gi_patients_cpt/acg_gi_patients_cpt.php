<?php
/*
Plugin Name: ACG GI Patients Custom Post Types Plugin
Description: Adds Custom Post Types
Version: 0.1
Author: RCS Apps/Matt Wood
*/

/* Set up the post types */
add_action( 'init', 'acg_gi_patients_cpt_register_post_types' );
add_action( 'add_meta_boxes', 'acg_gi_patients_cpt_create' );
add_action( 'save_post', 'acg_gi_patients_cpt_save_meta' );

/* register post types */
function acg_gi_patients_cpt_register_post_types(){
	
	/* set up the arguments for the 'digestive health topic' post type */
	$dht_args = array(
		'public' => true,
		'query_var' => 'topics',
		'rewrite' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'excerpt'
		),
		'labels' => array(
			'name' => 'Digestive Health Topics',
			'singular_name' => 'Digestive Health Topic',
			'add_new' => 'Add New Digestive Health Topic',
			'add_new_item' => 'Add New Digestive Health Topic',
			'edit_item' => 'Edit Digestive Health Topic',
			'new_item' => 'New Digestive Health Topic',
			'view_item' => 'View Digestive Health Topic',
			'search_items' => 'Search Digestive Health Topics',
			'not_found' => 'No Digestive Health Topic Found',
			'not_found_in_trash' => 'No Digestive Health Topics Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'topics', $dht_args );

	/* set up the arguments for the 'podcast' post type */
	$podcast_args = array(
		'public' => true,
		'query_var' => 'podcasts',
		'rewrite' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'excerpt'
		),
		'labels' => array(
			'name' => 'Podcasts',
			'singular_name' => 'Podcast',
			'add_new' => 'Add New Podcast',
			'add_new_item' => 'Add New Podcast',
			'edit_item' => 'Edit Podcast',
			'new_item' => 'New Podcast',
			'view_item' => 'View Podcast',
			'search_items' => 'Search Podcasts',
			'not_found' => 'No Podcast Found',
			'not_found_in_trash' => 'No Podcasts Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'podcasts', $podcast_args );

	/* set up the arguments for the 'podcast' post type */
	$video_args = array(
		'public' => true,
		'query_var' => 'videos',
		'rewrite' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'excerpt'
		),
		'labels' => array(
			'name' => 'Videos',
			'singular_name' => 'Video',
			'add_new' => 'Add New Video',
			'add_new_item' => 'Add New Video',
			'edit_item' => 'Edit Video',
			'new_item' => 'New Video',
			'view_item' => 'View Video',
			'search_items' => 'Search Videos',
			'not_found' => 'No Video Found',
			'not_found_in_trash' => 'No Videos Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'videos', $video_args );

	/* set up the arguments for the 'news' post type */
	$patientnews_args = array(
		'public' => true,
		'query_var' => 'patientnews',
		'rewrite' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'excerpt'
		),
		'labels' => array(
			'name' => 'Patient News',
			'singular_name' => 'Patient News Article',
			'add_new' => 'Add New Patient News Article',
			'add_new_item' => 'Add New Patient News Article',
			'edit_item' => 'Edit Patient News Article',
			'new_item' => 'New Patient News Article',
			'view_item' => 'View Patient News Article',
			'search_items' => 'Search Patient News',
			'not_found' => 'No Patient News Found',
			'not_found_in_trash' => 'No Patient News Articles Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'patientnews', $patientnews_args );

	flush_rewrite_rules( false );

}

function acg_gi_patients_cpt_create(){
	
	//create a custom meta box
	add_meta_box( 'acg_gi_patients_cpt_meta_topics', 'Digestive Health Topic Details', 'acg_gi_patients_cpt_topics_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_topics_Main', 'Digestive Health Topic Main Tab', 'acg_gi_patients_cpt_topics_main_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_topics_basics', 'Digestive Health Topic Basics', 'acg_gi_patients_cpt_topics_basics_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_topics_faqs', 'Digestive Health Topic FAQs', 'acg_gi_patients_cpt_topics_faqs_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_topics_podcastsvideos', 'Digestive Health Topic Podcasts/Videos', 'acg_gi_patients_cpt_topics_podcastsvideos_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_topics_resources', 'Digestive Health Topic Resources', 'acg_gi_patients_cpt_topics_resources_meta_function', 'topics', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_podcasts', 'Podcast Details', 'acg_gi_patients_cpt_podcasts_meta_function', 'podcasts', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_videos', 'Video Details', 'acg_gi_patients_cpt_videos_meta_function', 'videos', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_patientnews', 'Patient News Details', 'acg_gi_patients_cpt_patientnews_meta_function', 'patientnews', 'normal', 'high' );
	add_meta_box( 'acg_gi_patients_cpt_meta_page', 'Facebook Sharing', 'acg_gi_patients_cpt_page_meta_function', 'page', 'normal', 'high' );
	
}

function acg_gi_patients_cpt_page_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_metasharetitle = get_post_meta( $post->ID, '_acg_gi_patients_cpt_metasharetitle', true );
	$acg_gi_patients_cpt_metashareurl = get_post_meta( $post->ID, '_acg_gi_patients_cpt_metashareurl', true );
	$acg_gi_patients_cpt_metashareimageurl = get_post_meta( $post->ID, '_acg_gi_patients_cpt_metashareimageurl', true );
	$acg_gi_patients_cpt_metasharedescription = get_post_meta( $post->ID, '_acg_gi_patients_cpt_metasharedescription', true );
	?>
	<p>Title for Sharing:<br /><input type="text" name="acg_gi_patients_cpt_metasharetitle" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_metasharetitle ); ?>" /></p>
	<p>URL for Sharing:<br /><input type="text" name="acg_gi_patients_cpt_metashareurl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_metashareurl ); ?>" /></p>
	<p>Image URL for Sharing:<br /><input type="text" name="acg_gi_patients_cpt_metashareimageurl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_metashareimageurl ); ?>" /></p>
	<p><label for="acg_gi_patients_cpt_metasharedescription">Description For Sharing</label><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_metasharedescription" id="acg_gi_patients_cpt_metasharedescription"><?php echo esc_html( $acg_gi_patients_cpt_metasharedescription ); ?></textarea></p>
	<?php
}
function acg_gi_patients_cpt_patientnews_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_external_link = get_post_meta( $post->ID, '_acg_gi_patients_cpt_external_link', true );

	?>
	<p>External Link:<br /><input type="text" name="acg_gi_patients_cpt_external_link" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_external_link ); ?>" /></p>
	<?php
}

function acg_gi_patients_cpt_topics_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_healthcenter = get_post_meta( $post->ID, '_acg_gi_patients_cpt_healthcenter', true );
	$acg_gi_patients_cpt_showinmenu = get_post_meta( $post->ID, '_acg_gi_patients_cpt_showinmenu', true );
	$acg_gi_patients_cpt_giprocedure = get_post_meta( $post->ID, '_acg_gi_patients_cpt_giprocedure', true );
	
	wp_register_script("acg_gi_patients_js", plugins_url(basename(dirname(__FILE__))) . "/js/acg_gi_patients.js", null, "1.0");
	wp_print_scripts(array("jquery-ui-core","jquery-ui-sortable","acg_gi_patients_js"));

	echo acg_gi_patients_cpt_topics_dropdown( $post );
	?>
	<p><input type="hidden" name="acg_gi_patients_cpt_healthcenter" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_healthcenter" id="acg_gi_patients_cpt_healthcenter" value="healthcenter" <?php checked( $acg_gi_patients_cpt_healthcenter, 'healthcenter' ); ?> /> <label for="acg_gi_patients_cpt_healthcenter">Is a GI Health Center</label></p>
	<p><input type="hidden" name="acg_gi_patients_cpt_giprocedure" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_giprocedure" id="acg_gi_patients_cpt_giprocedure" value="giprocedure" <?php checked( $acg_gi_patients_cpt_giprocedure, 'giprocedure' ); ?> /> <label for="acg_gi_patients_cpt_giprocedure">Is a GI Procedure</label></p>
	<p><input type="hidden" name="acg_gi_patients_cpt_showinmenu" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_showinmenu" id="acg_gi_patients_cpt_showinmenu" value="showinmenu" <?php checked( $acg_gi_patients_cpt_showinmenu, 'showinmenu' ); ?> /> <label for="acg_gi_patients_cpt_showinmenu">Show in Menu</label></p>
	<?php
}

function acg_gi_patients_cpt_topics_main_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_includemain = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includemain', true );
	$acg_gi_patients_cpt_includepromos = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includepromos', true );
	$acg_gi_patients_cpt_promos_items = get_post_meta( $post->ID, '_acg_gi_patients_cpt_promos_items', true );
	$acg_gi_patients_cpt_main_maintabcontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_main_maintabcontent', true );

	if($acg_gi_patients_cpt_promos_items == ""){
		$acg_gi_patients_cpt_promos_items = 0;
	}
	?>
	<input type="hidden" id="acg_gi_patients_cpt_promos_items" name="acg_gi_patients_cpt_promos_items" value="<?php echo esc_attr( $acg_gi_patients_cpt_promos_items ); ?>" />
	<p><input type="hidden" name="acg_gi_patients_cpt_includemain" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includemain" id="acg_gi_patients_cpt_includemain" value="includemain" <?php checked( $acg_gi_patients_cpt_includemain, 'includemain' ); ?> /> <label for="acg_gi_patients_cpt_includemain">Include Main Tab</label></p>
	<p>Main Tab Content (below promos):<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_main_maintabcontent" id="acg_gi_patients_cpt_main_maintabcontent"><?php echo wp_kses_post( $acg_gi_patients_cpt_main_maintabcontent ); ?></textarea></p>
	<p><input type="hidden" name="acg_gi_patients_cpt_includepromos" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includepromos" id="acg_gi_patients_cpt_includepromos" value="includepromos" <?php checked( $acg_gi_patients_cpt_includepromos, 'includepromos' ); ?> /> <label for="acg_gi_patients_cpt_includepromos">Include Promo Rotator</label></p>
	<p><a href="#" id="acg_gi_patients_cpt_promos_add">Add Promo</a></p>
	<?php
	$i = 0;
    while ($i != $acg_gi_patients_cpt_promos_items){
    	$i++;
		$promohtml = get_post_meta( $post->ID, '_acg_gi_patients_cpt_promos_promocontent_'.$i, true );
		if( strlen($promohtml) > 0 ){
			echo '<p>Promo HTML:<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_promos_promocontent_'.$i.'" id="acg_gi_patients_cpt_promos_promocontent_'.$i.'">'.$promohtml.'</textarea></p>';
		}
    }
}

function acg_gi_patients_cpt_topics_basics_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_includebasics = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includebasics', true );
	$acg_gi_patients_cpt_basics_items = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_items', true );

	if($acg_gi_patients_cpt_basics_items == ""){
		$acg_gi_patients_cpt_basics_items = 0;
	}
	?>
	<p><a href="#" id="acg_gi_patients_cpt_basics_add">Add Basics Section</a></p>
	<input type="hidden" id="acg_gi_patients_cpt_basics_items" name="acg_gi_patients_cpt_basics_items" value="<?php echo esc_attr( $acg_gi_patients_cpt_basics_items ); ?>" />
	<p><input type="hidden" name="acg_gi_patients_cpt_includebasics" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includebasics" id="acg_gi_patients_cpt_includebasics" value="includebasics" <?php checked( $acg_gi_patients_cpt_includebasics, 'includebasics' ); ?> /> <label for="acg_gi_patients_cpt_includebasics">Include Basics Tab</label></p>
	<?php
	$i = 0;
    while ($i != $acg_gi_patients_cpt_basics_items){
    	$i++;
		$sectiontitle = esc_attr( get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectionname_'.$i, true ) );
		$sectioncontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i, true );
		if( strlen($sectiontitle) > 0 && strlen($sectioncontent) > 0 ){
			echo '<p>Section Title:<br /><input type="text" name="acg_gi_patients_cpt_basics_sectionname_'.$i.'" style="width: 98%;" value="'.$sectiontitle.'" /><br />Section Content<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_basics_sectioncontent_'.$i.'" id="acg_gi_patients_cpt_basics_sectioncontent_'.$i.'">'.$sectioncontent.'</textarea></p>';
		}
    }
}

function acg_gi_patients_cpt_topics_faqs_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_includefaqs = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includefaqs', true );
	$acg_gi_patients_cpt_faqs_items = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_items', true );

	if($acg_gi_patients_cpt_faqs_items == ""){
		$acg_gi_patients_cpt_faqs_items = 0;
	}
	?>
	<p><a href="#" id="acg_gi_patients_cpt_faqs_add">Add FAQs Question</a></p>
	<input type="hidden" id="acg_gi_patients_cpt_faqs_items" name="acg_gi_patients_cpt_faqs_items" value="<?php echo esc_attr( $acg_gi_patients_cpt_faqs_items ); ?>" />
	<p><input type="hidden" name="acg_gi_patients_cpt_includefaqs" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includefaqs" id="acg_gi_patients_cpt_includefaqs" value="includefaqs" <?php checked( $acg_gi_patients_cpt_includefaqs, 'includefaqs' ); ?> /> <label for="acg_gi_patients_cpt_includefaqs">Include FAQs Tab</label></p>
	<?php
	$i = 0;
    while ($i != $acg_gi_patients_cpt_faqs_items){
    	$i++;
		$question = esc_attr( get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_question_'.$i, true ) );
		$answer = get_post_meta( $post->ID, '_acg_gi_patients_cpt_faqs_answer_'.$i, true );
		if( strlen($question) > 0 && strlen($answer) > 0 ){
			echo '<p>Question:<br /><input type="text" name="acg_gi_patients_cpt_faqs_question_'.$i.'" style="width: 98%;" value="'.$question.'" /><br />Answer<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_faqs_answer_'.$i.'" id="acg_gi_patients_cpt_faqs_answer_'.$i.'">'.$answer.'</textarea></p>';
		}
    }
}

function acg_gi_patients_cpt_topics_podcastsvideos_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_includepodcastsvideos = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includepodcastsvideos', true );
	$acg_gi_patients_cpt_topics_podcast_header = get_post_meta( $post->ID, '_acg_gi_patients_cpt_topics_podcast_header', true );
	$acg_gi_patients_cpt_topics_podcast_intro = get_post_meta( $post->ID, '_acg_gi_patients_cpt_topics_podcast_intro', true );

	?>
	<p><input type="hidden" name="acg_gi_patients_cpt_includepodcastsvideos" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includepodcastsvideos" id="acg_gi_patients_cpt_includepodcastsvideos" value="includepodcastsvideos" <?php checked( $acg_gi_patients_cpt_includepodcastsvideos, 'includepodcastsvideos' ); ?> /> <label for="acg_gi_patients_cpt_includepodcastsvideos">Include Podcasts/Videos Tab</label></p>
	<p>Podcasts/Videos Header:<br /><input type="text" name="acg_gi_patients_cpt_topics_podcast_header" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_topics_podcast_header ); ?>" /></p>
	<p>Podcasts/Videos Intro:<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_topics_podcast_intro" id="acg_gi_patients_cpt_topics_podcast_intro"><?php echo wp_kses_post( $acg_gi_patients_cpt_topics_podcast_intro ); ?></textarea></p>
	<?php
}

function acg_gi_patients_cpt_topics_resources_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_includeresources = get_post_meta( $post->ID, '_acg_gi_patients_cpt_includeresources', true );
	$acg_gi_patients_cpt_resources_items = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_items', true );

	if($acg_gi_patients_cpt_resources_items == ""){
		$acg_gi_patients_cpt_resources_items = 0;
	}
	?>
	<p><a href="#" id="acg_gi_patients_cpt_resources_add">Add Resources Section</a></p>
	<input type="hidden" id="acg_gi_patients_cpt_resources_items" name="acg_gi_patients_cpt_resources_items" value="<?php echo esc_attr( $acg_gi_patients_cpt_resources_items ); ?>" />
	<p><input type="hidden" name="acg_gi_patients_cpt_includeresources" value="0" /><input type="checkbox" name="acg_gi_patients_cpt_includeresources" id="acg_gi_patients_cpt_includeresources" value="includeresources" <?php checked( $acg_gi_patients_cpt_includeresources, 'includeresources' ); ?> /> <label for="acg_gi_patients_cpt_includeresources">Include Resources Tab</label></p>
	<?php
	$i = 0;
    while ($i != $acg_gi_patients_cpt_resources_items){
    	$i++;
		$resourcestitle = esc_attr( get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcesname_'.$i, true ) );
		$resourcescontent = get_post_meta( $post->ID, '_acg_gi_patients_cpt_resources_resourcescontent_'.$i, true );
		if( strlen($resourcestitle) > 0 && strlen($resourcescontent) > 0 ){
			echo '<p>Resources Title:<br /><input type="text" name="acg_gi_patients_cpt_resources_resourcesname_'.$i.'" style="width: 98%;" value="'.$resourcestitle.'" /><br />Resources Content<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_resources_resourcescontent_'.$i.'" id="acg_gi_patients_cpt_resources_resourcescontent_'.$i.'">'.$resourcescontent.'</textarea></p>';
		}
    }
}

function acg_gi_patients_cpt_topics_select_field( $post ){

	$acg_gi_patients_cpt_topic = unserialize(get_post_meta( $post->ID, '_acg_gi_patients_cpt_topic', true ));

	global $wpdb;
		
	$sql = 	"SELECT id,post_title 
			FROM $wpdb->posts
			WHERE post_type = 'topics' and post_status='publish'
			ORDER BY post_title ASC";
		
	$results = $wpdb->get_results( $sql, OBJECT );
	
	$acg_gi_patients_cpt_topics_select_field='';
	$acg_gi_patients_cpt_topics_select_field.='<p>Digestive Health Topics</p>'; 
	$acg_gi_patients_cpt_topics_select_field.='<p><input type="hidden" name="acg_gi_patients_cpt_topic" value="0" />';
	foreach( $results as $option ){
		$topicid = $option->id;
		$topictitle = $option->post_title;
		$acg_gi_patients_cpt_topics_select_field.='<input id="acg_gi_patients_cpt_topic_'.$topicid.'" name="acg_gi_patients_cpt_topic[]" type="checkbox" value="'.$topicid.'" ';
		if(is_array($acg_gi_patients_cpt_topic)){
			if(in_array($topicid, $acg_gi_patients_cpt_topic)){
				$acg_gi_patients_cpt_topics_select_field.=' checked="checked"';
			}
		}
		$acg_gi_patients_cpt_topics_select_field.=' /><label for="acg_gi_patients_cpt_topic_'.$topicid.'">'.$topictitle.'</label>&nbsp;';
	}
	$acg_gi_patients_cpt_topics_select_field.='</p>';
		
	return $acg_gi_patients_cpt_topics_select_field;

}

function acg_gi_patients_cpt_topics_dropdown( $post ){

	$acg_gi_patients_cpt_topic_redirect = get_post_meta( $post->ID, '_acg_gi_patients_cpt_topic_redirect', true );

	global $wpdb;
		
	$sql = 	"SELECT id,post_title 
			FROM $wpdb->posts
			WHERE post_type = 'topics' and post_status='publish'
			ORDER BY post_title ASC";
		
	$results = $wpdb->get_results( $sql, OBJECT );
	
	$acg_gi_patients_cpt_topics_dropdown='';
	$acg_gi_patients_cpt_topics_dropdown.='<p>Redirect to Following Health Topic (do not fill anything else out if you are choosing this option)</p>'; 
	$acg_gi_patients_cpt_topics_dropdown.='<p><select name="acg_gi_patients_cpt_topic_redirect"><option value="xx">Select a Topic</option>';
	foreach( $results as $option ){
		$topicid = $option->id;
		$topictitle = $option->post_title;
		$acg_gi_patients_cpt_topics_dropdown.='<option value="'.$topicid.'"';
		if($acg_gi_patients_cpt_topic_redirect == $topicid){
			$acg_gi_patients_cpt_topics_dropdown.=' selected="selected"';
		}
		$acg_gi_patients_cpt_topics_dropdown.='>'.$topictitle.'</option>';
	}
	$acg_gi_patients_cpt_topics_dropdown.='</select>';
		
	return $acg_gi_patients_cpt_topics_dropdown;

}

function acg_gi_patients_cpt_podcasts_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_external_link = get_post_meta( $post->ID, '_acg_gi_patients_cpt_external_link', true );
	$acg_gi_patients_cpt_podcast_presenter = get_post_meta( $post->ID, '_acg_gi_patients_cpt_podcast_presenter', true );

	?>
	<p>External Link:<br /><input type="text" name="acg_gi_patients_cpt_external_link" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_external_link ); ?>" /></p>
	<p>Podcast Presenter:<br /><input type="text" name="acg_gi_patients_cpt_podcast_presenter" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_podcast_presenter ); ?>" /></p>
	<?php
	echo acg_gi_patients_cpt_topics_select_field( $post );
}

function acg_gi_patients_cpt_videos_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_patients_cpt_video_external_link = get_post_meta( $post->ID, '_acg_gi_patients_cpt_video_external_link', true );
	$acg_gi_patients_cpt_video_presenter = get_post_meta( $post->ID, '_acg_gi_patients_cpt_video_presenter', true );

	?>
	<p>External Link:<br /><input type="text" name="acg_gi_patients_cpt_video_external_link" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_video_external_link ); ?>" /></p>
	<p>Video Presenter:<br /><input type="text" name="acg_gi_patients_cpt_video_presenter" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_patients_cpt_video_presenter ); ?>" /></p>
	<?php
	echo acg_gi_patients_cpt_topics_select_field( $post );
}

function acg_gi_patients_cpt_save_meta( $post_id ){

/*
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	die();
*/

	//verify the metadata is set
	if( isset( $_POST['acg_gi_patients_cpt_topic'] ) ){
	
		if($_POST['acg_gi_patients_cpt_topic'] == "0"){

			//save the metadata
			update_post_meta( $post_id, '_acg_gi_patients_cpt_topic', "" );

		}else{

			//save the metadata
			update_post_meta( $post_id, '_acg_gi_patients_cpt_topic', serialize($_POST['acg_gi_patients_cpt_topic']) );

		}
	
	}

    if( isset( $_POST['acg_gi_patients_cpt_metasharetitle'] ) ){

        //save the metadata
        update_post_meta( $post_id, '_acg_gi_patients_cpt_metasharetitle', strip_tags( $_POST['acg_gi_patients_cpt_metasharetitle'] ) );

    }

    if( isset( $_POST['acg_gi_patients_cpt_metashareurl'] ) ){

        //save the metadata
        update_post_meta( $post_id, '_acg_gi_patients_cpt_metashareurl', strip_tags( $_POST['acg_gi_patients_cpt_metashareurl'] ) );

    }

    if( isset( $_POST['acg_gi_patients_cpt_metashareimageurl'] ) ){

        //save the metadata
        update_post_meta( $post_id, '_acg_gi_patients_cpt_metashareimageurl', strip_tags( $_POST['acg_gi_patients_cpt_metashareimageurl'] ) );

    }

    if( isset( $_POST['acg_gi_patients_cpt_metasharedescription'] ) ){

        //save the metadata
        update_post_meta( $post_id, '_acg_gi_patients_cpt_metasharedescription', strip_tags( $_POST['acg_gi_patients_cpt_metasharedescription'] ) );

    }

	if( isset( $_POST['acg_gi_patients_cpt_external_link'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_external_link', strip_tags( $_POST['acg_gi_patients_cpt_external_link'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_podcast_presenter'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_podcast_presenter', strip_tags( $_POST['acg_gi_patients_cpt_podcast_presenter'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_healthcenter'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_healthcenter', strip_tags( $_POST['acg_gi_patients_cpt_healthcenter'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_showinmenu'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_showinmenu', strip_tags( $_POST['acg_gi_patients_cpt_showinmenu'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_giprocedure'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_giprocedure', strip_tags( $_POST['acg_gi_patients_cpt_giprocedure'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_includemain'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includemain', strip_tags( $_POST['acg_gi_patients_cpt_includemain'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_includepromos'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includepromos', strip_tags( $_POST['acg_gi_patients_cpt_includepromos'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_includebasics'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includebasics', strip_tags( $_POST['acg_gi_patients_cpt_includebasics'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_main_maintabcontent'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_main_maintabcontent', wp_kses_post( $_POST['acg_gi_patients_cpt_main_maintabcontent'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_promos_items'] ) ){
		
		update_post_meta( $post_id, '_acg_gi_patients_cpt_promos_items', strip_tags( $_POST['acg_gi_patients_cpt_promos_items'] ) );
		$acg_gi_patients_cpt_promos_items = intval($_POST['acg_gi_patients_cpt_promos_items']);

		$i = 0;
	    while ($i != $acg_gi_patients_cpt_promos_items){
	    	$i++;

			if( isset( $_POST['acg_gi_patients_cpt_promos_promocontent_'.$i] ) ){
				if( (strlen($_POST['acg_gi_patients_cpt_promos_promocontent_'.$i]) > 0) ){
					update_post_meta( $post_id, '_acg_gi_patients_cpt_promos_promocontent_'.$i, wp_kses_post( $_POST['acg_gi_patients_cpt_promos_promocontent_'.$i] ) );
				}elseif( (strlen($_POST['acg_gi_patients_cpt_promos_promocontent_'.$i]) == 0) ){
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_promos_promocontent_'.$i );
				}
			}
	    }
		
	}

	if( isset( $_POST['acg_gi_patients_cpt_basics_items'] ) ){
		
		update_post_meta( $post_id, '_acg_gi_patients_cpt_basics_items', strip_tags( $_POST['acg_gi_patients_cpt_basics_items'] ) );
		$acg_gi_patients_cpt_basics_items = intval($_POST['acg_gi_patients_cpt_basics_items']);

		$i = 0;
	    while ($i != $acg_gi_patients_cpt_basics_items){
	    	$i++;
/*
	    	var_dump($_POST['acg_gi_patients_cpt_basics_sectionname_'.$i]);
	    	die();
*/
			if( isset( $_POST['acg_gi_patients_cpt_basics_sectionname_'.$i] ) && isset( $_POST['acg_gi_patients_cpt_basics_sectioncontent_'.$i] ) ){
				if( (strlen($_POST['acg_gi_patients_cpt_basics_sectionname_'.$i]) > 0) && (strlen($_POST['acg_gi_patients_cpt_basics_sectioncontent_'.$i]) > 0) ){
					update_post_meta( $post_id, '_acg_gi_patients_cpt_basics_sectionname_'.$i, strip_tags( $_POST['acg_gi_patients_cpt_basics_sectionname_'.$i] ) );
					update_post_meta( $post_id, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i, wp_kses_post( $_POST['acg_gi_patients_cpt_basics_sectioncontent_'.$i] ) );
				}elseif( (strlen($_POST['acg_gi_patients_cpt_basics_sectionname_'.$i]) == 0) && (strlen($_POST['acg_gi_patients_cpt_basics_sectioncontent_'.$i]) == 0) ){
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_basics_sectionname_'.$i );
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_basics_sectioncontent_'.$i );
				}
			}
	    }
		
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_includefaqs'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includefaqs', strip_tags( $_POST['acg_gi_patients_cpt_includefaqs'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_faqs_items'] ) ){
		
		update_post_meta( $post_id, '_acg_gi_patients_cpt_faqs_items', strip_tags( $_POST['acg_gi_patients_cpt_faqs_items'] ) );
		$acg_gi_patients_cpt_faqs_items = intval($_POST['acg_gi_patients_cpt_faqs_items']);

		$i = 0;
	    while ($i != $acg_gi_patients_cpt_faqs_items){
	    	$i++;
/*
	    	var_dump($_POST['acg_gi_patients_cpt_faqs_question_'.$i]);
	    	die();
*/
			if( isset( $_POST['acg_gi_patients_cpt_faqs_question_'.$i] ) && isset( $_POST['acg_gi_patients_cpt_faqs_answer_'.$i] ) ){
				if( (strlen($_POST['acg_gi_patients_cpt_faqs_question_'.$i]) > 0) && (strlen($_POST['acg_gi_patients_cpt_faqs_answer_'.$i]) > 0) ){
					update_post_meta( $post_id, '_acg_gi_patients_cpt_faqs_question_'.$i, strip_tags( $_POST['acg_gi_patients_cpt_faqs_question_'.$i] ) );
					update_post_meta( $post_id, '_acg_gi_patients_cpt_faqs_answer_'.$i, wp_kses_post( $_POST['acg_gi_patients_cpt_faqs_answer_'.$i] ) );
				}elseif( (strlen($_POST['acg_gi_patients_cpt_faqs_question_'.$i]) == 0) && (strlen($_POST['acg_gi_patients_cpt_faqs_answer_'.$i]) == 0) ){
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_faqs_question_'.$i );
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_faqs_answer_'.$i );
				}
			}
	    }
		
	}

	if( isset( $_POST['acg_gi_patients_cpt_includepodcastsvideos'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includepodcastsvideos', strip_tags( $_POST['acg_gi_patients_cpt_includepodcastsvideos'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_topics_podcast_header'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_topics_podcast_header', strip_tags( $_POST['acg_gi_patients_cpt_topics_podcast_header'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_topics_podcast_intro'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_topics_podcast_intro', wp_kses_post( $_POST['acg_gi_patients_cpt_topics_podcast_intro'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_includeresources'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_includeresources', strip_tags( $_POST['acg_gi_patients_cpt_includeresources'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_resources_items'] ) ){
		
		update_post_meta( $post_id, '_acg_gi_patients_cpt_resources_items', strip_tags( $_POST['acg_gi_patients_cpt_resources_items'] ) );
		$acg_gi_patients_cpt_resources_items = intval($_POST['acg_gi_patients_cpt_resources_items']);

		$i = 0;
	    while ($i != $acg_gi_patients_cpt_resources_items){
	    	$i++;
/*
	    	var_dump($_POST['acg_gi_patients_cpt_basics_sectionname_'.$i]);
	    	die();
*/
			if( isset( $_POST['acg_gi_patients_cpt_resources_resourcesname_'.$i] ) && isset( $_POST['acg_gi_patients_cpt_resources_resourcescontent_'.$i] ) ){
				if( (strlen($_POST['acg_gi_patients_cpt_resources_resourcesname_'.$i]) > 0) && (strlen($_POST['acg_gi_patients_cpt_resources_resourcescontent_'.$i]) > 0) ){
					update_post_meta( $post_id, '_acg_gi_patients_cpt_resources_resourcesname_'.$i, strip_tags( $_POST['acg_gi_patients_cpt_resources_resourcesname_'.$i] ) );
					update_post_meta( $post_id, '_acg_gi_patients_cpt_resources_resourcescontent_'.$i, wp_kses_post( $_POST['acg_gi_patients_cpt_resources_resourcescontent_'.$i] ) );
				}elseif( (strlen($_POST['acg_gi_patients_cpt_resources_resourcesname_'.$i]) == 0) && (strlen($_POST['acg_gi_patients_cpt_resources_resourcescontent_'.$i]) == 0) ){
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_resources_resourcesname_'.$i );
					delete_post_meta( $post_id, '_acg_gi_patients_cpt_resources_resourcescontent_'.$i );
				}
			}
	    }
		
	}
	
	if( isset( $_POST['acg_gi_patients_cpt_video_external_link'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_video_external_link', strip_tags( $_POST['acg_gi_patients_cpt_video_external_link'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_video_presenter'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_video_presenter', strip_tags( $_POST['acg_gi_patients_cpt_video_presenter'] ) );
	
	}

	if( isset( $_POST['acg_gi_patients_cpt_topic_redirect'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_topic_redirect', strip_tags( $_POST['acg_gi_patients_cpt_topic_redirect'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_patients_cpt_external_link'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_patients_cpt_external_link', strip_tags( $_POST['acg_gi_patients_cpt_external_link'] ) );
	
	}

}

?>
