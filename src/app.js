const { each } = require("jquery");

(function($) {

$(document).ready(function(){

  // Ugrás a főoldalra másik oldalról

  // The speed of the scroll in milliseconds

  console.log('Start slide '+object_name.start_slide);

  if(object_name.front_page == 0) {
    $('.dropdown-item').each(function(){
      var currentHref = $(this).attr('href');

      var newHref = object_name.site_url + currentHref;

      console.log(newHref);

      $(this).attr('href', newHref);

    });
    /*$('.contact-menu').each(function(){
      var currentHref = $(this).attr('href');

      var newHref = object_name.site_url + currentHref;

      console.log(newHref);

      $(this).attr('href', newHref);

    });*/
  }

  const speed = 1000;

    $('a[href*="#"]')
    .filter((i, a) => a.getAttribute('href').startsWith('#') || a.href.startsWith(`${location.href}#`))
    .unbind('click.smoothScroll')
    .bind('click.smoothScroll', event => {
      const targetId = event.currentTarget.getAttribute('href').split('#')[1];
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: $(targetElement).offset().top }, speed);
      }
    });

    $('.single-slider').slick({
        autoplay: false,
        dots:true,
        customPaging : function(slider, i) {
          return '<a href="#"><img src="'+object_name.templateUrl+'/images/slide-dot-dark.png" /><img src="'+object_name.templateUrl+'/images/slide-dot-dark-active.png" /></a>';
        },
        arrows:true,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.slider-container').slick({
        //initialSlide: object_name.start_slide,
        autoplay: false,
        autoplaySpeed:3000,
        dots:true,
        speed:3000,
        customPaging : function(slider, i) {
            return '<a href="#"><img src="'+object_name.templateUrl+'/images/slide-dot.png" /><img src="'+object_name.templateUrl+'/images/slide-dot-active.png" /></a>';
        },
        arrows:true,
        infinite: true,
        /*cssEase: 'linear',
        variableWidth: true,
        variableHeight: true,*/
        cssEase:'ease-in-out',
        loop:true,
    });

    $(".home-referencia-slider").on("init", function(event, slick){
      /*$(".pagingInfo").text(parseInt(slick.currentSlide + 1));*/
      $(this).append('<div class="slick-counter">'+ parseInt(slick.currentSlide + 1, 10));
    });

    $('.home-referencia-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        dots:false,
        arrows:true,
        slidesToShow: 3,
        slidesToScroll: 3,
        speed:3000,
        /*infinite: true,
        cssEase: 'linear',
        variableWidth: true,
        variableHeight: true,*/
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
              }
            },
            {
              /*breakpoint: 600,*/
              breakpoint: 960,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              /*breakpoint: 480,*/
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
    });

    
  
    $(".home-referencia-slider").on("afterChange", function(event, slick, currentSlide){
      /*$(".pagingInfo").text(parseInt(slick.currentSlide + 1));*/
      $(this).find('.slick-counter').html(slick.currentSlide + 1);
    });

    $('.dropdown').hover(function(){
        $(this).find('.dropdown-menu').addClass('show');
        //console.log($('nav').hasClass('dark'));
        //if(object_name.front_page == 1) {
        if($('nav').hasClass('dark') == false){
          $(this).find(".nav-link").css("border","1px solid #ffffff");
        } else {
          $(this).find(".nav-link").css("border","1px solid #000000");
          //$(this).find(".nav-link").css("border","1px solid #ffffff");  
        }
    });
    

    $('.dropdown-menu').mouseleave(function(){
        if( $(".dropdown-menu").hasClass("show") ) {
            setTimeout(function(){///workaround
                $(".dropdown-menu").removeClass("show");
                $(".dropdown").find(".nav-link").css("border","1px solid transparent");
            }, 10);
        }
    });

    $(".main-container").mousemove(function(){

        if($(".dropdown").is(":hover")===false && $(".dropdown-menu").is(":hover")===false) {
            if( $(".dropdown-menu").hasClass("show")) {
                setTimeout(function(){///workaround
                    $(".dropdown-menu").removeClass("show");
                    $(".dropdown").find(".nav-link").css("border","1px solid transparent");
                }, 10);
            }
        }

    });

    $('.dropdown-item').addClass('scroll-to-target');

    /*$('.scroll-to-target').click(function(event){
      //var target = $(this).data('id');
      var href = $(this).attr('href');
      
      //var target = href.substr(1,href.length);

      var target = href.substr(href.search('#')+1,href.length)

      var current_url = href.substr(0,href.search('#')-1);

      //console.log($('[id=' + target + ']').offset());
   
      event.preventDefault();

      console.log(event);

      $('html, body').animate ({ scrollTop: $('[id=' + target + ']').offset().top}, 'slow');
      //$('.dropdown').removeClass('open');

      if( $(".dropdown-menu").hasClass("show")) {
        setTimeout(function(){///workaround
            $(".dropdown-menu").removeClass("show");
            $(".dropdown").find(".nav-link").css("border","1px solid transparent");
        }, 10);
      }
   
      return false;
    });*/

    $('.scroll-to-top').click (function (event) {
      event.preventDefault();
      $('html, body').animate ({ scrollTop: 0 }, 'slow');
   
      return false;
    });

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        $('.scroll-to-top').addClass('show');
      } else { 
        $('.scroll-to-top').removeClass('show');
      }
    });


    $('.category-link').live('click',function(){

      $('.filter-categories-bar').find('.category-link').removeClass('active-cat');
      $(this).addClass('active-cat');
      //console.log($(this).next().attr('class'));
      $('.filter-categories-bar').find('.category-link-footer').removeClass('active-foot-class');
      $(this).next().addClass('active-foot-class');

      $('input[name=actcat]').val($(this).data('catname'));

      $('.filters-elements-container').find('.filter-elements').removeClass('visibled');
      $('#'+$(this).data('catname')).addClass('visibled');

      
      /*$.ajax({
        url:"/wp-admin/admin-ajax.php",
				type:'POST',
				data:'action=arterior_ajax_action&filters='+$('[name=filters]').val(),

							 success:function(results)
								 {
                  alert(results);
                 }
      });*/
    });
    
    var Height_init;

    /*$('.home-butorforgalmazas-slider').on('init',function(event,slick){
      Height_init = $('.home-butorforgalmazas-slider').height();
    });*/

    /*$('.home-butorforgalmazas-slider').slick({
      autoplay: false,
      rows:2,
      slidesPerRow: 3,
      dots:false,
      arrows:true,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint:960,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
  });*/

  $('#erase-filters').live('click',function(){

    //console.log('filter erase');

    /*var Height = $('.home-butorforgalmazas-grid').height();
    if(Height < Height_init) {
      Height = Height_init;
    }*/
    //$('.home-butorforgalmazas-grid-container').css('height',Height+"px");

    $('.home-butorforgalmazas-grid-container').css('display','inline-block');

    //$('.home-butorforgalmazas-slider').slick('slickRemove',null,null,true);

    $.ajax({
      url:"/wp-admin/admin-ajax.php",
      type:'POST',
      data:'action=arterior_ajax_action&filters='+$('[name=filters]').val()+'&actcat='+$('input[name=actcat]').val()+'&actchoice='+ $(this).data('choice')+'&erasefilter=1',

             success:function(results)
               {
                results = $.parseJSON(results);
                //console.log(results);
                $('.filter-container').empty();
                $('.filter-container').html(results.filters_content);

                // Change slider
                //$('.home-butorforgalmazas-slider').slick('slickAdd',results.content);
                //$('.home-butorforgalmazas-slider').slick('reinit');

                $('.home-butorforgalmazas-grid').html('');
                $('.home-butorforgalmazas-grid').html(results.content);

                /*if(results.count < 3) {
                  $('.grid-div').css('display','inline-block');
                  $('.grid-div').css('float','none');
                }*/

                var Height = $('.home-butorforgalmazas-grid').height();

                if(Height < Height_init) {
                  Height = Height_init;
                }

                //if($('.home-butorforgalmazas-grid').height() == 0) {
                if(results.count == 0){
                  $('.home-butorforgalmazas-grid-container .no-results').show();
                } else {
                  $('.home-butorforgalmazas-grid-container .no-results').hide();
                }

                if($('input[name=erase-filters-button]').val() > 0) {
                  $('#erase-filters').show();
                } else {
                  $('#erase-filters').hide();
                }

                $('.grid-pager').empty();
                $('.grid-pager').html(results.pager_links);

              }
    });


  });

  $('.filter-element').live('click',function(){
    //console.log($(this).data('choice'));
    //$('.home-butorforgalmazas-slider').hide();

    /*var Height = $('.home-butorforgalmazas-grid').height();
    if(Height < Height_init) {
      Height = Height_init;
    }*/
    //
    //console.log(Height);
    //$('.home-butorforgalmazas-grid-container').css('height',Height+"px");
    //$('.home-butorforgalmazas-grid-container').css('display','inline-block');
    
    //$('.home-butorforgalmazas-slider').slideUp("slow");

    //$('.home-butorforgalmazas-slider').slick('slickRemove',null,null,true);
    

    $.ajax({
      url:"/wp-admin/admin-ajax.php",
      type:'POST',
      data:'action=arterior_ajax_action&filters='+$('input[name=filters]').val()+'&actcat='+$('input[name=actcat]').val()+'&actchoice='+ $(this).data('choice'),

             success:function(results)
               {
                //console.log(results);
                results = $.parseJSON(results);
                //console.log(results);
                $('.filter-container').empty();
                $('.filter-container').html(results.filters_content);

                // Change slider
                //$('.home-butorforgalmazas-slider').live('slick','slickRemove',null,null,true);
                //$('.home-butorforgalmazas-slider').fadeOut( 1000);

                //$('.home-butorforgalmazas-slider').slick('slickAdd',results.content);
                //$('.home-butorforgalmazas-slider').slick('reinit');

                $('.home-butorforgalmazas-grid').html('');
                $('.home-butorforgalmazas-grid').html(results.content);

                //console.log($('.home-butorforgalmazas-slider').height());

                /*var Height = $('.home-butorforgalmazas-grid').height();
                if(Height < Height_init) {
                  Height = Height_init;
                }*/

                //console.log(results.count);

                /*if(results.count < 3) {
                  $('.grid-div').css('display','inline-block');
                  $('.grid-div').css('float','none');
                }*/

                //if($('.home-butorforgalmazas-grid').height() == 0) {
                if(results.count == 0) {
                  $('.home-butorforgalmazas-grid-container .no-results').show();
                } else {
                  $('.home-butorforgalmazas-grid-container .no-results').hide();
                }
                //$('.home-butorforgalmazas-slider').fadeIn( 1600);
                //$('.home-butorforgalmazas-slider').slideDown("slow");

                if($('input[name=erase-filters-button]').val()> 0) {
                  $('#erase-filters').show();
                } else {
                  $('#erase-filters').hide();
                }

                //console.log(results.pager_links);

                $('.grid-pager').empty();
                $('.grid-pager').html(results.pager_links);

              }
    });
  });

  if($('.filters-search').find('.search_bar').length){
    var filters_search_bar = $('.filters-search').find('.search_bar');
    //console.log(filters_search_bar.height());

    //var ret_bar_top = filters_search_bar.position().top + 10px;

    $('.filters-search').find('.ret_bar').css('top',filters_search_bar.position().top+(filters_search_bar.height()+9)+"px");
  }
  //$('.filters-search').find('.ret_bar').css('width',filters_search_bar.width()+"px");

  $('.click-button').live('click',function(){
    $('.ret_bar').find('.ret_bar_link').first().trigger('click');
  })
  
  $('.filters-search').find('input[name=search_bar]').live('keyup',function(e){
    
    // e.keyCode === 13 ENTER
    // e.keyCode === 27 ESC
    var KeyCode = e.keyCode;
    //console.log(KeyCode);
    //console.log($(this).val());
    
    if(KeyCode >= 37 && KeyCode <= 40) {
      //console.log('nyil');
      return;
    }

    if(KeyCode === 27) {
     // console.log(KeyCode);
      $('.filters-search').find('input[name=search_bar]').val('');
      $('.filters-search').find('.ret_bar').hide();
    } else if(KeyCode === 13){
      //alert('Press ENTER!');
      //return;
      $('.ret_bar').find('.ret_bar_link').first().trigger('click');
    } else if($('.filters-search').find('input[name=search_bar]').val() !== ""){
      $('.filters-search').find('.ret_bar').html('');
      $.ajax({
        url:"/wp-admin/admin-ajax.php",
        type:'POST',
        data:'action=arterior_search_ajax_action&search_string='+$(this).val(),
          success:function(results){
            results = $.parseJSON(results);
            //console.log(results.content);
            $('.filters-search').find('.ret_bar').html(results.content);
            //$('.filters-search').find('.ret_bar').text($('.filters-search').find('input[name=search_bar]').val());
            //if($('.filters-search').find('.search_bar').lenth){
              $('.filters-search').find('.ret_bar').css('top',$('.filters-search').find('.search_bar').position().top+($('.filters-search').find('.search_bar').height()+9)+"px");
            //}

            $('.filters-search').find('.ret_bar').show();
          }
      });
      //$('.filters-search').find('.ret_bar').text($('.filters-search').find('input[name=search_bar]').val());
      //$('.filters-search').find('.ret_bar').show();
    } else {
      $('.filters-search').find('.ret_bar').html('');
      $('.filters-search').find('.ret_bar').hide();
    }
  });

  $('.ret_bar_link').live('click',function(){
    
    var href = $(this).data('href');

    if(typeof href !== 'undefined'){
      window.location.href = href;
    }

    var Height = $('.home-butorforgalmazas-grid').height();
    //$('.home-butorforgalmazas-slider-container').height(Height);
    if(Height < Height_init) {
      Height = Height_init;
      //$('.home-butorforgalmazas-slider-container .no-results').show();
    } else {
      //$('.home-butorforgalmazas-slider-container .no-results').hide();
    }
    //console.log(Height);
    //$('.home-butorforgalmazas-grid-container').css('height',Height+"px");
    $('.home-butorforgalmazas-grid-container').css('display','inline-block');
    
    //$('.home-butorforgalmazas-slider').slideUp("slow");

    //$('.home-butorforgalmazas-slider').slick('slickRemove',null,null,true);

    $.ajax({
      url:'/wp-admin/admin-ajax.php',
      type:'POST',
      data:'action=arterior_retbar_ajax_action&filter'+$('input[name=filters]').val()+'&actcat='+$(this).data('cat')+'&actchoice='+$(this).data('choice'),
      success:function(results){
        results = $.parseJSON(results);
        //console.log(results);
        $('.filter-container').empty();
                $('.filter-container').html(results.filters_content);

                // Change slider
                //$('.home-butorforgalmazas-slider').live('slick','slickRemove',null,null,true);
                //$('.home-butorforgalmazas-slider').fadeOut( 1000);

                //$('.home-butorforgalmazas-slider').slick('slickAdd',results.content);
                //$('.home-butorforgalmazas-slider').slick('reinit');

                //console.log('ret bar '+results.count);

                $('.home-butorforgalmazas-grid').html('');
                $('.home-butorforgalmazas-grid').html(results.content);
                
                /*if(results.count < 3) {
                  $('.grid-div').css('display','inline-block');
                  $('.grid-div').css('float','none');
                }*/

                //console.log($('.home-butorforgalmazas-slider').height());
                //if($('.home-butorforgalmazas-grid').height() == 0) {
                if(results.count == 0) {
                  $('.home-butorforgalmazas-grid-container .no-results').show();
                } else {
                  $('.home-butorforgalmazas-grid-container .no-results').hide();
                }
                //$('.home-butorforgalmazas-slider').fadeIn( 1600);
                //$('.home-butorforgalmazas-slider').slideDown("slow");

                if($('input[name=erase-filters-button]').val()> 0) {
                  $('#erase-filters').show();
                } else {
                  $('#erase-filters').hide();
                }

                $('.grid-pager').empty();
                $('.grid-pager').html(results.pager_links);
      }
    });
  });

  jQuery('iframe').load( function() {
      /*$('iframe').contents().find("head")
      .append($("<style type='text/css'>  .my-class{display:none;}  </style>"));*/
      //jQuery("iframe").contents().find(".place-card").hide();
  });

  $('body').click(function(e){

    //console.log($('.filters-search').find('.ret_bar').is(':visible'));
    
    //console.log('ret bar '+$('.filters-search').find('.ret_bar').is(':hover'));

    //console.log('input '+$('.filters-search').find('input[name=search_bar]').is(':hover'));

    if($('.filters-search').find('.ret_bar').length) {

      if($('.filters-search').find('.ret_bar').is(':hover') == false && $('.filters-search').find('input[name=search_bar]').is(':hover') == false) {
        //console.log('close');
        $('.filters-search').find('.ret_bar').hide();
        $('.filters-search').find('input[name=search_bar]').val('');
      }

    }

  });

  $('.bimgo-gdl-slider').slick({
    autoplay: false,
    dots:false,
    arrows:true,
    slidesToShow: 3,
    slidesToScroll: 3,
    /*infinite: true,
    cssEase: 'linear',
    variableWidth: true,
    variableHeight: true,*/
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: false
          }
        },
        {
          /*breakpoint: 600,*/
          breakpoint: 960,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          /*breakpoint: 480,*/
          breakpoint:600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
  });

  $('.go-search').live('click',function(){
    //alert('itt');
    $(this).parent().submit();
    //return false;
  });

  $('.mobile-search').live('click',function(){
    if($('.mobile-search-container').is(':visible')) {
      $('.mobile-search-container').hide();
    } else {
      $('.mobile-search-container').show();
    }
  });

  $('.hambi-menu').live('click',function(){
    //if($('.mobile-menu-container').is(':visible')) {
      //$('.mobile-menu-container').hide();
    //} else {
      $('.mobile-menu-container').show();
    //}
  });

  $('.mobile-menu-container').find('.close').live('click',function(){
    if($('.mobile-menu-container').is(':visible')) {
      $('.mobile-menu-container').hide();
    }
  });

  $('.mobile-menu-class .menu-item a').live('click',function(){
    //alert('itt');
    $('.mobile-menu-container').hide();
    return true;
  });

  $('.grid-pager-link').live('click',function(){

    var page = $(this).data('page');

    $('.grid-page').hide('slow');

    $('#grid_page_'+page).show('slow');

    $('.grid-pager a').removeClass('act');

    $('#grid_pager_link_'+page).addClass('act');

    return false;
  });

  $('.info-button').live('click',function(e){
    var position = $(this).position();

    var width = $('.info-button-container').width()+25;

    console.log(e.pageX + " " + e.pageY);

    $('.info-button-container').css('bottom',position.top+5);
    $('.info-button-container').css('left',position.left-width);

    if($('.info-button-container').is(':visible')) {
      $('.info-button-container').hide('fast');
    } else {
      $('.info-button-container').show('fast');
    }
  });

  /*$('.footer-menu-container ul li:nth-child(3n)').after('<div class="break-foot-menu"></div>');*/

  $('.referenciak-more').live('click',function(){
    
    if($('.morebutton-clear').is(':visible')) {
      $('.morebutton-clear').hide();
    } else {
      $('.morebutton-clear').show();
    }
    if($('.referencia-grid-more').is(':visible')) {
      $('.referencia-grid-more').css('display','none');
    } else {
      $('.referencia-grid-more').fadeIn().css('display','inline-block');
    }
    return false;
  });

  //console.log(object_name.lang);

  if($('.langswitch-menu').hasClass('dark')) {
    var img_src = $('.langswitch-menu img').attr('src');
    //console.log(img_src);
    if(object_name.lang == "hu") {
      $('.langswitch-menu img').attr('src',object_name.templateUrl+'/polylang/en_GB-dark.png');
    } else {
      $('.langswitch-menu img').attr('src',object_name.templateUrl+'/polylang/hu_HU-dark.png');
    }
  }

  var $loading = $('.ajax-load').hide();
  
  $(document)
    .ajaxStart(function () {
      $loading.show();
    })
    .ajaxStop(function () {
      $loading.hide();
    });
      
  });

  new WOW().init();

  //$.stellar();
  $('.parallux').parallux({
    fullHeight: false,
    onMobile: 'fixed'
  });

  if(object_name.logged == 1 ) {
    $("#elemkonyvtar-block").show();
    $('#login-button').hide();
    $('#logout-button').show();
  } else {
    $("#elemkonyvtar-block").hide();
    $('#login-button').show();
    $('#logout-button').hide();
  }


})(jQuery);

