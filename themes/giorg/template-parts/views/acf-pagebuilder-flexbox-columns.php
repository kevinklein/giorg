<?php if($flexbox_columns_title): echo '<h3 class="header-full"><span>' . $flexbox_columns_title . '</span></h3>'; endif; ?>

<?php 
$flexbox_columns_wrap_css_class = get_sub_field('flexbox_columns_wrap_css_class');
$flexbox_columns_wrap_inner_css_class = get_sub_field('flexbox_columns_wrap_inner_css_class');
$count = count( get_sub_field( 'flexbox_column_repeater' ) );

?>
<section class="row-container <?php if($flexbox_columns_wrap_css_class): echo $flexbox_columns_wrap_css_class; endif;?>">

	<div class="<?php if($flexbox_columns_wrap_inner_css_class): echo $flexbox_columns_wrap_inner_css_class; endif;?>">

		<?php	
		echo'<div class="row col-count-' . $count . '">';

		if ( have_rows( 'flexbox_column_repeater' ) ) :

		while ( have_rows( 'flexbox_column_repeater' ) ) : the_row();
		// Variables - need to be listed inside 'while have rows'
		$flexbox_column_content = get_sub_field('flexbox_column_content');
		$flexbox_column_css = get_sub_field('flexbox_column_css_class');

		?>
		
			<div class="col <?php if($flexbox_column_css): echo $flexbox_column_css; endif;?>">
				<?php if($flexbox_column_content): echo $flexbox_column_content; endif; ?>
			</div>

		<?php
		endwhile;
		endif; ?>

		</div>

	</div>

</section>