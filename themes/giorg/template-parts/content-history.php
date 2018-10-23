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
    width: 800px;
    height: 350px;
    overflow: hidden;
    margin: 100px auto;
    position: relative;
  }
    #dates {
      width: 800px;
      height: 60px;
      overflow: hidden;
    }
      #dates li {
        list-style: none;
        float: left;
        width: 100px;
        height: 50px;
        font-size: 24px;
        text-align: center;
      }
        #dates a {
          line-height: 38px;
          padding-bottom: 10px;
        }
        #dates .selected {
              font-size: 38px;
        }
    
    #issues {
      width: 800px;
      height: 350px;
      overflow: hidden;
    } 
      #issues li {
        width: 800px;
        height: 350px;
        list-style: none;
        float: left;
      }
        #issues li.selected img {
          transform: scale(1.1,1.1);
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
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div id="timeline">

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

			<h2><?php echo $history_year; ?></h2>

			<p><?php echo $history_description; ?></p>

			<?php if ( have_rows( 'history_images' ) ) : 
				while ( have_rows( 'history_images' ) ) : the_row();
					$history_image = get_sub_field('history_image');
					$history_caption = get_sub_field('history_caption');
					$history_image_size = $history_image['sizes'][ 'large' ]; // Use the 'large' size version rather than the original, in case the original is HUGE 
			?>

				<?php if($history_image): echo '<img src="' . $history_image_size. '">'; endif; ?>

				<?php if($history_caption): echo '<p>' . $history_caption. '</p>'; endif; ?>

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

</article><!-- #post-<?php the_ID(); ?> -->
