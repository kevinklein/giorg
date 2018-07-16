<?php
/*
Plugin Name: ACG GI Custom Post Types Plugin
Description: Adds Custom Post Types
Version: 0.1
Author: RCS Apps/Matt Wood
*/

/* Set up the post types */
add_action( 'init', 'acg_gi_cpt_register_post_types' );
add_action( 'add_meta_boxes', 'acg_gi_cpt_create' );
add_action( 'save_post', 'acg_gi_cpt_save_meta' );


/* register post types */
function acg_gi_cpt_register_post_types(){
	
	/* set up the arguments for the 'news' post type */
	$news_args = array(
		'public' => true,
		'query_var' => 'news',
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
			'name' => 'News',
			'singular_name' => 'News Article',
			'add_new' => 'Add New News Article',
			'add_new_item' => 'Add New News Article',
			'edit_item' => 'Edit News Article',
			'new_item' => 'New News Article',
			'view_item' => 'View News Article',
			'search_items' => 'Search News',
			'not_found' => 'No News Found',
			'not_found_in_trash' => 'No News Articles Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'news', $news_args );

	/* set up the arguments for the 'event' post type */
	$event_args = array(
		'public' => true,
		'query_var' => 'events',
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
			'name' => 'Events',
			'singular_name' => 'Event',
			'add_new' => 'Add New Event',
			'add_new_item' => 'Add New Event',
			'edit_item' => 'Edit Event',
			'new_item' => 'New Event',
			'view_item' => 'View Event',
			'search_items' => 'Search Events',
			'not_found' => 'No Events Found',
			'not_found_in_trash' => 'No Events Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'event', $event_args );

	/* set up the arguments for the 'event' post type */
	$guideline_args = array(
		'public' => true,
		'query_var' => 'guidelines',
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
			'name' => 'Guidelines',
			'singular_name' => 'Guideline',
			'add_new' => 'Add New Guideline',
			'add_new_item' => 'Add New Guideline',
			'edit_item' => 'Edit Guideline',
			'new_item' => 'New Guideline',
			'view_item' => 'View Guideline',
			'search_items' => 'Search Guidelines',
			'not_found' => 'No Guidelines Found',
			'not_found_in_trash' => 'No Guidelines Found In Trash'
		),
	);
	
	/* Register the document post type. */
	register_post_type( 'guideline', $guideline_args );

	flush_rewrite_rules( false );

}

function acg_gi_cpt_create(){
	
	//create a custom meta box
	add_meta_box( 'acg_gi_cpt_meta_news', 'News Details', 'acg_gi_cpt_news_meta_function', 'news', 'normal', 'high' );
	add_meta_box( 'acg_gi_cpt_meta_event', 'Event Details', 'acg_gi_cpt_event_meta_function', 'event', 'normal', 'high' );
	add_meta_box( 'acg_gi_cpt_meta_page', 'Page Details', 'acg_gi_cpt_page_meta_function', 'page', 'normal', 'high' );
	add_meta_box( 'acg_gi_cpt_meta_guideline', 'Guideline Details', 'acg_gi_cpt_guideline_meta_function', 'guideline', 'normal', 'high' );
	
}


function acg_gi_cpt_news_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_cpt_external_link = get_post_meta( $post->ID, '_acg_gi_cpt_external_link', true );

	?>
	<p>External Link:<br /><input type="text" name="acg_gi_cpt_external_link" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_external_link ); ?>" /></p>
	<?php
}

function acg_gi_cpt_event_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_cpt_startdate = get_post_meta( $post->ID, '_acg_gi_cpt_startdate', true );
	$acg_gi_cpt_enddate = get_post_meta( $post->ID, '_acg_gi_cpt_enddate', true );
	$acg_gi_cpt_venue = get_post_meta( $post->ID, '_acg_gi_cpt_venue', true );
	$acg_gi_cpt_location_city = get_post_meta( $post->ID, '_acg_gi_cpt_location_city', true );
	$acg_gi_cpt_location_state = get_post_meta( $post->ID, '_acg_gi_cpt_location_state', true );
	$acg_gi_cpt_reglink = get_post_meta( $post->ID, '_acg_gi_cpt_reglink', true );
	$acg_gi_cpt_infolink = get_post_meta( $post->ID, '_acg_gi_cpt_infolink', true );

	?>
	<p>Start Date:<br /><input type="text" name="acg_gi_cpt_startdate" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_startdate ); ?>" /></p>
	<p>End Date:<br /><input type="text" name="acg_gi_cpt_enddate" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_enddate ); ?>" /></p>
	<p>Venue:<br /><input type="text" name="acg_gi_cpt_venue" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_venue ); ?>" /></p>
	<p>Location City:<br /><input type="text" name="acg_gi_cpt_location_city" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_location_city ); ?>" /></p>
	<p>Location State:<br /><input type="text" name="acg_gi_cpt_location_state" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_location_state ); ?>" /></p>
	<p>Registration Link:<br /><input type="text" name="acg_gi_cpt_reglink" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_reglink ); ?>" /></p>
	<p>Information Link:<br /><input type="text" name="acg_gi_cpt_infolink" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_infolink ); ?>" /></p>
	<?php
}

