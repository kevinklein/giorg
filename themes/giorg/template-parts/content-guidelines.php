			<?php
				$guidelines = new WP_Query();
				$args = array(
					'post_type' => 'guideline',
					'orderby' => 'meta_value',
					'posts_per_page' => '-1',
					'order' => 'ASC',
					'meta_key' => '_acg_gi_cpt_titlesortby',
					'meta_query' => array(
						array(
							'key' => '_acg_gi_cpt_titlesortby'
						)
					)
				);
				$linkurl = htmlspecialchars(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
				$tablelinks = array(
					'title' => '<a href="'.$linkurl.'?sort=titledesc" class="isasc">',
					'pubdate' => '<a href="'.$linkurl.'?sort=datedesc">',
					'lastname' => '<a href="'.$linkurl.'?sort=lastasc">'
				);
				if( isset($_REQUEST['sort']) ) {
					switch($_REQUEST['sort']){
						case "datedesc":
							$tablelinks = array(
								'title' => '<a href="'.$linkurl.'?sort=titledesc">',
								'pubdate' => '<a href="'.$linkurl.'?sort=dateasc" class="isdesc">',
								'lastname' => '<a href="'.$linkurl.'?sort=lastasc">'
							);
							$args['order'] = 'DESC';
							$args['meta_key'] = '_acg_gi_cpt_publicationdate';
							$args['meta_query'][0]['key'] = '_acg_gi_cpt_publicationdate';
							$args['meta_query'][0]['type'] = 'NUMERIC';
							break;
						case "dateasc":
							$tablelinks = array(
								'title' => '<a href="'.$linkurl.'?sort=titledesc">',
								'pubdate' => '<a href="'.$linkurl.'?sort=datedesc" class="isasc">',
								'lastname' => '<a href="'.$linkurl.'?sort=lastasc">'
							);
							$args['meta_key'] = '_acg_gi_cpt_publicationdate';
							$args['meta_query'][0]['key'] = '_acg_gi_cpt_publicationdate';
							$args['meta_query'][0]['type'] = 'NUMERIC';
							break;
						case "lastdesc":
							$tablelinks = array(
								'title' => '<a href="'.$linkurl.'?sort=titledesc">',
								'pubdate' => '<a href="'.$linkurl.'?sort=datedesc">',
								'lastname' => '<a href="'.$linkurl.'?sort=lastasc" class="isdesc">'
							);
							$args['order'] = 'DESC';
							$args['meta_key'] = '_acg_gi_cpt_primaryauthor_last';
							$args['meta_query'][0]['key'] = '_acg_gi_cpt_primaryauthor_last';
							break;
						case "lastasc":
							$tablelinks = array(
								'title' => '<a href="'.$linkurl.'?sort=titledesc">',
								'pubdate' => '<a href="'.$linkurl.'?sort=datedesc">',
								'lastname' => '<a href="'.$linkurl.'?sort=lastdesc" class="isasc">'
							);
							$args['meta_key'] = '_acg_gi_cpt_primaryauthor_last';
							$args['meta_query'][0]['key'] = '_acg_gi_cpt_primaryauthor_last';
							break;
						case "titledesc":
							$tablelinks = array(
								'title' => '<a href="'.$linkurl.'?sort=titleasc" class="isdesc">',
								'pubdate' => '<a href="'.$linkurl.'?sort=datedesc">',
								'lastname' => '<a href="'.$linkurl.'?sort=lastasc">'
							);
							$args['order'] = 'DESC';
							$args['meta_key'] = '_acg_gi_cpt_titlesortby';
							$args['meta_query'][0]['key'] = '_acg_gi_cpt_titlesortby';
							break;
					}
				}else{
				}
				$guidelines->query($args);
				?>
				<tr>
					<th><?php echo $tablelinks['title']; ?>Title</a></th>
					<th><?php echo $tablelinks['pubdate']; ?>Publication Date</a></th>
					<th><?php echo $tablelinks['lastname']; ?>Primary Author</a></th>
					<th>View</th>
					<th>PDF</th>
					<th>Decision Support Tool</th>
					<th>Summary</th>
					<th>Update</th>
				</tr>
				<?php
				$footnotes = array();
				$footnote = 0;
				$footnoteprn = "";
				while ($guidelines->have_posts()) : $guidelines->the_post();
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
				<tr>
					<td><?php echo $post->boldedtitle; ?>
					<?php 
					if(strlen($post->partnermessage)){ 
						if(!in_array($post->partnermessage, $footnotes)){
							$footnote++;
							$footnotetoprint = $footnote;
							$footnotes[] = $post->partnermessage;
							$footnoteprn.="<p>".$footnotetoprint.". ".$post->partnermessage."</p>";
						}else{
							$footnotetoprint = array_search($post->partnermessage, $footnotes) + 1;
						}
						echo '<sup>'.$footnotetoprint.'</sup>'; 
					}?></td>
					<td><?php echo $post->displaydatepublicationdate; ?></td>
					<td><?php echo $post->primaryauthor; ?></td>
                    <td>
                    <?php if ($post->hashtmlguideline === 'hashtmlguideline') { ?>
					<a href="<?php the_permalink(); ?>">Read</a></td>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if (strlen($post->downloadurl) > 0) { ?>
                    <a href="<?php echo $post->downloadurl; ?>" target="_blank">PDF</a>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if (strlen($post->decisionsupporttoolurl) > 0) { ?>
                    <a href="<?php echo $post->decisionsupporttoolurl; ?>" target="_blank">Decision Support Tool</a>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if (strlen($post->summaryurl) > 0) { ?>
                    <a href="<?php echo $post->summaryurl; ?>" target="_blank">Summary</a>
                    <?php } ?>
                    </td>
					<td><?php echo $post->updategl; ?></td>
				</tr>
			<?php endwhile; ?>
			<?php	wp_reset_query(); ?>
			</table>
			<h2>Footnotes</h2>
			<?php echo $footnoteprn; ?>
			</div>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
			</article>
<?php endwhile; // end of the loop. ?>