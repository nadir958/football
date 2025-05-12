/**
*
* --------------------------------------------------------------------
*
* Template : Khelo - Gym, Fitness WordPress Theme
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* --------------------------------------------------------------------
*
**/
(function($) {
    "use strict";
    // sticky menu
    var header = $('.menu-sticky');
    var win = $(window);
    var headerinnerHeight = $(".header-inner").innerHeight();

    win.on('scroll', function() {
       var scroll = win.scrollTop();
       if (scroll < headerinnerHeight) {
           header.removeClass("sticky");
       } else {
           header.addClass("sticky");
       }
    });

    $(".widget_nav_menu li a").filter(function(){
        return $.trim($(this).html()) == '';
    }).hide();

    // Canvas Menu Js
    $( ".nav-link-container > a" ).off("click").on("click", function(event){
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".sidenav").toggleClass("nav-active-menu-container");
    });
    
    $(".nav-close-menu-li > a").on('click', function(event){
        $(".sidenav").toggleClass("nav-active-menu-container");
        $(".content").toggleClass("inactive-body");
    });

    // Smooth About
    if ($('.smoothAbout').length){
        $(".smoothAbout").on('click', function() {
            $('html, body').animate({
                scrollTop: $("#rs-about").offset().top
            }, 1000);
        });
    }
 
    // collapse hidden
    $(function(){ 
        var navMain = $(".navbar-collapse"); // avoid dependency on #id
         // "a:not([data-toggle])" - to avoid issues caused
         // when you have dropdown inside navbar
         navMain.on("click", "a:not([data-toggle])", null, function () {
             navMain.collapse('hide');
        });
     });

    if($(".club-details_data").length){
      $(".club-details_data ul li:first-child a").addClass('active show');
      $(".club-details_data .tab-content > div:first-child").addClass('active show');

    }
    

    // video 
    if ($('.player').length) {
        $(".player").YTPlayer();
    }

    //Flicker   
    if ($('ul#rsflicker').length) { 
        $('ul#rsflicker').jflickrfeed({        
            limit: flicker_data.limit_f,
            qstrings: {
                id: flicker_data.flicker_id
            },
            itemTemplate: '<li><a href=\"http://www.flickr.com/photos/'+flicker_data.flicker_id+'"\"><img src=\"{{image_s}}\" alt=\"{{title}}\" /></a></li>'
        });
    }
    if($('.match-list .match-table').length){        
      $(".match-list .match-table tr:nth-child(2n+1) td").css("background-color", table_row.odd);
      $(".match-list .match-table tr:nth-child(2n) td").css("background-color", table_row.even);
    }  

    if($('.rs-result-style-1.row-data-info').length){        
      $(".rs-result-style-1.row-data-info tr:nth-child(2n+1)").css("background-color", result_table_row.odd);
      $(".rs-result-style-1.row-data-info tr:nth-child(2n)").css("background-color", result_table_row.even);
    }   
  
    if($('.rs-portfolio-style.pointable').length){        
      $(".rs-portfolio-style.pointable tr:nth-child(2n+1)").css("background-color", point_table_row.odd);
      $(".rs-portfolio-style.pointable tr.bg-colors").css("background-color", point_table_row.heading_bg);
      $(".rs-portfolio-style.pointable tr:nth-child(2n)").css("background-color", point_table_row.even);
      $(".rs-portfolio-style.pointable tr:nth-child(2n+1) td").css("color", point_table_row.odd_text);
      $(".rs-portfolio-style.pointable tr:nth-child(2n) td").css("color", point_table_row.even_text);
    }

    //Feature Left
    $('.image-carousel').owlCarousel({
        loop: true,
        items: 1,
        mouseDrag: true,
        dotsContainer: '#item-thumb',  
    });

    //Upcoming Match Slider
    $(".umatch-carousel").each(function() {
        var options = $(this).data('carousel-options');
        $(this).owlCarousel(options); 
    });

    //Award Slider
    if($('.award-carourel').length){
        $(".award-carourel").each(function() {
            var options = $(this).data('award-options');
            $(this).owlCarousel(options); 
        });
    }

    //Recent Result Carousel
    if($('.recent-result-slide').length){
        $(".recent-result-slide").each(function() {
            var options = $(this).data('carousel-options');
            $(this).owlCarousel(options); 
        });
    }


    $('.slider-service-slick').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       asNavFor: '.slider-nav'
     });
    if($('.slider-service-slick').length){
       $('.slider-nav').slick({
         slidesToShow: service3_slider_data.col_lg,
         slidesToScroll: 1,
         asNavFor: '.slider-service-slick',
         dots: false,
         arrows: true,
         mouseDrag : true,
         vertical: true,
         centerMode:true,
         centerPadding:0,
         focusOnSelect: true
      });
    }

    //search 

     $('.sticky_search').on('click', function(event) {        

        $('.sticky_form').toggle('show');

    });

    //One page menu js
    if ($('.page-template-page-single-php .nav').length) {
        $('#single-menu li:first-child').addClass('active');
        $('#single-menu a').on('click', function(){
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
              $('#single-menu li').removeClass('active');
              $(this).parent('li').addClass('active');
              if (target.length) {
                $('html, body').animate({
                  scrollTop: (target.offset().top - 70)
                }, 1000, "easeInOutExpo");
                return false;
              }
            }
        });

        var navChildren = $("#single-menu li.menu-item").children("a");
        var aArray = [];
        for (var i = 0; i < navChildren.length; i++) {
            var aChild = navChildren[i];
            var ahref = $(aChild).attr('href');
            aArray.push(ahref);
        }

        $(window).on("scroll", function(){
            var windowPos = $(window).scrollTop();
            var windowHeight = $(window).height();
            var docHeight = $(document).height();
            for (var i = 0; i < aArray.length; i++) {
                var theID = aArray[i];
                var secPosition = $(theID).offset().top;
                secPosition = secPosition - 135;
                var divHeight = $(theID).height();
                divHeight = divHeight + 90;
                if (windowPos >= secPosition && windowPos < (secPosition + divHeight)) {
                    $("#single-menu a[href='" + theID + "']").parent().addClass("active");
                } else {
                    $("#single-menu a[href='" + theID + "']").parent().removeClass("active");
                }
            }
        });
    }

    // Get a quote popup

    $('.popup-quote').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#qname',
        removalDelay: 500, //delay removal by X to allow out-animation
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#qname';
                }
            }
        }
    });




    $(".rs-heading h3").each(function() {
  
      // Some Vars
      var elText,
          openSpan = '<span class="first-word">',
          closeSpan = '</span>';
      
      // Make the text into array
      elText = $(this).text().split(" ");
      
      // Adding the open span to the beginning of the array
      elText.unshift(openSpan);
      
      // Adding span closing after the first word in each sentence
      elText.splice(2, 0, closeSpan);
      
      // Make the array into string 
      elText = elText.join(" ");
      
      // Change the html of each element to style it
      $(this).html(elText);
    });

    $('.latest-news-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        asNavFor: '.latest-news-nav'
    });
    $('.latest-news-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.latest-news-slider',
        dots: false,
        centerMode: false,
        centerPadding: '0',
        focusOnSelect: true
    });
    

     // team init
    $(".team-carousel").each(function() {
        var options = $(this).data('carousel-options');
        $(this).owlCarousel(options); 
    });


    /*----------------------------
      swiper progressbar Slider
      ------------------------------ */
    var swiper_data = $('.swiper-container');
    if(swiper_data.length){ 
      var swiper = new Swiper('.swiper-container', {
          spaceBetween: 30,
          slidesPerGroup: 1,
          loop: true,
          loopFillGroupWithBlank: true,
          centeredSlides: false,
          mousewheel: true,
          direction: 'horizontal',
          grabCursor: false,
          autoplay: {
              delay: 2500,
              disableOnInteraction: true,
          },
          pagination: {
              el: '.swiper-pagination',
              type: 'progressbar',
          },
          navigation: {
              nextEl: '.next',
              prevEl: '.prev',
          },
          breakpoints: {
              320: {
                  slidesPerView: 1,
                  spaceBetween: 20,
              },
              481: {
                  slidesPerView: 1,
                  spaceBetween: 20,
              },
              576: {
                  slidesPerView: player_data.col_sm,
                  spaceBetween: 20,
              },
              768: {
                  slidesPerView: player_data.col_md,
                  spaceBetween: 30,
              },
              992: {
                  slidesPerView: player_data.col_lg,
                  spaceBetween: 30,
              },
          }
      });
    }

    var swiper_speed = $('.swiper-container');
    if(swiper_speed.length){ 
      $(".swiper-container").hover(function() {
          (this).swiper.autoplay.stop();
      }, function() {
          (this).swiper.autoplay.start();
      }); 
    } 

    // team init with slick
    if ($('.team-slider').length) {
      var sliderDots = "";
      if(team_item_data.slider_dots==1){
        sliderDots = true;
      }
      var sliderNav = "";
      if(team_item_data.nav==1){
        sliderNav = true;
      }
      $(".team-slider").each(function() {
        $(".team-slider").slick({
            slidesToShow: team_item_data.col_lg,
            centerMode: false,
            dots: sliderDots,
            arrows: sliderNav,
            autoplay: team_item_data.autoplay,
            slidesToScroll: 2,
            centerPadding: '15px',
            autoplaySpeed: team_item_data.autoplaySpeed,
            pauseOnHover: team_item_data.pauseOnHover,
            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='glyph-icon flaticon-left-arrow' aria-hidden='true'></i></button>",
          nextArrow:"<button type='button' class='slick-next pull-right'><i class='glyph-icon flaticon-right-arrow' aria-hidden='true'></i></button>",
            responsive: [{
                breakpoint: 1400,
                settings: {
                    centerPadding: '15px',
                    slidesToShow: team_item_data.col_lg,
                }
            }, 
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '15px',
                    slidesToShow: team_item_data.col_md,
                }
            }, 
            {
                breakpoint: 767,
                settings: {
                    centerPadding: '10px',
                    slidesToShow: team_item_data.col_sm,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerPadding: '5px',
                    slidesToShow: team_item_data.col_xs,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 350,
                settings: {
                    centerPadding: '0px',
                    slidesToShow: team_item_data.col_mobile,
                }
            }, ]
        });
      });
    }


    // partner init

    $(".partner-carousel").each(function() {
        var options = $(this).data('carousel-options');
        $(this).owlCarousel(options); 
    });


    //gallery slider carouserl full width
    if ($('.gallery-carousel').length) {
        var sliderDots = "";
        if(gallery_item_data.slider_dots==1){
          sliderDots = true;
        }

        $('.gallery-carousel').slick({
            slidesToShow: gallery_item_data.col_lg,
            centerMode: false,
            dots: sliderDots,
            arrows: false,
            autoplay: gallery_item_data.autoplay,
            slidesToScroll: 2,
            autoplaySpeed: gallery_item_data.autoplaySpeed,
            pauseOnHover: gallery_item_data.pauseOnHover,
            centerPadding: '228px',
            responsive: [{
                breakpoint: 1200,
                settings: {
                    centerPadding: '188px',
                    slidesToShow: gallery_item_data.col_lg,
                }
            }, 
            {
                breakpoint: 991,
                settings: {
                    centerPadding: '144px',
                    slidesToShow: gallery_item_data.col_md,
                }
            }, 
            {
                breakpoint: 767,
                settings: {
                    centerPadding: '0px',
                    slidesToShow: gallery_item_data.col_sm,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerPadding: '0px',
                    slidesToShow: gallery_item_data.col_xs,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 350,
                settings: {
                    centerPadding: '0px',
                    slidesToShow: gallery_item_data.col_mobile,
                }
            }, ]
        });
      }
    
     // partner init

       $('.gallery-slider').slick({
       slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        focusOnSelect: true,
        dots: false,
        centerPadding: '228px',
        arrows: true,
        responsive: [{
            breakpoint: 1200,
            settings: {
                centerPadding: '188px',
            }
        }, {
            breakpoint: 970,
            settings: {
                arrows: true,
                centerPadding: '144px',
            }
        }, {
            breakpoint: 767,
            settings: {
                arrows: true,
                centerPadding: '0px',
            }
        }, {
            breakpoint: 350,
            settings: {
                arrows: false,
                centerPadding: '0px',
                dots: true,
                slidesToShow: 1,
            }
        }, ]
    });



    // testimonial init   
    $('.testi-carousel').slick({
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 3,
          focusOnSelect: true,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 1
              }
            }
          ]
        });
        
    
    $(".testi-item  a.tab").on('click', function(e){
          e.preventDefault();
          slideIndex = $(this).index();
          $( '.testi-carousel' ).slickGoTo( parseInt(slideIndex) );
    });

    // Portfolio Single Carousel
    if ($('.cdev').length) {
         $(".cdev").circlos();
    }

    // Portfolio Single Carousel
    if ($('.portfolio-carousel').length) {
        $('.portfolio-carousel').owlCarousel({
            loop: true,
            nav:true,
            autoHeight:true,
            items:1
        })
    }

    if ($('.upcoming-carousel').length) {
        $('.upcoming-carousel').owlCarousel({
            loop: true,
            nav:true,
            dots:false,
            autoHeight:true,
            items:1
        })
    }


    // Countdown Single Carousel
    $('.sports-carousel').on('init', function(e, slick) {
        var $firstAnimatingElements = $('div.hero-slide:first-child').find('[data-animation]');
        doAnimations($firstAnimatingElements);    
    });

    $('.sports-carousel').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
              var $animatingElements = $('div.hero-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
              doAnimations($animatingElements);    
    });
    if ($('.sports-carousel').length) {
        $('.sports-carousel').slick({
           slidesToShow: 1,
           nav:false,
           fade: true,
           arrows: false,
           dots: false,
         });
    }
    function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function() {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay
            });
            $this.addClass($animationType).one(animationEndEvents, function() {
                $this.removeClass($animationType);
            });
        });
    }



    $('.slider-service-slick').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       asNavFor: '.slider-nav'
     });
    
    // blog init

    $(".blog-carousel").each(function() {
        var options = $(this).data('carousel-options');
        $(this).owlCarousel(options); 
    });

    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });
    
     //Videos popup jQuery activation code
    $('.popup-videos').magnificPopup({
        disableOn: 10,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });


    //type writer
    $(".rs-banner .cd-words-wrapper p:first-child").addClass("is-visible");


    // collapse hidden
    $(function(){ 
         var navMain = $(".navbar-collapse"); // avoid dependency on #id
         // "a:not([data-toggle])" - to avoid issues caused
         // when you have dropdown inside navbar
         navMain.on("click", "a:not([data-toggle])", null, function () {
             navMain.collapse('hide');
         });

     });


    //CountDown Timer   
    var CountTimer = $('.CountDownTimer');
    if(CountTimer.length){ 
        $(".CountDownTimer4").TimeCircles({
            fg_width: 0.030,
            bg_width: 0.8,
            circle_bg_color: "#ffffff",
            circle_fg_color: "#ffffff",

            time: {
                Days:{
                    color: "#fff",
                    text: events_data.days_text,
                },
                Hours:{
                    text: events_data.hours_text,
                    color: "#fff"
                },
                Minutes:{
                    text: events_data.minutes_text,
                    color: "#fff"
                },
                Seconds:{
                    text: events_data.seconds_text,
                    color: "#fff"
                }
            }
        });
    }

   //CountDown Timer
    var CountTimer = $('.CountDownTimer3');
    if(CountTimer.length){ 
        $(".CountDownTimer3").TimeCircles({
            fg_width: 0.030,
            bg_width: 0.8,
            circle_bg_color: events_data.ev_circle_bg_color,
            time: {
                Days:{
                    color: "#fff",
                    text: events_data.days_text,
                },
                Hours:{
                    text: events_data.hours_text,
                    color: "#fff"
                },
                Minutes:{
                    text: events_data.minutes_text,
                    color: "#fff"
                },
                Seconds:{
                    text: events_data.seconds_text,
                    color: "#fff"
                }
            }
        });       
    }

    //CountDown Timer
    var CountTimer = $('.CountDownTimer4');
    if(CountTimer.length){ 
        $(".CountDownTimer4").TimeCircles({
            fg_width: 0.030,
            bg_width: 0.8,
            circle_bg_color: events_data.ev_circle_bg_color,
            time: {
                Days:{
                    color: "#fff",
                    text: events_data.days_text,
                },
                Hours:{
                    text: events_data.hours_text,
                    color: "#fff"
                },
                Minutes:{
                    text: events_data.minutes_text,
                    color: "#fff"
                },
                Seconds:{
                    text: events_data.seconds_text,
                    color: "#fff"
                }
            }
        }); 
    }



    //Start horizontal timeline js
        var $index = $('#index'),
          $wrap = $('#wrap-list'),
          $wrap_index = $('#wrap-index'),
          $list = $('#list'),
          $items = $('> li', $list),
          n = $items.length,
          $btn_prev = $('[data-toggle=prev]'),
          $btn_next = $('[data-toggle=next]');

      // modify style
      $items.css({
        width: (100/n) + '%'
      });
      $list.css({
        width: n*100 + '%'
      }).removeClass('hide');
      var i_padding = $wrap_index.width();
      $index.css({
        width: n*200 + i_padding*2 + 'px',
        'padding-left': i_padding + 'px',
        'padding-right': i_padding + 'px',
      });

      function goToStep(step){
        var $i_active = $('li', $index).removeClass('active').eq(step).addClass('active');
        $items.removeClass('show-me').eq(step).addClass('show-me');
        $list.css({
          'margin-left': -step*100 + '%'
        });
        $('html, body').scrollLeft(0);

        //
        $btn_prev.add($btn_next).removeClass('disabled');
        if (step == 0){
          $btn_prev.addClass('disabled');
        }
        if (step == n - 1){
          $btn_next.addClass('disabled');
        }
        
        // scroll wrap index to center active
        $wrap_index.animate({
          scrollLeft: $i_active.position().left - $wrap_index.width()/2 + 100
        }, 300);
      }

      // events
      $('a', $index).on('click', function(){
        var $li = $(this).parent();
        if ($li.hasClass('active')){
          return false;
        }
        // step want to go next
        var step  = $('li', $index).index($li);
        goToStep(step);
        return false;
      }).eq(0).trigger('click');

      $btn_prev.on('click', function(){
        var $li = $('li.active', $index).prev('li');
        if ($li.length){
          $('a', $li).trigger('click');
        }
        return false;
      });

      $btn_next.on('click', function(){
        var $li = $('li.active', $index).next('li');
        if ($li.length){
          $('a', $li).trigger('click');
        }
        return false;
      });


  //preloader
    $(window).on( 'load', function() {
      $(".loading").delay(800).fadeOut(300);
      $("#loading").delay(800).fadeOut(300);
      $("#loading-center").on( 'click', function() {
      $("#loading").fadeOut(300);
    })

    if($(window).width() < 992) {
      $('.rs-menu').css('height', '0');
      $('.rs-menu').css('opacity', '0');
      $('.rs-menu').css('z-index', '-1');
      $('.rs-menu-toggle').on( 'click', function(){
         $('.rs-menu').css('opacity', '1');
         $('.rs-menu').css('z-index', '1');
     });
    }
    })

    // image loaded portfolio init
    $('.grid').imagesLoaded(function() {
        $('.portfolio-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-item',
            }
        });
    });          

            
    // portfolio Filter
    $('.portfolio-filter button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });



    // Posts loaded Filter init
    $('.grids').imagesLoaded(function() {
        $('.portfolio-filters').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        var $grid = $('.grids').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-item',
            }
        });
    });
                
    // Posts Filter
    $('.portfolio-filters button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });
    

     // magnificPopup init
    $('.image-popup').magnificPopup({
        type: 'image',
        callbacks: {
            beforeOpen: function() {
               this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');
            }
        },
        gallery: {
            enabled: true
        }
    });

         
    // Counter Up  
    $('.rs-counter').counterUp({
        delay: 20,
        time: 1500
    });
    
    // scrollTop init
    var win=$(window);
    var totop = $('#scrollUp');    
    win.on('scroll', function() {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    }); 



    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });


    $(".sidenav .menu li").on('click', function() {
        $(this).children("ul.sub-menu").slideToggle();
    }); 

    $( ".comment-body, .comment-respond" ).wrap( "<div class='comment-full'></div>" ); 


    // Sticky Sidebar
    $('.contents-sticky, .sticky-sidebar').theiaStickySidebar({
        additionalMarginTop: 160,
        additionalMarginBottom: 20,
    });


    //services style js

    $(".services-main").on({
       mouseenter: function(){
            var icon_hover = $(this).data('icon-hover');
            var icon_hover_bg = $(this).data('icon-hoverbg');
            var title_hover_color = $(this).data('title-hover');
            $(this).find(".services-icon i").css('color', icon_hover);         
            $(this).find(".services-icon i").css('background-color', icon_hover_bg);         
            $(this).find(".services-icon h2 a").css('color', title_hover_color);
        },
        mouseleave: function(){
            var icon_color = $(this).data('icon-color');
            var icon_bg = $(this).data('icon-bg');  
            var title_color = $(this).data('title-color');          
            $(this).find(".services-icon i").css('color', icon_color);
            $(this).find(".services-icon i").css('background-color', icon_bg);          
            $(this).find(".services-icon h2 a").css('color', title_color);    
        }      
  }, this);

  //services 2 style
  $(".services-style-2").on({
     mouseenter: function(){
          var title_hover = $(this).data('icon-hover');           
          $(this).find(".services-title a").css('color', title_hover);            
      },
      mouseleave: function(){
          var title_color = $(this).data('icon-color'); 
          $(this).find(".services-title a").css('color', title_color);    
      }      
  }, this);

  //services 3 style
  $('.rs-services-style3').each(function(){
      var overlaybg     = $(this).data('overlay');
      var opacity    = $(this).data('opacity');
      var imgid = $(this).find(".bg-img").attr('id');

      $( "<style>.rs-services-style3 #"+ imgid +":after { background: " + overlaybg + "; opacity: " + opacity + " }</style>" ).appendTo( "head" )
  });

  //services 8 style
  $(".services-style-8 .services-title a").on({
     mouseenter: function(){
          var title_hover = $(this).data('onhovercolor'); 
          $(this).css('color', title_hover);        
      },
      mouseleave: function(){
          var title_color = $(this).data('onleavecolor'); 
          $(this).css('color', title_color); 
      }      
  }, this);

  //services 4 & 5 style
  $(".rs-services-style4 .services-title a, .rs-services-style5 .services-title a").on({
     mouseenter: function(){
          var title_hover = $(this).data('onhovercolor'); 
          $(this).css('color', title_hover);        
      },
      mouseleave: function(){
          var title_color = $(this).data('onleavecolor'); 
          $(this).css('color', title_color); 
      }      
  }, this);

  //services 4 & 5 style
  $(".rs-popular-classes .single-classes .classes-content .title-bar a").on({
     mouseenter: function(){
          var title_hover = $(this).data('onhovercolor'); 
          $(this).css('color', title_hover);        
      },
      mouseleave: function(){
          var title_color = $(this).data('onleavecolor'); 
          $(this).css('color', title_color); 
      }      
  }, this);

  //title hover for sevices
    $('.rs-services1 a, .rs-services-style6 a, .services-style-7 a').on('hover', function() {
      $(this).css({
        'color': $(this).data('onhovercolor')
        });
    }, function() {
      $(this).css({
        'color': $(this).data('onleavecolor')
      
    });   
  }); 


    //For Video
    $('.rs-video-2').each(function(){
      var btnBg     = $(this).find(".popup-videos").data('bg');
      var iconColor = $(this).find(".popup-videos i").data('icolor');
      var videoId = $(this).find(".popup-videos").attr('id');

      $( "<style>.rs-video-2 #"+ videoId +":before { background: " + btnBg + " }</style>" ).appendTo( "head" )
      $( "<style>.rs-video-2 #"+ videoId +" i:before { color: " + iconColor + " }</style>" ).appendTo( "head" )
    });

  //for button
  $(".rs-btn a").on({
       mouseenter: function(){
            var btnBg = $(this).data('onhoverbg');            
            var btnBorder = $(this).data('onhoverbg');            
            var btnColor = $(this).data('onhovercolor');            

            $(this).css('border-color', btnBorder);
            $(this).css('color', btnColor);
        },
        mouseleave: function(){
            var btnHoverBg = $(this).data('onleavebg');
            var btnBorder = $(this).data('bordercolor');
            var btnHoverColor = $(this).data('onleavecolor');
            
            $(this).css('border-color', btnBorder); 
            $(this).css('color', btnHoverColor);   
        }      
  }, this);

  $(".rs-btn2 a").on({
       mouseenter: function(){
            var btnBg = $(this).data('onhoverbg');            
            var btnBorder = $(this).data('onhoverbg');            
            var btnColor = $(this).data('onhovercolor');            

            $(this).css('background-color', btnBg);
            $(this).css('border-color', btnBorder);
            $(this).css('color', btnColor);
        },
        mouseleave: function(){
            var btnHoverBg = $(this).data('onleavebg');
            var btnBorder = $(this).data('bordercolor');
            var btnHoverColor = $(this).data('onleavecolor');

            $(this).css('border-color', btnBorder); 
            $(this).css('background-color', btnHoverBg);
            $(this).css('color', btnHoverColor);   
        }      
  }, this);

  $(".rs-cta .button-wrap a").on({
       mouseenter: function(){
            var btnBg = $(this).data('hoverbg');            
            var btnBorder = $(this).data('hoverborder');            
            var btnColor = $(this).data('hovertext');            

            $(this).css('background-color', btnBg);
            $(this).css('border-color', btnBorder);
            $(this).css('color', btnColor);
        },
        mouseleave: function(){
            var btnHoverBg = $(this).data('leavebg');
            var btnBorder = $(this).data('leaveborder');
            var btnHoverColor = $(this).data('leavecolor');

            $(this).css('background-color', btnHoverBg);
            $(this).css('border-color', btnBorder); 
            $(this).css('color', btnHoverColor);   
        }      
  }, this);


    //woocommerce quantity style
    if ( ! String.prototype.getDecimals ) {
          String.prototype.getDecimals = function() {
              var num = this,
                  match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
              if ( ! match ) {
                  return 0;
              }
              return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
          }
    }
    $('.rs-products-slider .product-item .product-btn a').addClass('glyph-icon flaticon-basket');
    // Quantity "plus" and "minus" buttons
    $( document.body ).on( 'click', '.plus, .minus', function() {
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( currentVal >= max ) ) {
                $qty.val( max );
            } else {
                $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
            }
        } else {
            if ( min && ( currentVal <= min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
            }
        }

        // Trigger change event
        $qty.trigger( 'change' );
    });

    $('.team-carousel-single').owlCarousel({
      items:3,
      loop:true,
      margin:10,
      dots:false,
      autoplay:true,
      navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
      autoplayTimeout:3000,
      autoplayHoverPause:true,      
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:2,
              nav:false
          },
          1000:{
              items:3,
              nav:true            
          }
      }
  })

  

})(jQuery);  