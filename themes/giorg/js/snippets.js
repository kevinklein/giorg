$(document).ready(function() {

    if (window.innerWidth > 800) {
        window.sr = ScrollReveal({ reset: true });
        sr.reveal('.item-reveal-left', { delay: 1000, origin: 'left', scale: 1, distance: '50vw', easing: 'ease-out', duration: '350' });
        sr.reveal('.item-reveal-right', { delay: 1000, origin: 'right', scale: 1, distance: '50vw', easing: 'ease-out', duration: '350' });
        sr.reveal('.item-reveal-header', { delay: 300, viewOffset: { bottom: 400 }, reset: false });
        sr.reveal('.item-reveal-tile-1', { delay: 200, origin: 'left', scale: 1, distance: '50vw' });
        sr.reveal('.item-reveal-tile-2', { delay: 50, origin: 'right', scale: 1, distance: '50vw' });
        sr.reveal('.item-reveal-tile-3', { delay: 350, origin: 'left', scale: 1, distance: '50vw' });
        sr.reveal('.item-reveal-tile-4', { delay: 500, origin: 'right', scale: 1, distance: '50vw' });
        sr.reveal('[class*="item-reveal"]', { scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-fade', { delay: 100, scale: 1, distance: '0', reset: false });
        sr.reveal('.item-reveal-1', { delay: 200, scale: 0.5, distance: '50vw' });
        sr.reveal('.item-reveal-2', { delay: 400, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-3', { delay: 600, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-4', { delay: 800, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-5', { delay: 1000, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-6', { delay: 1200, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-7', { delay: 1400, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-8', { delay: 1600, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-9', { delay: 1800, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-10', { delay: 2000, scale: 0.5, distance: '10vw' });
        sr.reveal('.item-reveal-fade-1', { delay: 200, duration: 800, scale: 1, distance: '0' });
        sr.reveal('.item-reveal-fade-2', { delay: 500, duration: 800, scale: 1, distance: '0' });
        sr.reveal('.item-reveal-fade-3', { delay: 800, duration: 800, scale: 1, distance: '0' });
        sr.reveal('.item-reveal-fade-4', { delay: 1100, duration: 800, scale: 1, distance: '0' });
        sr.reveal('.item-reveal-fade-5', { delay: 1400, duration: 800, scale: 1, distance: '0' });
        sr.reveal('.item-reveal-fade-6', { delay: 1700, duration: 800, scale: 1, distance: '0' });
    }

    $(function() {
        $('.match-height').matchHeight();
    });

    $('.toggle-target').click(function() {
        var target = '#' + $(this).data('target');
        $(target).slideToggle('fast');
        if ($(target).hasClass('hidden-sm-down')) {
            $(target).toggleClass('hidden-sm-down');
        }
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

    $('.toggle-section-menu,.toggle-menu').click(function() {
        if ($('body').hasClass('section-menu-is-visible')) {
            $('body').removeClass('section-menu-is-visible');
        } else {
            $('body').addClass('section-menu-is-visible');
        }
    });

    $('.read-more a').click(function(e) {
        $(this).parents('.read-more-parent').toggleClass('read-more-parent-expanded');
        $(this).html() == 'Read Less' ? $(this).html('Read More') : $(this).html('Read Less');
        e.preventDefault();
    });

    // Enable parallax and fade effects on homepage sections
    $(window).scroll(function() {
        scrolltop = $(window).scrollTop()
        scrollwindow = scrolltop + $(window).height();
        $(".stripe-intro, .bg-triangles-top-dark, .hero").css("backgroundPosition", "50% " + -(scrolltop / 6) + "px");
    });

    // page-specific rendering
    if (document.getElementById('automotive')) {
        var mySwiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            slidesPerView: 4,
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            centeredSlides: true,
            slideToClickedSlide: true,
            spaceBetween: 20
        })
        $(window).resize(function() {
            var ww = $(window).width()
            if (ww > 1000) mySwiper.params.slidesPerView = 4;
            if (ww > 600 && ww <= 1000) mySwiper.params.slidesPerView = 3;
            if (ww <= 600) mySwiper.params.slidesPerView = 1;
            mySwiper.update()
        })
        $(window).trigger('resize')

        var headerOffset = $('#navbar').outerHeight();
        var introOffset = $('.stripe-intro').outerHeight();
        var navOffset = $('.stripe-section-nav').outerHeight();
        var navHeaderOffset = headerOffset + navOffset;
        var navHeaderIntroOffset = headerOffset + navOffset + introOffset;

        var controller = new ScrollMagic.Controller({
            globalSceneOptions: {
                reverse: true
            }
        });

        var tl = new TimelineMax({
            yoyo: true
        });

        var $container = $('#automotive');
        var subpage = $container.data('subpage');
        var numScenes = $container.data('scenes');
        console.log('subpage', subpage)
        console.log('numScenes', numScenes)

        switch (subpage) {
            case 'connectivity':
                tl
                    .staggerFrom(".path", .7, { drawSVG: 0, ease: Power1.easeInOut }, 0.2)
                    .fromTo(".path-circle", .7, { drawSVG: 0 }, { drawSVG: "102%" }, "-=.5")
                    .to(".circle01", .5, { fill: "#6dadfd", ease: Power4.easeOut }, "-=.25")
                    .to(".path08", .15, { fill: "#2a82f1", ease: Power4.easeOut })
                    .to(".path05", .15, { fill: "#1a74d6", ease: Power4.easeOut })
                    .to(".path03", .15, { fill: "#e2e3e4", ease: Power4.easeOut })
                    .to(".path01", .15, { fill: "#dadbdc", ease: Power4.easeOut })
                    .to(".path,.path-circle", .5, { autoAlpha: 0, ease: Linear.easeNone })
                    .to(".final-img", 2.5, { autoAlpha: 1, ease: Power4.easeOut });

                break;

            case 'autonomous':
                tl
                    .staggerFrom(".path-circle", .5, { drawSVG: 0, ease: Power1.easeInOut }, 0.2)
                    .staggerFrom(".path", .5, { drawSVG: 0, ease: Power1.easeInOut }, 0.2, "-=.5")
                    .to(".final-img", 2.5, { autoAlpha: 1, ease: Power4.easeOut })
                    .to(".path,.path-circle", .5, { autoAlpha: 0, ease: Linear.easeNone }, "-=2.0");

                break;

            case 'electrification':
            case 'architecture':
                tl
                    .staggerFrom(".path", .75, { drawSVG: 0, ease: Power1.easeInOut }, 0.2)
                    .to(".final-img", 2.5, { autoAlpha: 1, ease: Power4.easeOut })
                    .to(".path", .75, { autoAlpha: 0, ease: Linear.easeNone }, "-=2.0");

                break;
        }

        if (window.innerHeight < 1000) {
            var sceneAnim = new ScrollMagic.Scene({ triggerElement: ".stripe-intro", triggerHook: '0', offset: 0 }) // start the scroll main animation
                .setTween(tl);
        } else {
            var sceneAnim = new ScrollMagic.Scene({ triggerElement: 'body', triggerHook: 'onLeave', offset: 0 })
                .setTween(tl);
        }

        var sceneBody = new ScrollMagic.Scene({ triggerElement: ".stripe-intro", triggerHook: '0', offset: 50 }) // add body class when the user starts scrolling
            .setClassToggle("body", "scroll-started");

        var sceneNav = new ScrollMagic.Scene({ triggerElement: "#stripe-fixed-next", triggerHook: 'onLeave', offset: -headerOffset })
            .setPin("#stripe-fixed-next")
            .setClassToggle("body", "section-nav-affixed");

        var reverseAnim = new ScrollMagic.Scene({ triggerElement: "#stripe-fixed-next", triggerHook: 'onLeave', offset: -headerOffset })
            .on("enter", function(event) {
                tl.play();
                //console.log('entered on scroll down');
            })
            .on("leave", function(event) {
                tl.reverse();
                //console.log('re-entered on scroll up');
            });


        var scenes = [
            sceneAnim,
            reverseAnim,
            sceneBody,
            sceneNav
        ];

        for (var i = 1; i < numScenes; i++) {
            scenes.push(
                new ScrollMagic.Scene({ triggerElement: '#section-' + i, triggerHook: 'onLeave', duration: $("#section-" + i).outerHeight(), offset: -navHeaderOffset })
                .setClassToggle("#high-" + i, "active")
            );
        }
        scenes.push(
            new ScrollMagic.Scene({ triggerElement: '#section-last', triggerHook: 'onLeave', duration: $("#section-last").outerHeight(), offset: -navHeaderOffset })
            .setClassToggle("#high-last", "active")
        );

        controller.addScene(scenes);

        controller.scrollTo(function(newpos) {
            TweenMax.to(window, 0.5, { scrollTo: { y: newpos, offsetY: navHeaderOffset - 1 } });
        });

        //  bind scroll to anchor links
        $(document).on("click", "a[href^='#']", function(e) {
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
    }
});

https: //www.frontdeskanywhere.com/about

    $(document).ready(function() {
        // HEADER BEHAVIOR
        function resizeHeader() {
            var scrollVal = $(this).scrollTop();
            var windowWidth = $(window).width();
            if (scrollVal > 0) {
                $('.header-container-wrapper').addClass('scroll-resize');
            } else {
                $('.header-container-wrapper').removeClass('scroll-resize');
            }
        }
        $(".header-main-menu .hs-menu-wrapper>ul").append("<li class='search-trigger'> </li><li class='menu-trigger'> </li>");
        var mainMenuHtml = $('.header-main-menu .hs-menu-wrapper>ul').html();
        $('body').append("<div class=mobile-menu><i class=close-menu></i><ul>" + mainMenuHtml + "</ul></div>");
        $('.header-container .menu-trigger').click(function() {
            $('.header-container-wrapper, .body-container-wrapper, .footer-container-wrapper').css({ display: "none" });
            $('.mobile-menu').slideDown('slow');
        });
        $('.mobile-menu .close-menu').click(function() {
            $('.mobile-menu').slideUp('slow');
            $('.header-container-wrapper, .body-container-wrapper, .footer-container-wrapper').css({ display: "block" });
        });
        $(window).bind('orientationchange', function(event) {
            resizeHeader();
        });
        $(window).scroll(function() {
            resizeHeader();
        });
        $(window).resize(function() {
            resizeHeader();
            if ($(window).width() > 850) {
                $('.header-container .hs-menu-wrapper>ul:nth-child(1)>li').removeAttr('style');
                $('.header-container-wrapper, .body-container-wrapper, .footer-container-wrapper').removeAttr('style');
                $('.mobile-menu').removeAttr('style');
            }
        });
        // END HEADER BEHAVIOR
        if (!navigator.userAgent.match(/(iPhone|Android.*Mobile)/i)) {
            $('a[href*="tel:"]').each(function() {
                var telnumber = $(this).attr('href');
                $(this).removeAttr('href');
                $(this).attr('data-tel', telnumber);
            });
        }
        if ($(".main-banner").length) {
            banner_image_src = $(".main-banner .banner-image img").attr("src");
            $(".main-banner").css({
                opacity: "0",
                backgroundImage: 'url(' + banner_image_src + ')'
            });
            $(".main-banner").animate({
                opacity: "1"
            }, 1000);
        }
        if ($(".fixed-bg-section").length) {
            fixed_image_src = $(".fixed-bg-section .bg-image img").attr("src");
            $(".fixed-bg-section").css({
                opacity: "0",
                backgroundImage: 'url(' + fixed_image_src + ')'
            });
            $(".fixed-bg-section").animate({
                opacity: "1"
            }, 1000);
        }
        $('.header-container .google-search>div').css({
            opacity: 0
        });
        $('.header-container .search-trigger').click(function() {
            search_opacity = $('.header-container .google-search>div').css('opacity');
            if (search_opacity == 0) {
                $('.header-container .google-search').css({
                    display: "block",
                    opacity: 1
                });
                $('.header-container .google-search>div').stop().animate({
                    opacity: 1,
                    marginTop: "10px"
                }, 300);
            } else {
                $('.header-container .google-search>div').stop().animate({
                    opacity: 0,
                    marginTop: "20px"
                }, 300);
                $('.header-container .google-search').fadeOut();
            }
        });
        $('.page-breadcrumb .hs-breadcrumb-menu').prepend('<li class="hs-breadcrumb-menu-item first-crumb">You are here:</li><li class="hs-breadcrumb-menu-item"><a href="/">Home</a><span class="hs-breadcrumb-menu-divider"></span></li>');
        if ($(".blog-page").length) {
            $title = $('.author-list h3').text();
            $link = $('#authors-list-link').attr("href");
            $('.author-list h3').html('<a href="' + $link + '">' + $title + '</a>');
        }
        $('body').append('<div class="scrollToTopButton"></div>');
        //Check to see if the window is top if not then display button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1000) {
                $('.scrollToTopButton').fadeIn();
            } else {
                $('.scrollToTopButton').fadeOut();
            }
        });
        //Click event to scroll to top
        $('.scrollToTopButton').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });
        if ($(".features-table").length) {
            var colCount = 0;
            var tableInit = $('.features-table table:nth-child(1)').html();
            $('.features-table table:nth-child(1) tr:nth-child(1) th').each(function() {
                colCount++;
            });
            //alert(colCount);
            for (var i = 2; i <= colCount; i++) {
                $('.features-table>div>span').append('<table class="feature-table-' + i + '">' + tableInit + '</table>');
                $(".feature-table-" + i + " tr td").css({ display: 'none' });
                $(".feature-table-" + i + " tr th").css({ display: 'none' });
                $(".feature-table-" + i + " tr td:nth-child(1)").css({ display: 'table-cell' });
                $(".feature-table-" + i + " tr th:nth-child(1)").css({ display: 'table-cell' });
                $(".feature-table-" + i + " tr td:nth-child(" + i + ")").css({ display: 'table-cell' });
                $(".feature-table-" + i + " tr th:nth-child(" + i + ")").css({ display: 'table-cell' });
            }
        }
    });
$(window).load(function() {
    $('p').each(function() {
        var $this = $(this);
        if ($this.html().replace(/\s| /g, '').length == 0) $this.addClass('p-spacer');
    });
    if ($(".microcopy").length) {
        microcopyText = $(".microcopy").html();
        $(".hs_cos_wrapper_type_form form").append("<div class='microcopy'>" + microcopyText + "</div>");
    }
});
$(document).keyup(function(e) {
    if (e.keyCode == 27) {
        $('.header-container .google-search>div').stop().animate({
            opacity: 0,
            marginTop: "20px"
        }, 300);
        $('.header-container .google-search').fadeOut();
    }
});
/* EQUAL HEIGHTS */
equalheight = function(container) {
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el, topPosition = 0;
    $(container).each(function() {
        $el = $(this);
        $($el).height('auto');
        topPostion = $el.position().top;
        var windowWidth = $(window).width();
        if (windowWidth >= 768) {
            if (currentRowStart != topPostion) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) rowDivs[currentDiv].height(currentTallest);
                rowDivs.length = 0;
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : currentTallest;
            }
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) rowDivs[currentDiv].height(currentTallest);
        } else {
            $($el).height('auto');
        }
    });
};
$(window).load(function() {
    var pricingcol = $('.pricing-col');
    if (pricingcol.length) equalheight(pricingcol);
});
$(window).resize(function() {
    var pricingcol = $('.pricing-col');
    if (pricingcol.length) equalheight(pricingcol);
});
/* END EQUAL HEIGHTS*/

