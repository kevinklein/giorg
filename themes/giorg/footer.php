<?php
/**
 * The template for displaying the footer
 *
 * @package giorg
 */

?>

</main><!-- .entry-content -->

<div class="position-relative border-bottom" id="footer-promo">
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

<?php if( is_page( 'guidelines' ) ) : ?>
<script>
(function ($) {

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  layoutMode: 'fitRows',
  getSortData: {
     name: '[data-title]',
     date: '[data-date-created] parseInt'
  }
});

// sort items on button click
$('.sort-by-button-group').on( 'click', 'button', function() {
  var sortByValue = $(this).attr('data-sort-by');
  $grid.isotope({ sortBy: sortByValue });
});

// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};

// bind filter button click
$('#filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});

// change active class on buttons
$('.btn-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.active').removeClass('active');
    $( this ).addClass('active');
  });
});

}(jQuery));
</script>
<?php endif; ?> 

<?php if( is_singular( 'topics' ) ) : ?>
<script>
(function ($) {
    $('#nav-patients li:first-child').addClass('current-menu-item');
}(jQuery));
</script>
<?php endif; ?> 

<?php if( is_singular( 'guideline' ) ) : ?>
<script>
(function ($) {
    $('#toc').toc({
        'selectors': 'h3.trigger', //elements to use as headings
        'container': '#guideline-content', //element to find all selectors in
        'smoothScrolling': true, //enable or disable smooth scrolling on click
        'prefix': 'toc', //prefix for anchor tags and class names
        'onHighlight': function(el) {

        }, //called when a new section is highlighted 
        'highlightOnScroll': true, //add class to heading that is currently in focus
        'highlightOffset': 100, //offset to trigger the next headline
        'anchorName': function(i, heading, prefix) { //custom function for anchor name
            return prefix+i;
        },
        'headerText': function(i, heading, $heading) { //custom function building the header-item text
            return $heading.text();
        },
        'itemClass': function(i, heading, $heading, prefix) { // custom function for item class
            return $heading[0].tagName.toLowerCase();
        }
    });
}(jQuery));
</script>
<?php endif; ?> 

<?php if ( is_page( 'history' ) ) : ?>
<script>
(function ($) {
    $().timelinr();
}(jQuery));
</script>
<?php endif; ?> 

<?php if( is_home() ) : ?>
<script>
(function ($) {
    $(document).ready(function() {
        
        var swiperPosts = new Swiper('.posts-latest', {
			loop: true,
            pagination: { el: '.swiper-pagination', clickable: true, },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev', },
        });

	});
}(jQuery));
</script>
<?php endif; ?> 

<?php if( is_front_page() ) : ?>
<script>
(function ($) {
    $(document).ready(function() {
        
        var swiperBack2 = new Swiper('.header-swiper-back-2', { slidesPerView: 'auto', centeredSlides: true, spaceBetween: 100, onlyExternal: true, effect: 'coverflow', direction: 'vertical', speed: 600, loop: true, coverflowEffect: { slideShadows: false } });
        var swiperBack1 = new Swiper('.header-swiper-back-1', { slidesPerView: 'auto', centeredSlides: true, spaceBetween: 300, effect: 'coverflow', speed: 600, loop: true, coverflowEffect: { slideShadows: false } });
        var swiperFront = new Swiper('.header-swiper-front', {
            slidesPerView: 'auto',
            centeredSlides: true,
			loop: true,
			slideToClickedSlide: true,
            spaceBetween: 100,
            effect: 'coverflow',
            speed: 600,
            coverflowEffect: { slideShadows: false },
            pagination: { el: '.header-swiper-front .swiper-pagination', clickable: true, },
            navigation: { nextEl: '.header-swiper-front .swiper-button-next', prevEl: '.header-swiper-front .swiper-button-prev', },
            controller: { control: [swiperBack1, swiperBack2], by: 'container', },
            keyboard: true,
            a11y: true,
            on: {
                slideChange: function() {
                    var s = this;
                    if (s.activeIndex === $('.swiper-slide-gallery').index()) { $(s.el).find('.swiper-pagination').hide(); } else { $(s.el).find('.swiper-pagination').show(); }
                }
            }
        });

    	
	});
}(jQuery));
</script>
<?php endif; ?> 

</body>
</html>
