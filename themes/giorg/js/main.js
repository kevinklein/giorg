(function ($) {

    var headerOffset = $('#header-main').outerHeight();
    var heroOffset = $('.hero').outerHeight();
    var hudOffset = $('#header-hud').outerHeight();
    var headerHeroOffset = headerOffset + heroOffset;

    $(document).ready(function() {

        var controller = new ScrollMagic.Controller({
            globalSceneOptions: {
                reverse: true
            }
        });

        var fixHeader = new ScrollMagic.Scene({triggerElement: ".hero,.page-title,.main-section", triggerHook: 'onLeave', offset: 50})
            .setClassToggle("body", "body-fixed-top");

        var fixSidebar = new ScrollMagic.Scene({triggerElement: "#sidebar", triggerHook: 'onLeave', duration: $('#main').height(), offset: -headerOffset})
            .setPin("#sidebar")
            .setClassToggle("body", "sidebar-affixed");

        // var fixLocalnav = new ScrollMagic.Scene({triggerElement: "#localnav", triggerHook: 'onLeave', duration: $('#main').height(), offset: -headerOffset})
        //     .setPin("#localnav")
        //     .setClassToggle("body", "localnav-affixed");

        var scenes = [
            fixHeader,
            fixSidebar,
            //fixLocalnav
        ];

        var $container = $('#main');
        var numScenes = $container.data('scenes');
        console.log('numScenes', numScenes);
        console.log(headerOffset);

        for (var i = 1; i <= numScenes; i++) {
            scenes.push(
                new ScrollMagic.Scene(
                    {triggerElement: '#section-' + i, triggerHook: 'onLeave', duration: $("#section-" + i).outerHeight(), offset: -headerOffset})
                    .setClassToggle("#high-" + i, "active")
            );
        }

        controller.addScene(scenes);

        controller.scrollTo(function (newpos) {
            TweenMax.to(window, 0.5, {scrollTo: {y: newpos, offsetY: headerOffset - 5} });
        });
        
        //  bind scroll to anchor links
        $(document).on("click", ".nav-local a[href^='#']", function (e) {
            var id = $(this).attr("href");
            if ($(id).length > 0) {
                e.preventDefault();
                // trigger scroll
                controller.scrollTo(id);
                // if supported by the browser update the URL.
                if (window.history && window.history.pushState) {
                    history.pushState("", document.title, id);
                }
            }
        });
       
        $(function() {
            $('.match-height').matchHeight();
        });
		
		$('.toggle-target').click(function() {
            var target = '#' + $(this).data('target');
            $(target).slideToggle('fast');    
        });
        
        $( '.meet-the-faculty .tile' ).each(function() {
            var $facultyName = $(this).find('.tile-backface h3');
            $($facultyName).clone().appendTo(this);
        });
        
        $('.toggle-target-next').next().hide();
        
        $('.toggle-target-next').click(function() {
            $(this).next().slideToggle('fast');
        });
        
        $('.toggle-is-toggled').click(function() {
    		if ($(this).hasClass('is-toggled')) {
                $(this).removeClass('is-toggled');
            } else {
                $(this).addClass('is-toggled');
            }
        });

        $('#search-toggle').click(function() {
    		if ($('.header-main-search-form').hasClass('is-toggled')) {
                $('.header-main-search-form').removeClass('is-toggled');
            } else {
                $('.header-main-search-form').addClass('is-toggled');
                $('#search').focus();
            }
        });

        $('#search-toggler').click(function() {
    		if ($('#search-container').hasClass('is-toggled')) {
                $('#search-container').removeClass('is-toggled');
                $('#search-container').hide();
            } else {
                $('#search-container').addClass('is-toggled');
                $('#search-container').show();
                $('#search').focus();
            }
        });
        
        $('#menu-toggle').click(function() {
            $(this).addClass('btn-no-focus');
            if ($('body').hasClass('menu-is-visible')) {
                $('body').removeClass('menu-is-visible');
            } else {
                $('body').addClass('menu-is-visible');
            }
        });
        
        $('.read-more a').click(function(e) {
            $(this).parents('.read-more-parent').toggleClass('read-more-parent-expanded');
            $(this).html() == 'Read Less' ? $(this).html('Read More') : $(this).html('Read Less');
            e.preventDefault();
        });
        
        $('[data-toggle="tooltip"], .tooltip-trigger').tooltip();
        
        $('.popover-dismiss').popover({
          trigger: 'focus'
        });
        
        $('[data-toggle="popover"]').popover({
            container: 'body',
            html: true,
            content: function () {
                var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
                return clone;
            }
        }).click(function(e) {
            e.preventDefault();
        });
        
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $(document.body).addClass('scrolled');
            } else {
                $(document.body).removeClass('scrolled');
            }
        });

        // Enable parallax and fade effects on homepage sections
        $(window).scroll(function(){
            scrolltop = $(window).scrollTop()
            scrollwindow = scrolltop + $(window).height();
            $(".hero").css("backgroundPosition", "50% " + -(scrolltop/3) + "px");
        });

        if (window.innerWidth  > 800 ) {
            window.sr = ScrollReveal({ reset: true });
            sr.reveal('.item-reveal-left', { delay: 1000, origin: 'left', scale:1, distance: '50vw', easing: 'ease-out', duration: '350' } );
            sr.reveal('.item-reveal-right', { delay: 1000, origin: 'right', scale:1, distance: '50vw', easing: 'ease-out', duration: '350' } );
            sr.reveal('[class*="item-reveal"]', { delay: 200, scale: 1, distance: '-50px', duration: 800 } );
            sr.reveal('.item-reveal-fade', { delay: 100, scale: 1, distance: '0', reset: false } );
            sr.reveal('.hero', { delay: 200, scale: 1, distance: '-50px', duration: 800 } );
            sr.reveal('.item-reveal-1', { delay: 200, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-2', { delay: 400, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-3', { delay: 600, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-4', { delay: 800, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-5', { delay: 1000, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-6', { delay: 1200, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-7', { delay: 1400, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-8', { delay: 1600, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-9', { delay: 1800, scale: 1, duration: 800 } );
            sr.reveal('.item-reveal-10', { delay: 2000, scale: 1, duration: 800 } );
        }
				
	});

}(jQuery));