;
(function() {
    function lazyLoadImages() { var st = $(window).scrollTop();
        $('img.lazy').each(function() { var img = $(this); if (img.attr('src')) return; if (img.offset().top < $(window).height() + st) { img.attr('src', img.data('src')); } }); }
    if ($('img.lazy').length > 0) { $(window).scroll(function() { lazyLoadImages(); }); }
    if (window.hljs) { hljs.configure({ tabReplace: '    ' });
        hljs.initHighlightingOnLoad(); }
    if ($('.header-swiper-front').length) {
        var swiperBack2 = new Swiper('.header-swiper-back-2', { slidesPerView: 'auto', centeredSlides: true, spaceBetween: 100, onlyExternal: true, effect: 'coverflow', direction: 'vertical', speed: 600, coverflowEffect: { slideShadows: false } });
        var swiperBack1 = new Swiper('.header-swiper-back-1', { slidesPerView: 'auto', centeredSlides: true, spaceBetween: 300, effect: 'coverflow', speed: 600, coverflowEffect: { slideShadows: false } });
        var swiperFront = new Swiper('.header-swiper-front', {
            slidesPerView: 'auto',
            centeredSlides: true,
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
        var galleryTopSwiper = new Swiper('.swiper-gallery-top', { slidesPerView: 1, spaceBetween: 10, nested: true, resistanceRatio: 0, preloadImages: false, lazy: true, });
        var galleryThumbsSwiper = new Swiper('.swiper-gallery-thumbs', { slidesPerView: 5, spaceBetween: 10, centeredSlides: true, touchRatio: 0.2, slideToClickedSlide: true, nested: true, resistanceRatio: 0, });
        galleryTopSwiper.controller.control = galleryThumbsSwiper;
        galleryThumbsSwiper.controller.control = galleryTopSwiper;
    }
    $('body').prepend('<div id="fb-root"></div>');
    (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=129338113911206";
        fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
    (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? 'http' : 'https'; if (!d.getElementById(id)) { js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs); } })(document, 'script', 'twitter-wjs');
    (function() { var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/platform.js'; var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s); })();
    var iframeTimeout;

    function lazyLoadDemos() {
        $('.demo').each(function() {
            var frameHolder = $(this).find('.demo-iframe');
            if (frameHolder.hasClass('loaded')) return;
            var frame = frameHolder.find('iframe');
            var src = frame.attr('data-src');
            if (frameHolder.offset().top + frameHolder.height() < $(window).scrollTop()) { return; }
            if (frameHolder.offset().top < ($(window).scrollTop() + $(window).height() + 50)) { frameHolder.addClass('loaded');
                frame.attr('src', src); }
        });
    }
    if ($('.demo').length > 0) { $('.demo').each(function() { var t = $(this); var demoFile = t.find('iframe').attr('data-src');
            t.find('.demo-link-new-window').attr('href', demoFile);
            t.find('.demo-link-source').attr('href', 'https://github.com/nolimits4web/Swiper/blob/master/demos/' + demoFile); });
        $(window).on('scroll resize', function() { clearTimeout(iframeTimeout);
            iframeTimeout = setTimeout(function() { lazyLoadDemos(); }, 500); });
        lazyLoadDemos(); }
})();