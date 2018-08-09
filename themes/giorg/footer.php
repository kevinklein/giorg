<?php
/**
 * The template for displaying the footer
 *
 * @package giorg
 */

?>

</main><!-- .entry-content -->

<div class="position-relative border-bottom">
	<div class="bg-gray-lightest bg-triangles">
		<div class="container p-y-md text-center">
			<span class="logo-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" class="img-circle" width="50"></span>
			<div class="display-2 text-300">Advancing gastroenterology, improving patient care</div>
		</div>
	</div>
</div>

<div class="bg-gray-lightest text-sm">
    <div class="container">
        <div class="p-y-md site-footer">
            <div class="row row-flex row-bordered">
                <div class="col-md-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
       
                    <?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
            			<?php dynamic_sidebar( 'footer-4' ); ?>
            		<?php } ?>
        
                </div>
                <div class="col-md-2 col-xs-12">
         
                    <?php if ( is_active_sidebar( 'footer-5' ) ) { ?>
            			<?php dynamic_sidebar( 'footer-5' ); ?>
            		<?php } ?>

                    <a href="#" class="display-block text-no-underline m-t">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/meeting2018-black.svg" class="" width="80">
                    </a>
                
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-y bg-white text-sm">
    <div class="container item-flex item-flex-responsive">
        <div class="item-flex-main"> 
            <b>American College of Gastroenterology</b> 6400 Goldsboro Rd, Bethesda, MD 20817 <span class="text-pipe">|</span> (301) 263-9000 <a href="#" class="btn btn-info btn-xs m-l-sm">Email Us</a>
        </div>
        <div class="text-lg">
            <a href="#"><svg class="icon icon-youtube2" style="width: 2.5087890625em;"><use xlink:href="#icon-youtube2"></use></svg></a>
            <a href="#" class="m-x-xs"><svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg></a>
            <a href="#"><svg class="icon icon-facebook"><use xlink:href="#icon-facebook"></use></svg></a>
            <a href="#" class="m-x-xs"><svg class="icon icon-twitter"><use xlink:href="#icon-twitter"></use></svg></a>
            <a href="#"><svg class="icon icon-instagram"><use xlink:href="#icon-instagram"></use></svg></a>
        </div>
    </div>
</div>
<div class="p-y bg-gray-lightest bg-white text-xs">
    <div class="container item-flex item-flex-responsive">
        <span class="text-gray item-flex-main">©2018 American College of Gastroenterology</span>
        <a href="#" class="text-muted text-hover-underline">Terms of Use</a> <span class="text-pipe">|</span> <a href="#" class="text-muted text-hover-underline">Privacy Policy</a>
    </div>
</div>
<a href="#top" class="link-top"><svg class="icon icon-chevron-with-circle-up"><use xlink:href="#icon-chevron-with-circle-up"></use</svg></a>

<?php wp_footer(); ?>

<script>
var ajax = new XMLHttpRequest();
ajax.open("GET", "<?php echo get_template_directory_uri(); ?>/img/symbol-defs.svg", true);
ajax.send();
ajax.onload = function(e) {
  var div = document.createElement("div");
  div.innerHTML = ajax.responseText;
  document.body.insertBefore(div, document.body.childNodes[0]);
}
</script>

</body>
</html>
