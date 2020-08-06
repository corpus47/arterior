/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  $(document).ready(function () {
    // Ugrás a főoldalra másik oldalról
    // The speed of the scroll in milliseconds
    console.log(object_name.site_url);

    if (object_name.front_page == 0) {
      $('.dropdown-item').each(function () {
        var currentHref = $(this).attr('href');
        var newHref = object_name.site_url + currentHref;
        console.log(newHref);
        $(this).attr('href', newHref);
      });
      $('.contact-menu').each(function () {
        var currentHref = $(this).attr('href');
        var newHref = object_name.site_url + currentHref;
        console.log(newHref);
        $(this).attr('href', newHref);
      });
    }

    var speed = 1000;
    $('a[href*="#"]').filter(function (i, a) {
      return a.getAttribute('href').startsWith('#') || a.href.startsWith("".concat(location.href, "#"));
    }).unbind('click.smoothScroll').bind('click.smoothScroll', function (event) {
      var targetId = event.currentTarget.getAttribute('href').split('#')[1];
      var targetElement = document.getElementById(targetId);

      if (targetElement) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: $(targetElement).offset().top
        }, speed);
      }
    });
    $('.slider-container').slick({
      autoplay: true,
      dots: true,
      customPaging: function customPaging(slider, i) {
        return '<a href="#"><img src="' + object_name.templateUrl + '/images/slide-dot.png" /><img src="' + object_name.templateUrl + '/images/slide-dot-active.png" /></a>';
      },
      arrows: true
      /*infinite: true,
      cssEase: 'linear',
      variableWidth: true,
      variableHeight: true,*/

    });
    $(".home-referencia-slider").on("init", function (event, slick) {
      /*$(".pagingInfo").text(parseInt(slick.currentSlide + 1));*/
      $(this).append('<div class="slick-counter">' + parseInt(slick.currentSlide + 1, 10));
    });
    $('.home-referencia-slider').slick({
      autoplay: false,
      dots: false,
      arrows: true,
      slidesToShow: 3,
      slidesToScroll: 3,

      /*infinite: true,
      cssEase: 'linear',
      variableWidth: true,
      variableHeight: true,*/
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: false
        }
      }, {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      } // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
      ]
    });
    $(".home-referencia-slider").on("afterChange", function (event, slick, currentSlide) {
      /*$(".pagingInfo").text(parseInt(slick.currentSlide + 1));*/
      $(this).find('.slick-counter').html(slick.currentSlide + 1);
    });
    $('.dropdown').hover(function () {
      $(this).find('.dropdown-menu').addClass('show');
      $(this).find(".nav-link").css("border", "1px solid #ffffff");
    });
    $('.dropdown-menu').mouseleave(function () {
      if ($(".dropdown-menu").hasClass("show")) {
        setTimeout(function () {
          ///workaround
          $(".dropdown-menu").removeClass("show");
          $(".dropdown").find(".nav-link").css("border", "1px solid transparent");
        }, 10);
      }
    });
    $(".main-container").mousemove(function () {
      if ($(".dropdown").is(":hover") === false && $(".dropdown-menu").is(":hover") === false) {
        if ($(".dropdown-menu").hasClass("show")) {
          setTimeout(function () {
            ///workaround
            $(".dropdown-menu").removeClass("show");
            $(".dropdown").find(".nav-link").css("border", "1px solid transparent");
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

    $('.scroll-to-top').click(function (event) {
      event.preventDefault();
      $('html, body').animate({
        scrollTop: 0
      }, 'slow');
      return false;
    });
    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        $('.scroll-to-top').addClass('show');
      } else {
        $('.scroll-to-top').removeClass('show');
      }
    });
    $('.category-link').live('click', function () {
      $('.filter-categories-bar').find('.category-link').removeClass('active-cat');
      $(this).addClass('active-cat'); //console.log($(this).next().attr('class'));

      $('.filter-categories-bar').find('.category-link-footer').removeClass('active-foot-class');
      $(this).next().addClass('active-foot-class');
      $('input[name=actcat]').val($(this).data('catname'));
      $('.filters-elements-container').find('.filter-elements').removeClass('visibled');
      $('#' + $(this).data('catname')).addClass('visibled');
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
    $('.home-butorforgalmazas-slider').on('init', function (event, slick) {
      //console.log('init');
      //console.log($('.home-butorforgalmazas-slider').height());
      Height_init = $('.home-butorforgalmazas-slider').height(); //console.log(Height_init);
    });
    $('.home-butorforgalmazas-slider').slick({
      autoplay: false,
      dots: false,
      arrows: true,
      slidesToShow: 3,
      slidesToScroll: 3,

      /*infinite: true,
      cssEase: 'linear',
      variableWidth: true,
      variableHeight: true,*/
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: false
        }
      }, {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      } // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
      ]
    });
    $('#erase-filters').live('click', function () {
      console.log('filter erase');
      var Height = $('.home-butorforgalmazas-slider').height();

      if (Height < Height_init) {
        Height = Height_init;
      }

      $('.home-butorforgalmazas-slider-container').css('height', Height + "px");
      $('.home-butorforgalmazas-slider-container').css('display', 'block');
      $('.home-butorforgalmazas-slider').slick('slickRemove', null, null, true);
      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: 'action=arterior_ajax_action&filters=' + $('[name=filters]').val() + '&actcat=' + $('input[name=actcat]').val() + '&actchoice=' + $(this).data('choice') + '&erasefilter=1',
        success: function success(results) {
          results = $.parseJSON(results); //console.log(results);

          $('.filter-container').empty();
          $('.filter-container').html(results.filters_content); // Change slider

          $('.home-butorforgalmazas-slider').slick('slickAdd', results.content);
          $('.home-butorforgalmazas-slider').slick('reinit');

          if ($('.home-butorforgalmazas-slider').height() == 0) {
            $('.home-butorforgalmazas-slider-container .no-results').show();
          } else {
            $('.home-butorforgalmazas-slider-container .no-results').hide();
          }

          if ($('input[name=erase-filters-button]').val() > 0) {
            $('#erase-filters').show();
          } else {
            $('#erase-filters').hide();
          }
        }
      });
    });
    $('.filter-element').live('click', function () {
      //console.log($(this).data('choice'));
      //$('.home-butorforgalmazas-slider').hide();
      var Height = $('.home-butorforgalmazas-slider').height(); //$('.home-butorforgalmazas-slider-container').height(Height);

      if (Height < Height_init) {
        Height = Height_init; //$('.home-butorforgalmazas-slider-container .no-results').show();
      } else {//$('.home-butorforgalmazas-slider-container .no-results').hide();
        } //console.log(Height);


      $('.home-butorforgalmazas-slider-container').css('height', Height + "px");
      $('.home-butorforgalmazas-slider-container').css('display', 'block'); //$('.home-butorforgalmazas-slider').slideUp("slow");

      $('.home-butorforgalmazas-slider').slick('slickRemove', null, null, true);
      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: 'action=arterior_ajax_action&filters=' + $('input[name=filters]').val() + '&actcat=' + $('input[name=actcat]').val() + '&actchoice=' + $(this).data('choice'),
        success: function success(results) {
          //console.log(results);
          results = $.parseJSON(results); //console.log(results);

          $('.filter-container').empty();
          $('.filter-container').html(results.filters_content); // Change slider
          //$('.home-butorforgalmazas-slider').live('slick','slickRemove',null,null,true);
          //$('.home-butorforgalmazas-slider').fadeOut( 1000);

          $('.home-butorforgalmazas-slider').slick('slickAdd', results.content);
          $('.home-butorforgalmazas-slider').slick('reinit'); //console.log($('.home-butorforgalmazas-slider').height());

          if ($('.home-butorforgalmazas-slider').height() == 0) {
            $('.home-butorforgalmazas-slider-container .no-results').show();
          } else {
            $('.home-butorforgalmazas-slider-container .no-results').hide();
          } //$('.home-butorforgalmazas-slider').fadeIn( 1600);
          //$('.home-butorforgalmazas-slider').slideDown("slow");


          if ($('input[name=erase-filters-button]').val() > 0) {
            $('#erase-filters').show();
          } else {
            $('#erase-filters').hide();
          }
        }
      });
    });

    if ($('.filters-search').find('.search_bar').length) {
      var filters_search_bar = $('.filters-search').find('.search_bar');
      console.log(filters_search_bar.height()); //var ret_bar_top = filters_search_bar.position().top + 10px;

      $('.filters-search').find('.ret_bar').css('top', filters_search_bar.position().top + (filters_search_bar.height() + 9) + "px");
    } //$('.filters-search').find('.ret_bar').css('width',filters_search_bar.width()+"px");


    $('.click-button').live('click', function () {
      $('.ret_bar').find('.ret_bar_link').first().trigger('click');
    });
    $('.filters-search').find('input[name=search_bar]').live('keyup', function (e) {
      // e.keyCode === 13 ENTER
      // e.keyCode === 27 ESC
      var KeyCode = e.keyCode;
      console.log(KeyCode);
      console.log($(this).val());

      if (KeyCode >= 37 && KeyCode <= 40) {
        //console.log('nyil');
        return;
      }

      if (KeyCode === 27) {
        // console.log(KeyCode);
        $('.filters-search').find('input[name=search_bar]').val('');
        $('.filters-search').find('.ret_bar').hide();
      } else if (KeyCode === 13) {
        //alert('Press ENTER!');
        //return;
        $('.ret_bar').find('.ret_bar_link').first().trigger('click');
      } else if ($('.filters-search').find('input[name=search_bar]').val() !== "") {
        $('.filters-search').find('.ret_bar').html('');
        $.ajax({
          url: "/wp-admin/admin-ajax.php",
          type: 'POST',
          data: 'action=arterior_search_ajax_action&search_string=' + $(this).val(),
          success: function success(results) {
            results = $.parseJSON(results);
            console.log(results.content);
            $('.filters-search').find('.ret_bar').html(results.content); //$('.filters-search').find('.ret_bar').text($('.filters-search').find('input[name=search_bar]').val());
            //if($('.filters-search').find('.search_bar').lenth){

            $('.filters-search').find('.ret_bar').css('top', $('.filters-search').find('.search_bar').position().top + ($('.filters-search').find('.search_bar').height() + 9) + "px"); //}

            $('.filters-search').find('.ret_bar').show();
          }
        }); //$('.filters-search').find('.ret_bar').text($('.filters-search').find('input[name=search_bar]').val());
        //$('.filters-search').find('.ret_bar').show();
      } else {
        $('.filters-search').find('.ret_bar').html('');
        $('.filters-search').find('.ret_bar').hide();
      }
    });
    $('.ret_bar_link').live('click', function () {
      var href = $(this).data('href');

      if (typeof href !== 'undefined') {
        window.location.href = href;
      }

      var Height = $('.home-butorforgalmazas-slider').height(); //$('.home-butorforgalmazas-slider-container').height(Height);

      if (Height < Height_init) {
        Height = Height_init; //$('.home-butorforgalmazas-slider-container .no-results').show();
      } else {//$('.home-butorforgalmazas-slider-container .no-results').hide();
        } //console.log(Height);


      $('.home-butorforgalmazas-slider-container').css('height', Height + "px");
      $('.home-butorforgalmazas-slider-container').css('display', 'block'); //$('.home-butorforgalmazas-slider').slideUp("slow");

      $('.home-butorforgalmazas-slider').slick('slickRemove', null, null, true);
      $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: 'action=arterior_retbar_ajax_action&filter' + $('input[name=filters]').val() + '&actcat=' + $(this).data('cat') + '&actchoice=' + $(this).data('choice'),
        success: function success(results) {
          results = $.parseJSON(results); //console.log(results);

          $('.filter-container').empty();
          $('.filter-container').html(results.filters_content); // Change slider
          //$('.home-butorforgalmazas-slider').live('slick','slickRemove',null,null,true);
          //$('.home-butorforgalmazas-slider').fadeOut( 1000);

          $('.home-butorforgalmazas-slider').slick('slickAdd', results.content);
          $('.home-butorforgalmazas-slider').slick('reinit'); //console.log($('.home-butorforgalmazas-slider').height());

          if ($('.home-butorforgalmazas-slider').height() == 0) {
            $('.home-butorforgalmazas-slider-container .no-results').show();
          } else {
            $('.home-butorforgalmazas-slider-container .no-results').hide();
          } //$('.home-butorforgalmazas-slider').fadeIn( 1600);
          //$('.home-butorforgalmazas-slider').slideDown("slow");


          if ($('input[name=erase-filters-button]').val() > 0) {
            $('#erase-filters').show();
          } else {
            $('#erase-filters').hide();
          }
        }
      });
    });
    jQuery('iframe').load(function () {
      /*$('iframe').contents().find("head")
      .append($("<style type='text/css'>  .my-class{display:none;}  </style>"));*/
      //jQuery("iframe").contents().find(".place-card").hide();
    });
    $('body').click(function (e) {
      //console.log($('.filters-search').find('.ret_bar').is(':visible'));
      //console.log('ret bar '+$('.filters-search').find('.ret_bar').is(':hover'));
      //console.log('input '+$('.filters-search').find('input[name=search_bar]').is(':hover'));
      if ($('.filters-search').find('.ret_bar').length) {
        if ($('.filters-search').find('.ret_bar').is(':hover') == false && $('.filters-search').find('input[name=search_bar]').is(':hover') == false) {
          //console.log('close');
          $('.filters-search').find('.ret_bar').hide();
          $('.filters-search').find('input[name=search_bar]').val('');
        }
      }
    });
    $('.bimgo-gdl-slider').slick({
      autoplay: false,
      dots: false,
      arrows: true,
      slidesToShow: 3,
      slidesToScroll: 3,

      /*infinite: true,
      cssEase: 'linear',
      variableWidth: true,
      variableHeight: true,*/
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: false
        }
      }, {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      } // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
      ]
    });
    var $loading = $('.ajax-load').hide();
    $(document).ajaxStart(function () {
      $loading.show();
    }).ajaxStop(function () {
      $loading.hide();
    });
  });
})(jQuery);

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./src/app.js ./src/app.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\dev\arterior\wp-content\themes\arterior\src\app.js */"./src/app.js");
module.exports = __webpack_require__(/*! C:\dev\arterior\wp-content\themes\arterior\src\app.scss */"./src/app.scss");


/***/ })

/******/ });