function acg_gi_cpt_guideline_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_cpt_hashtmlguideline = get_post_meta( $post->ID, '_acg_gi_cpt_hashtmlguideline', true );
	$acg_gi_cpt_titlesortby = get_post_meta( $post->ID, '_acg_gi_cpt_titlesortby', true );
	$acg_gi_cpt_publicationdate = get_post_meta( $post->ID, '_acg_gi_cpt_publicationdate', true );
	$acg_gi_cpt_primaryauthor = get_post_meta( $post->ID, '_acg_gi_cpt_primaryauthor', true );
	$acg_gi_cpt_primaryauthor_last = get_post_meta( $post->ID, '_acg_gi_cpt_primaryauthor_last', true );
	$acg_gi_cpt_secondaryauthors = get_post_meta( $post->ID, '_acg_gi_cpt_secondaryauthors', true );
	$acg_gi_cpt_downloadurl = get_post_meta( $post->ID, '_acg_gi_cpt_downloadurl', true );
	$acg_gi_cpt_decisionsupporttoolurl = get_post_meta( $post->ID, '_acg_gi_cpt_decisionsupporttoolurl', true );
	$acg_gi_cpt_summaryurl = get_post_meta( $post->ID, '_acg_gi_cpt_summaryurl', true );
	$acg_gi_cpt_partnermessage = get_post_meta( $post->ID, '_acg_gi_cpt_partnermessage', true );
	$acg_gi_cpt_updategl = get_post_meta( $post->ID, '_acg_gi_cpt_updategl', true );
	?>
	<p><input type="hidden" name="acg_gi_cpt_hashtmlguideline" value="0" /><input type="checkbox" name="acg_gi_cpt_hashtmlguideline" id="acg_gi_cpt_hashtmlguideline" value="hashtmlguideline" <?php checked( $acg_gi_cpt_hashtmlguideline, 'hashtmlguideline' ); ?> /> <label for="acg_gi_cpt_hashtmlguideline">Has HTML Guideline</label></p>
	<p>Words to sort title by:<br /><input type="text" name="acg_gi_cpt_titlesortby" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_titlesortby ); ?>" /></p>
	<p>Publication Date: (YYYY-MM-DD)<br /><input type="text" name="acg_gi_cpt_publicationdate" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_publicationdate ); ?>" /></p>
	<p>Primary Author:<br /><input type="text" name="acg_gi_cpt_primaryauthor" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_primaryauthor ); ?>" /></p>
	<p>Primary Author Last Name:<br /><input type="text" name="acg_gi_cpt_primaryauthor_last" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_primaryauthor_last ); ?>" /></p>
	<p><label for="acg_gi_cpt_secondaryauthors">Secondary Authors (separate by comma)</label><textarea style="width: 98%;" rows="10" name="acg_gi_cpt_secondaryauthors" id="acg_gi_cpt_secondaryauthors"><?php echo esc_attr( $acg_gi_cpt_secondaryauthors ); ?></textarea></p>
	<p><label for="acg_gi_cpt_partnermessage">Partner Message</label><textarea style="width: 98%;" rows="10" name="acg_gi_cpt_partnermessage" id="acg_gi_cpt_partnermessage"><?php echo esc_attr( $acg_gi_cpt_partnermessage ); ?></textarea></p>
	<p>Download URL:<br /><input type="text" name="acg_gi_cpt_downloadurl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_downloadurl ); ?>" /></p>
	<p>Decision Support Tool URL:<br /><input type="text" name="acg_gi_cpt_decisionsupporttoolurl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_decisionsupporttoolurl ); ?>" /></p>
	<p>PDF of Guideline Summary URL:<br /><input type="text" name="acg_gi_cpt_summaryurl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_summaryurl ); ?>" /></p>
	<p>Update:<br /><input type="text" name="acg_gi_cpt_updategl" style="width: 98%;" value="<?php echo esc_attr( $acg_gi_cpt_updategl ); ?>" /></p>
	
	<?php
}

