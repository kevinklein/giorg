<?php if($flexbox_cards_title): echo '<h3 class="header-full"><span>' . $flexbox_cards_title . '</span></h3>'; endif; ?>

<?php 
$flexbox_cards_wrap_css_class = get_sub_field('flexbox_cards_wrap_css_class');
$flexbox_cards_wrap_inner_css_class = get_sub_field('flexbox_cards_wrap_inner_css_class');
$count = count( get_sub_field( 'flexbox_card_repeater' ) );

?>
<section class="row-container <?php if($flexbox_cards_wrap_css_class): echo $flexbox_cards_wrap_css_class; endif;?>">

	<div class="<?php if($flexbox_cards_wrap_inner_css_class): echo $flexbox_cards_wrap_inner_css_class; endif;?>">

		<?php	
		echo'<div class="row col-count-' . $count . '">';

		if ( have_rows( 'flexbox_card_repeater' ) ) :

		while ( have_rows( 'flexbox_card_repeater' ) ) : the_row();
		// Variables - need to be listed inside 'while have rows'
		$flexbox_card_content = get_sub_field('flexbox_card_content');
		$flexbox_card_bg = get_sub_field('flexbox_card_bg');
		$flexbox_card_class = get_sub_field('flexbox_card_css_class');
		$flexbox_card_img = get_sub_field('flexbox_card_img');
		$flexbox_card_title = get_sub_field('flexbox_card_title');
		$flexbox_card_title_class = get_sub_field('flexbox_card_title_class');
		$flexbox_card_footer = get_sub_field('flexbox_card_footer');
		$flexbox_card_img = get_sub_field('flexbox_card_img');
		$flexbox_card_img_size = $flexbox_card_img['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
		$flexbox_card_img_aspect = get_sub_field('flexbox_card_img_aspect');
		?>
		
			<div class="col display-flex flex-column">
				<div class="card display-flex flex-column flex-1 <?php if($flexbox_card_class): echo $flexbox_card_class; endif;?> <?php if($flexbox_card_bg): echo $flexbox_card_bg; endif;?>">
					<?php if($flexbox_card_title): ?>
						<div class="card-header text-center <?php if($flexbox_card_title_class): echo $flexbox_card_title_class; endif;?>">
							<h3 class="m-b-0 text-inverse">
								<?php echo $flexbox_card_title; ?>
							</h3>
						</div> 
					<?php endif; ?>
					<?php if($flexbox_card_img): ?>
						<div>
							<div class="img-cover img-cover-flex img-cover-flex-<?php echo $flexbox_card_img_aspect; ?>" style="background-image: url(<?php echo $flexbox_card_img_size; ?>);"></div>
						</div>
					<?php endif; ?>
					<?php if($flexbox_card_content): echo '<div class="card-block flex-1">' . $flexbox_card_content. '</div>'; endif; ?>
					<?php if($flexbox_card_footer): echo '<div class="card-footer">' . $flexbox_card_footer . '</div>'; endif; ?>
				</div>
			</div>
		<?php
		endwhile;
		endif; ?>

		</div>

	</div>

</section>