<section class="mpu mpu-3 <?php if ($mpu_3_box_css):echo $mpu_3_box_css; endif;?>">
	<div class="container">
		<div class="row <?php if (!empty($mpu_3_collapse)): echo 'row-flush'; endif; ?>">
			<div class="col-md-4 display-flex flex-column">
				<div class="card flex-1">
					<?php if($mpu_3_title): echo '<div class="card-header"><h3 class="m-b-0">' . $mpu_3_title . '</h3></div>'; endif; ?>
					<?php $image_att = wp_get_attachment_image_src( $mpu_3_box_1_image, $mpu_3_size ); ?>
						<?php if ($mpu_3_box_1_image): echo '<div class="card-img card-img-top" style="background-image: url( '. $image_att[0] . ')"></div>'; endif; ?>
					<div class="card-block">
						<?php if( $mpu_3_box_1_text ): echo $mpu_3_box_1_text; endif; ?>
					</div> 
					<?php if( $mpu_3_box_1_bottom ): echo '<div class="card-footer">' . $mpu_3_box_1_bottom . '</div>'; endif; ?> 
				</div>
			</div>
			<div class="col-md-4 mpu-flex box2">
				<div class="mpu-item-wrap">
					<?php if ($mpu_3_box_2_title):echo '<h3>' . $mpu_3_box_2_title . '</h3>'; endif;?>
					<div class="mpu-item-content-wrap">
						<?php $image_att = wp_get_attachment_image_src( $mpu_3_box_2_image, $mpu_3_size ); ?>
						<?php if ($mpu_3_box_2_image): echo '<div style="background-image: url( '. $image_att[0] . ')" class="mpu-header-image"></div>'; endif; ?>
						<div class="mpu-item-text-btn-wrap">
							<?php if( $mpu_3_box_2_text ): echo $mpu_3_box_2_text; endif; ?>
							<?php if( $mpu_3_box_2_bottom ){
								echo '<a href="' . $mpu_3_box_2_bottom['url'] . '" class="btn btn-color2">' . $mpu_3_box_2_bottom['text'] . '</a>'; 
							}
							?>                                           
						</div>                                    
					</div>  
				</div>
			</div>
			<div class="col-md-4 mpu-flex box3">
				<div class="mpu-item-wrap">
					<?php if ($mpu_3_box_3_title):echo '<h3>' . $mpu_3_box_3_title . '</h3>'; endif;?>
					<div class="mpu-item-content-wrap">
						<?php $image_att = wp_get_attachment_image_src( $mpu_3_box_3_image, $mpu_3_size ); ?>
						<?php if ($mpu_3_box_3_image): echo '<div style="background-image: url( '. $image_att[0] . ')" class="mpu-header-image"></div>'; endif; ?>
						<div class="mpu-item-text-btn-wrap">
							<?php if( $mpu_3_box_3_text ): echo $mpu_3_box_3_text; endif; ?>
							<?php if( $mpu_3_box_3_bottom ){
								echo '<a href="' . $mpu_3_box_3_bottom['url'] . '" class="btn btn-color2">' . $mpu_3_box_3_bottom['text'] . '</a>'; 
							}
							?>                                           
						</div>                                    
					</div>  
				</div>
			</div>
		</div>
	</div>
</section>