function acg_gi_cpt_page_meta_function( $post ){

	//retrieve the metadata values if they exist
	$acg_gi_cpt_shownotice = get_post_meta( $post->ID, '_acg_gi_cpt_shownotice', true );
	$acg_gi_cpt_acgmemberonly = get_post_meta( $post->ID, '_acg_gi_cpt_acgmemberonly', true );
	$acg_gi_cpt_rightsidebar = get_post_meta( $post->ID, '_acg_gi_cpt_rightsidebar', true );
	$acg_gi_cpt_metadescription = get_post_meta( $post->ID, '_acg_gi_cpt_metadescription', true );
	$post->page_template = get_post_meta( $post->ID, '_wp_page_template', true );
	?>
	<p><input type="hidden" name="acg_gi_cpt_shownotice" value="0" /><input type="checkbox" name="acg_gi_cpt_shownotice" id="acg_gi_cpt_shownotice" value="shownotice" <?php checked( $acg_gi_cpt_shownotice, 'shownotice' ); ?> /> <label for="acg_gi_cpt_shownotice">Show Notice</label></p>
	<p><input type="hidden" name="acg_gi_cpt_acgmemberonly" value="0" /><input type="checkbox" name="acg_gi_cpt_acgmemberonly" id="acg_gi_cpt_acgmemberonly" value="acgmemberonly" <?php checked( $acg_gi_cpt_acgmemberonly, 'acgmemberonly' ); ?> /> <label for="acg_gi_cpt_acgmemberonly">ACG Members Only</label></p>
	<p><label for="acg_gi_cpt_metadescription">Meta Description</label><textarea style="width: 98%;" rows="10" name="acg_gi_cpt_metadescription" id="acg_gi_cpt_metadescription"><?php echo esc_html( $acg_gi_cpt_metadescription ); ?></textarea></p>
	<?php if($post->page_template == 'template-3column.php'){ ?>
<!--
	<script>
		jQuery(document).ready(function(){
			jQuery("#acg_gi_cpt_rightsidebar");
			if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
				tinyMCE.settings.theme_advanced_buttons1 += ",|,code,add_image,add_video,add_audio,add_media";	
				tinyMCE.execCommand("mceAddControl", false, "acg_gi_cpt_rightsidebar");
			}
		});
	</script>
-->
	<p><label for="acg_gi_cpt_rightsidebar">Right Sidebar</label><textarea style="width: 98%;" rows="10" name="acg_gi_cpt_rightsidebar" id="acg_gi_cpt_rightsidebar"><?php echo esc_html( $acg_gi_cpt_rightsidebar ); ?></textarea></p>
	<p>Example Markup:</p>
	<pre>
		<section class="item">
		&lt;section class=&quot;item&quot;&gt;
			&lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;/wp-content/themes/acg/images/img-gicircle.png&quot; alt=&quot;img-gicircle&quot; width=&quot;195&quot; height=&quot;39&quot; /&gt;&lt;/a&gt;
			&lt;a href=&quot;#&quot; class=&quot;button&quot;&gt;Join Now&lt;/a&gt;&lt;/p&gt;
			&lt;h4&gt;Recent Discussions&lt;/h4&gt;
			&lt;article&gt;
			&lt;h3&gt;&lt;a href=&quot;&quot;&gt;ACG Coding Calculator&lt;/a&gt;&lt;/h3&gt;
			&lt;p&gt;Posted Today at 10:43 AM by Jacqueline Gaulin, ACG Community Team&lt;/p&gt;
			&lt;/article&gt;
			&lt;article&gt;
			&lt;h3&gt;&lt;a href=&quot;&quot;&gt;CPT Coding Updates 2011&lt;/a&gt;&lt;/h3&gt;
			&lt;p&gt;Posted Today at 10:34 AM by Jacqueline Gaulin, ACG Community Team&lt;/p&gt;
			&lt;/article&gt;
			&lt;article&gt;
			&lt;h3&gt;&lt;a href=&quot;&quot;&gt;Calling all GI Coding Experts&lt;/a&gt;&lt;/h3&gt;
			&lt;p&gt;Posted Today at 7:11 AM by Brad Conway, JD&lt;/p&gt;
			&lt;/article&gt;
		&lt;/section&gt;
		&lt;section class=&quot;item&quot;&gt;
			&lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;/wp-content/themes/acg/images/img-smartbrief.png&quot; alt=&quot;img-smartbrief&quot; width=&quot;195&quot; height=&quot;27&quot; /&gt;&lt;/a&gt;&lt;/p&gt;
			&lt;p class=&quot;intro&quot;&gt;News and information  delivered to your inbox twice weekly. For free.&lt;/p&gt;
			&lt;p&gt;&lt;a href=&quot;#&quot; class=&quot;button&quot;&gt;Sign Up Now&lt;/a&gt;&lt;/p&gt;
		&lt;/section&gt;
	</pre>
	<?php } ?>
	<?php
}


