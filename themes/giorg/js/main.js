(function ($) {

    var headerOffset = $( '#header-main' ).height();
    // var heroOffset = $('.hero').outerHeight();
    // var hudOffset = $('#header-hud').outerHeight();
    // var headerHeroOffset = headerOffset + heroOffset;

    ////google analytics tracking
    // var acg_tracklink = function(path){
    //     if((typeof path==="string")&&(path.length)){
    //         if(typeof _gaq==="object"){
    //             _gaq.push(['_trackPageview', path]); 
    //         }
    //     }
    // };
    // //_trackEvent(category, action, opt_label, opt_value)
    // var acg_trackevent = function(category, action, opt_label, opt_value){
    //     if(typeof _gaq==="object"){
    //         if(typeof opt_value !== "undefined"){
    //             _gaq.push(['_trackEvent', category, action, opt_label,opt_value]); 
    //         }else{
    //             _gaq.push(['_trackEvent', category, action, opt_label]); 
    //         }
    //     }
    // };

    $(document).ready(function() {

        var controller = new ScrollMagic.Controller({
            globalSceneOptions: {
                reverse: true
            }
        });

        var fixHeader = new ScrollMagic.Scene({triggerElement: ".main-content", triggerHook: 'onLeave', offset: 0})
            .setClassToggle("body", "body-fixed-top");

        var fixSidebar = new ScrollMagic.Scene({triggerElement: "#sidebar", triggerHook: 'onLeave', duration: $('#main').height(), offset: -headerOffset})
            .setPin("#sidebar")
            .setClassToggle("body", "sidebar-affixed");

        // var fixLocalnav = new ScrollMagic.Scene({triggerElement: "#localnav", triggerHook: 'onLeave', duration: $('#main').height(), offset: -headerOffset})
        //     .setPin("#localnav")
        //     .setClassToggle("body", "localnav-affixed");

        var scenes = [
            fixHeader,
            fixSidebar
            //fixLocalnav
        ];

        var $container = $('#main');
        console.log(headerOffset);

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
       
        // $(function() {
        //     $('.match-height').matchHeight();
        // });
		
		$('.toggle-target').click(function() {
            var target = '#' + $(this).data('target');
            $(target).slideToggle('fast');    
        });
        
        $('.toggle-target-next,.faqquestion').next().hide();
        
        $('.toggle-target-next,.faqquestion').click(function() {
            $(this).next().slideToggle('fast');
            event.preventDefault();
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

        ////legacy JS

        //legacy tabs for GI Health Centers
        jQuery('#tabs').tabs({
            select: function(event,ui){
                window.location.hash = ui.tab.hash;
            }	
        });

        jQuery('a.acgtrackevent').live("click",function(){
            var $this = jQuery(this);
            acg_trackevent($this.data("category"), $this.data("action"), $this.data("optlabel"));
        });

        jQuery('a[href$=".pdf"]').live("click",function(){
            var $this = jQuery(this), thishref = $this.attr("href");
            acg_tracklink(thishref);
        });

        jQuery('a[href$=".mp3"]').live("click",function(){
            var $this = jQuery(this), thishref = $this.attr("href");
            acg_tracklink(thishref);
        });

        jQuery("input.clearvalues").blur(function(){
        
        if(document.getElementById("gform_wrapper_5")){
            jQuery.ajax({
                url:'/doExt/fellowshipprograms.asp',
                type: 'GET',
                success: function(data){
                    jQuery("#input_5_1").append(data);
                }
            });
        
        }

        if(document.getElementById("gi-fellowship-programs")){
            jQuery.ajax({
                url:'/doExt/fellowshipprograms.asp',
                type: 'GET',
                success: function(data){
                    jQuery("#fellowships_institution").append(data);
                }
            });
        
        }
        
        if(document.getElementById("cycle-main")){
            jQuery('#cycle-main div').hide();
            jQuery('#cycle-main img').each(function(){
                var thissrc = jQuery(this).attr("src"), img = new Image();
                img.src = thissrc;
            });
            var startcycle = function(){
                jQuery('#cycle-main div').show();
                jQuery('#cycle-main').after('<div id="cycle-nav">').cycle({
                    fx:      'fade',
                    timeout:  5000,
                    pager:   '#cycle-nav'
                });
            }
            setTimeout(startcycle,500)
        }
        
        // jQuery('#tabs').tabs({
        //     select: function(event,ui){
        //         window.location.hash = ui.tab.hash;
        //     }	
        // });
        
        // jQuery("#member-signin").live("click", function(){
        //     var $this = jQuery(this), $signin = jQuery("#signin");
            
        //     if($huduser.hasClass("signin-toggled")){
        //         $signin.slideUp();
        //         $huduser.removeClass("signin-toggled");
        //     }else{
        //         $signin.slideDown();
        //         $huduser.addClass("signin-toggled");
        //     }
            
        //     return false;
        // });	

        // jQuery("#signin-cancel").live("click", function(){
        //     var $this = jQuery(this), $signin = jQuery("#signin");
            
        //     $signin.slideUp();
        //     $huduser.removeClass("signin-toggled");
        //     return false;
        // });	
        
        // jQuery("li:has(ul)","#secondary").addClass("hasChildren");
        
        // jQuery("li:has(ul) > a","#secondary").live("click",function(){
        //     var $this = jQuery(this), $thisli = $this.parents("li:first"), $submenu = $this.next("ul.sub-menu");
        //     if($submenu.hasClass("opened")){
        //         $submenu.slideUp().removeClass("opened");
        //         $thisli.removeClass("opened");
        //     }else{
        //         jQuery("ul.sub-menu.opened", "#secondary").hide();
        //         jQuery("li.opened", "#secondary").removeClass("opened");
        //         jQuery("ul.opened", "#secondary").removeClass("opened");
        //         $submenu.slideDown(150).addClass("opened");
        //         $thisli.addClass("opened");
        //     }
        //     return false;
        // });
        
        // jQuery("li:has(ul).current_page_parent > a","#secondary").trigger("click");

        // jQuery("#tabs1 li.parent li a").live("click",function(){
        //     var $this = jQuery(this), tabselector = $this.attr("rel"), $gototab = jQuery(tabselector), $tabs = jQuery("#tabs"), tabindex = $tabs.find("div.ui-tabs-panel").index($gototab);
        //     $tabs.tabs("select",tabindex);
        //     window.location = $this.attr("href");
        //     return false;
        // });
        
        // jQuery("a.tabselector").live("click",function(){
        //     var $this = jQuery(this), tabselector = $this.attr("rel"), $gototab = jQuery(tabselector), $tabs = jQuery("#tabs"), tabindex = $tabs.find("div.ui-tabs-panel").index($gototab);
        //     $tabs.tabs("select",tabindex);
        //     window.location = $this.attr("href");
        //     return false;
        // });
        
        // jQuery("li.parent > a").live("click",function(){
        //     var $submenu = jQuery(this).next("ul");
        //     if($submenu.hasClass("opened")){
        //         $submenu.slideUp(150).removeClass("opened");
        //         jQuery(this).removeClass("expanded");
        //     }else{
        //         $submenu.slideDown(150).addClass("opened");
        //         jQuery(this).addClass("expanded");
        //     }
        //     return false;
        // });
        
        // jQuery(".showhide").live("click",function(){
        //     var $showdiv = jQuery(this).next("div");
        //     if($showdiv.hasClass("opened")){
        //         $showdiv.slideUp(200).removeClass("opened");
        //         jQuery(this).removeClass("expanded");
        //     }else{
        //         $showdiv.slideDown(200).addClass("opened");
        //         jQuery(this).addClass("expanded");
        //     }
        //     return false;
        // });
        
        // jQuery(".user-signin-cancel").live("click", function(){
        //     jQuery(".user-signin-trigger").removeClass("expanded");
        //     jQuery(".user-signin").slideUp(150).removeClass("opened");
        //     return false;
        // });	
        
        // if(document.getElementById("hud-user") && $huduser.attr("rel").indexOf("http%3A%2F%2Facggi.net%2Fcontent-api") < 0 && $huduser.attr("rel").indexOf("http%3A%2F%2Fgi.org%2Fcontent-api") < 0 && $huduser.attr("rel").indexOf("https%3A%2F%2Facggi.net%3A443%2Fcontent-api") < 0 && $huduser.attr("rel").indexOf("https%3A%2F%2Fgi.org%3A443%2Fcontent-api") < 0){
        //     jQuery.ajax({
        //         url: '/wp-content/themes/acg/userhud.php',
        //         data: {
        //             'rul': $huduser.attr("rel")
        //         },
        //         cache: false,
        //         type: 'GET',
        //         success: function(data){
        //             $huduser.html(data);
        //         }
        //     });
        // }
        
        // if(document.getElementById("hud-user") && ($huduser.attr("rel").indexOf("http%3A%2F%2Facggi.net%2Fcontent-api") > -1 || $huduser.attr("rel").indexOf("http%3A%2F%2Fgi.org%2Fcontent-api") > -1 || $huduser.attr("rel").indexOf("https%3A%2F%2Facggi.net%3A443%2Fcontent-api") > -1 || $huduser.attr("rel").indexOf("https%3A%2F%2Fgi.org%3A443%2Fcontent-api") > -1)){
        //     jQuery.ajax({
        //         url: '/wp-content/themes/acg/userhud.php',
        //         data: {
        //             'rul': encodeURIComponent(window.location.href)
        //         },
        //         cache: false,
        //         type: 'GET',
        //         success: function(data){
        //             $huduser.html(data);
        //         }
        //     });
        // }

        // if (document.getElementById("toggleLogin")) {
        //     jQuery.ajax({
        //         url: '/wp-content/themes/acg/userlogin.php',
        //         data: {
        //             'rul': encodeURIComponent(window.location.href)
        //         },
        //         cache: false,
        //         type: 'GET',
        //         success: function(data){
        //             jQuery("#toggleLogin").html(data);
        //         }
        //     });
        // }
        
        jQuery("#find-a-gastroenterologist").submit(function(){
            var $this = jQuery(this), $results = jQuery("#find-a-gastroenterologist-results");
            $results.html('<div style="text-align: center; padding: 10px;"><img src="' + ACG_IMAGE_PATH + 'anim-loading.gif" />');
            jQuery.ajax({
                url:'/doExt/phylocator.asp',
                type: 'POST',
                data: $this.serialize(),
                success: function(data){
                    $results.html(data);
                }
            });

            return false;
        });

        jQuery("#find-a-liver-expert").submit(function(){
            var $this = jQuery(this), $results = jQuery("#find-a-liver-expert-results");
            $results.html('<div style="text-align: center; padding: 10px;"><img src="' + ACG_IMAGE_PATH + 'anim-loading.gif" />');
            jQuery.ajax({
                url:'/doExt/liverlocator.asp',
                type: 'POST',
                data: $this.serialize(),
                success: function(data){
                    $results.html(data);
                }
            });

            return false;
        });

        jQuery("#gi-fellowship-programs").submit(function(){
            var $this = jQuery(this), $results = jQuery("#gi-fellowship-programs-results");
            $results.html('<div style="text-align: center; padding: 10px;"><img src="' + ACG_IMAGE_PATH + 'anim-loading.gif" />');
            jQuery.ajax({
                url:'/doExt/fellowship.asp',
                type: 'POST',
                data: $this.serialize(),
                success: function(data){
                    $results.html(data);
                }
            });

            return false;
        });

        if(document.getElementById("phylocator_externalformsubmit")){
            var 
            $phylocator_externalformsubmit = jQuery("#phylocator_externalformsubmit"), 
            phylocator_externalformsubmit_type = $phylocator_externalformsubmit.attr("rel"), 
            $phylocator_state = jQuery("#phylocator_state"),
            phylocator_passed_state = jQuery.trim($phylocator_state.attr("rel"));
            
            if(phylocator_passed_state.length){
                $phylocator_state.val(phylocator_passed_state.toUpperCase());
            }

            jQuery("#find-a-gastroenterologist").trigger("submit");
        }

        if(document.getElementById("liverlocator_externalformsubmit")){
            var 
            $liverlocator_externalformsubmit = jQuery("#liverlocator_externalformsubmit"), 
            liverlocator_externalformsubmit_type = $liverlocator_externalformsubmit.attr("rel"), 
            $liverlocator_state = jQuery("#phylocator_state"),
            liverlocator_passed_state = jQuery.trim($liverlocator_state.attr("rel"));
            
            if(liverlocator_passed_state.length){
                $liverlocator_state.val(liverlocator_passed_state.toUpperCase());
            }

            jQuery("#find-a-liver-expert").trigger("submit");
        }
        
        // if(document.getElementById("dht_faq_section") || document.getElementById("dht_section")){
        //     jQuery("div.faqanswer").hide();
            
        //     jQuery("a.faqquestion").live("click",function(){
        //         var $this = jQuery(this), $parentli = $this.closest("li"), $answer = $parentli.find("div.faqanswer");
                
        //         if($answer.hasClass("opened")){
        //             $answer.slideUp().removeClass("opened");
        //         }else{
        //             $answer.slideDown().addClass("opened");
        //         }

        //         return false;
        //     });
        // }
        
        // jQuery("div.hideshowtext").hide();
        
        // jQuery("a.hideshowlink").live("click",function(){
        //     var $this = jQuery(this), $parent = $this.parents(":first"), $hidetext = $parent.next("div.hideshowtext");
            
        //     if($hidetext.hasClass("opened")){
        //         $hidetext.slideUp().removeClass("opened");
        //     }else{
        //         $hidetext.slideDown().addClass("opened");
        //     }

        //     return false;
        // });

        // if(document.getElementById("acg_acgli_li")){
        //     var $acg_acgli_li = jQuery("#acg_acgli_li"), w3s = $acg_acgli_li.data("w3sig"), w3t = $acg_acgli_li.data("w3t"), journalaccess = $acg_acgli_li.data("journalaccess");
        //     jQuery("a.within3link").each(function(){
        //         var $this = jQuery(this), thishref = $this.attr("href"),
        //         urljoiner = (thishref.indexOf("?") > -1) ? "&" : "?";
        //         if(w3t.length){
        //             if(thishref === "http://acg-gi-circle.within3.com" || thishref === "https://acg-gi-circle.within3.com/public/sign_in"){
        //                 $this.attr("href", "https://thoughtleaders.within3.com/sessions/single_sign_on/create?token="+w3t+"&signature="+w3s);
        //             }else{
        //                 $this.attr("href", thishref+urljoiner+"source=single_sign_on&token="+w3t+"&signature="+w3s);
        //             }
        //         }else{
        //             $this.attr("href","https://acg-gi-circle.within3.com/public/sign_in");
        //         }
        //     });
        //     jQuery("a.within3linkhepc").each(function(){
        //         var $this = jQuery(this), thishref = $this.attr("href"),
        //         urljoiner = (thishref.indexOf("?") > -1) ? "&" : "?";
        //         if(w3t.length){
        //             if(thishref === "http://acg-hepatitis-circle.within3.com" || thishref === "https://acg-hepatitis-circle.within3.com/public/sign_in"){
        //                 $this.attr("href", "https://acg-hepatitis-circle.within3.com/acg-hepatitis-circle?source=single_sign_on&token="+w3t+"&signature="+w3s);
        //             }else{
        //                 $this.attr("href", thishref+urljoiner+"source=single_sign_on&token="+w3t+"&signature="+w3s);
        //             }
        //         }else{
        //             $this.attr("href","https://acg-hepatitis-circle.within3.com/public/sign_in");
        //         }
        //     });
        //     jQuery("a.within3linkibd").each(function(){
        //         var $this = jQuery(this), thishref = $this.attr("href"),
        //         urljoiner = (thishref.indexOf("?") > -1) ? "&" : "?";
        //         if(w3t.length){
        //             if(thishref === "http://acg-ccfa-ibd-circle.within3.com" || thishref === "https://acg-ccfa-ibd-circle.within3.com/public/sign_in"){
        //                 $this.attr("href", "https://acg-ccfa-ibd-circle.within3.com/acg-ccfa-ibd-circle?source=single_sign_on&token="+w3t+"&signature="+w3s);
        //             }else{
        //                 $this.attr("href", thishref+urljoiner+"source=single_sign_on&token="+w3t+"&signature="+w3s);
        //             }
        //         }else{
        //             $this.attr("href","https://acg-ccfa-ibd-circle.within3.com/acg-ccfa-ibd-circle/public/sign_in");
        //         }
        //     });
        //     if(journalaccess==="True"){
        //         jQuery("a.acgjournallink").each(function(){
        //             var $this = jQuery(this), thishref = $this.attr("href");
        //             $this.attr("href","/membership/journal-access/?jpl="+encodeURIComponent(thishref));
        //         });
        //     }
        // }

        flowplayer("a.myPlayer", ACG_THEME_PATH+"js/flowplayer.commercial-3.2.7.swf", {key:'#$720bec46f4bc4b729cd'});
        flowplayer("a.myPlayerStream", ACG_THEME_PATH+"js/flowplayer.commercial-3.2.7.swf", {
            key:'#$720bec46f4bc4b729cd',
            plugins: {
                rtmp: {
                    url: ACG_THEME_PATH+'js/flowplayer.rtmp-3.2.3.swf',
                    netConnectionUrl: 'rtmp://s1u34sxpyp5cg1.cloudfront.net/cfx/st'
                }
            },
            clip: {
                provider: 'rtmp',
                autoPlay: false
            }
        });
        
        if(jQuery.browser.msie && parseInt(jQuery.browser.version, 10) === 7){
            jQuery("div#primary div.textwidget").each(function(){
                var $this = jQuery(this), $contents = $this.children();
                $this.replaceWith($contents);
            });
        }
				
	});

}(jQuery));