<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package giorg
 */

?>


<style>
#timeline {
    overflow: hidden;
    margin: 0 0 ;
    position: relative;
	
  }
    #dates {
	  align-items: center;
	  display: flex;
	  margin: 0;
	  padding: 25px 0 5px;
	  width: 800px;
	  position: relative;
    }
	#dates::after {
		border-bottom: 2px dotted #fff;
		content: '';
		height: 1px;
		position: absolute;
		bottom: 0;
		left: 50px;
		right: 0;
	}
	#dates::before {

	}
      #dates li {
		display: flex;
		align-items: center;
		justify-content: center;
		height: 40px;
        list-style: none;
		margin: 0;
	    padding: 0;
        width: 100px;
        font-size: 16px;
		position: relative;
        text-align: center;
		z-index: 2;
      }
	  #dates li::before {
		background: #8097B6;
		border-radius: 50%;
		content: '';
		height: 14px;
		width: 14px;
		position: absolute;
		bottom: -11px;
		left: calc(50% - 5px);
		right: 0;
	  }
	  #dates li::after {
		background: #fff;
		border-radius: 50%;
		content: '';
		height: 8px;
		width: 8px;
		position: absolute;
		bottom: -8px;
		left: calc(50% - 2px);
		right: 0;
	  }
	  #dates li + li {
		  margin-top: 0;
	  }
        #dates a {
			color: rgba(255,255,255,.6);
        }
        #dates .selected {
			color: #fff;
            font-size: 24px;
        }
		/* #dates .selected::after {
			content: ' ';
			height: 0;
			position: absolute;
			bottom: 0;
			width: 0;
			border: 10px solid transparent; 
			border-top-color: #fff;
		} */
    
    #issues {
     
    } 
      #issues li {
        width: 800px;
        list-style: none;
        float: left;
		opacity: 0 !important;
      }
	  #issues li.selected {
		  opacity: 1 !important;
	  }
        #issues li.selected img {
          
        }
        #issues li img {
          
        }
        #issues li h1 {
          
        }
        #issues li p {
          
        }
    
    #grad_left,
    #grad_right {
      width: 100px;
      height: 350px;
      position: absolute;
      top: 0;
    }
      #grad_left {
            left: 0;
            background: url('../images/grad_left.png') repeat-y;
      }
      #grad_right {
            right: 0;
            background: url('../images/grad_right.png') repeat-y;
      }
    
    #next,
    #prev {
      position: absolute;
      top: 0;
      font-size: 70px;
      top: 170px;
      width: 22px;
      height: 38px;
      background-position: 0 0;
      background-repeat: no-repeat;
      text-indent: -9999px;
      overflow: hidden;
    }
      #next:hover,
      #prev:hover {
        background-position: 0 -76px;
      }
      #next {
        right: 0;
        background-image: url('../images/next.png');
      }
      #prev {
        left: 0;
        background-image: url('../images/prev.png');
      }
        #next.disabled,
        #prev.disabled {
          opacity: 0.2;
        }
	.history-hero {
		background: url(/wp-content/themes/giorg/img/history-bg.jpg) no-repeat 50% 50%;
		background-size: cover;
	}
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="history-hero">
		<div class="container text-center">
			<img src="/wp-content/themes/giorg/img/history-bg-text.png" width="90%">
		</div>
	</div>

	<div id="timeline">

		<div class="bg-primary-lighter text-inverse">
			<div class="container p-b-md p-x-xl position-relative">
				<div class="m-x-xl overflow-hidden p-b-sm">
				<ul id="dates">

				<?php

					if( have_rows('history_slide') ):

					$count = 0;

						// loop through the slides
						while ( have_rows('history_slide') ) : the_row();
					
							// Variables
							$history_year = get_sub_field('history_year'); 

				?>

				<li><a href="#"><?php echo $history_year; ?></a></li>

				<?php
					
					endwhile;

					else :

						// no layouts found

					endif;

				?>

				</ul>
				</div>

			</div>
		</div>

		<div class="container-sm p-t-lg">
			<ul id="issues">

			<?php

				if( have_rows('history_slide') ):

				$count = 0;

					// loop through the slides
					while ( have_rows('history_slide') ) : the_row();
						
						// set counter
						$count++;
				
						// Variables
						$history_year = get_sub_field('history_year'); 
						$history_description = get_sub_field('history_description');

			?>

			<li id="<?php echo $history_year; ?>">

				<p><?php echo $history_description; ?></p>

				<?php if ( have_rows( 'history_images' ) ) : 
					while ( have_rows( 'history_images' ) ) : the_row();
						$history_image = get_sub_field('history_image');
						$history_caption = get_sub_field('history_caption');
						$history_image_size = $history_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
				?>

					<?php if($history_image): echo '<div class="text-center"><img src="' . $history_image_size. '"></div>'; endif; ?>

					<?php if($history_caption): echo '<p class="m-y-sm text-muted text-sm text-center">' . $history_caption. '</p>'; endif; ?>

				<?php endwhile; endif; ?>

			</li>

		<?php
			
			endwhile;

			else :

				// no layouts found

			endif;

		?>

			</ul>

			<a href="#" id="next">+</a> <!-- optional -->
			<a href="#" id="prev">-</a> <!-- optional -->
		
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