function acg_gi_cpt_save_meta( $post_id ){

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_external_link'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_external_link', strip_tags( $_POST['acg_gi_cpt_external_link'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_startdate'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_startdate', strip_tags( $_POST['acg_gi_cpt_startdate'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_enddate'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_enddate', strip_tags( $_POST['acg_gi_cpt_enddate'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_venue'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_venue', strip_tags( $_POST['acg_gi_cpt_venue'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_location_city'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_location_city', strip_tags( $_POST['acg_gi_cpt_location_city'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_location_state'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_location_state', strip_tags( $_POST['acg_gi_cpt_location_state'] ) );
	
	}
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_reglink'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_reglink', strip_tags( $_POST['acg_gi_cpt_reglink'] ) );
	
	}
	
	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_infolink'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_infolink', strip_tags( $_POST['acg_gi_cpt_infolink'] ) );
	
	}
	
	if( isset( $_POST['acg_gi_cpt_shownotice'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_shownotice', strip_tags( $_POST['acg_gi_cpt_shownotice'] ) );
	
	}

	if( isset( $_POST['acg_gi_cpt_acgmemberonly'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_acgmemberonly', strip_tags( $_POST['acg_gi_cpt_acgmemberonly'] ) );
	
	}

	if( isset( $_POST['acg_gi_cpt_rightsidebar'] ) ){

		//allowed html in right sidebar
		$allowed_sidebar = array(
			'section' => array(
				'class' => array()
			),
			'img' => array(
				'src' => array(),
				'alt' => array(),
				'width' => array(),
				'height' => array()
			),
			'a' => array(
				'href' => array(),
				'target' => array(),
				'class' => array(),
				'rel' => array()
			),
			'p' => array(
				'class' => array(),
			),
			'h4' => array(),
			'h3' => array(),
			'article' => array()
		);

		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_rightsidebar', wp_kses( $_POST['acg_gi_cpt_rightsidebar'], $allowed_sidebar ) );
	
	}

	if( isset( $_POST['acg_gi_cpt_metadescription'] ) ){

		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_metadescription', strip_tags( $_POST['acg_gi_cpt_metadescription'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_publicationdate'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_publicationdate', strip_tags( $_POST['acg_gi_cpt_publicationdate'] ) );
	
	}

	if( isset( $_POST['acg_gi_cpt_hashtmlguideline'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_hashtmlguideline', strip_tags( $_POST['acg_gi_cpt_hashtmlguideline'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_titlesortby'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_titlesortby', strip_tags( $_POST['acg_gi_cpt_titlesortby'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_primaryauthor'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_primaryauthor', strip_tags( $_POST['acg_gi_cpt_primaryauthor'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_primaryauthor_last'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_primaryauthor_last', strip_tags( $_POST['acg_gi_cpt_primaryauthor_last'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_secondaryauthors'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_secondaryauthors', strip_tags( $_POST['acg_gi_cpt_secondaryauthors'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_partnermessage'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_partnermessage', strip_tags( $_POST['acg_gi_cpt_partnermessage'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_downloadurl'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_downloadurl', strip_tags( $_POST['acg_gi_cpt_downloadurl'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_decisionsupporttoolurl'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_decisionsupporttoolurl', strip_tags( $_POST['acg_gi_cpt_decisionsupporttoolurl'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_summaryurl'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_summaryurl', strip_tags( $_POST['acg_gi_cpt_summaryurl'] ) );
	
	}

	//verify the metadata is set
	if( isset( $_POST['acg_gi_cpt_updategl'] ) ){
	
		//save the metadata
		update_post_meta( $post_id, '_acg_gi_cpt_updategl', strip_tags( $_POST['acg_gi_cpt_updategl'] ) );
	
	}

}

?>
