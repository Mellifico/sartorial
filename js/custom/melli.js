// Joyride demo
$('#start-jr').on('click', function() {
  $(document).foundation('joyride','start');
});

//slick
$('.slider-basic').slick({
	  autoplay: true,
	  autoplaySpeed: 4000,
	  arrows:false,
	  dots: false,
	});

$('.slider-a').slick({
    autoplay: false,
    fade: true,
    arrows:true,
    dots: true,
  });

 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true
});
//lettering
$(".lettres").lettering();

// fittext
$("#big").fitText(1.2);
$("#sp-big").fitText(1.4);
$(".fattext").fitText(1.4);

// masonry + imagesloaded

var $container = $('#msnry-gallery').masonry();
// layout Masonry again after all images have loaded
$container.imagesLoaded( function() {
  $container.masonry({
  	itemSelector: '.item'
  });
});

var $container_seals = $('#seals-wall').masonry();
// layout Masonry again after all images have loaded
$container_seals.imagesLoaded( function() {
  $container_seals.masonry({
    itemSelector: '.seal'
  });
});

var $container_items = $('#msnry-a').masonry();
// layout Masonry again after all images have loaded
$container_items.imagesLoaded( function() {
  $container_items.masonry({
columnWidth: '.large-6',
itemSelector: '.item',
percentPosition: true
  });
});

// magnific popup
$('.galerie').magnificPopup({
  delegate: 'a:not(.except)', // child items selector, by clicking on it popup will open
  type: 'image',
    gallery:{
    enabled:true
  }
  // other options
});
// chrome bug : https://github.com/dimsemenov/Magnific-Popup/issues/125


// On popup open, put initial width on covering element.
$('.skrollr-popup').magnificPopup({
  delegate: 'a:not(.except)', // child items selector, by clicking on it popup will open
    type: 'image',
          fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',

});


//MAGELLAN
$(document).foundation({
"magellan-expedition": {

  active_class: 'active', // specify the class used for active sections
  threshold: 0, // how many pixels until the magellan bar sticks, 0 = auto
  destination_threshold: 20, // pixels from the top of destination for it to be considered active
  throttle_delay: 50, // calculation throttling to increase framerate
  fixed_top: 0, // top distance in pixels assigend to the fixed element on scroll
  offset_by_height: true // whether to offset the destination by the expedition height. Usually you want this to be true, unless your expedition is on the side.
}
});

// SKROLLR
  var s = skrollr.init();
if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
    var s = skrollr.init({
        forceHeight: false
    });
}
// ANIMSITION
// $('.animsition').animsition({
  
//     inClass               :   'fade-in-up-sm',
//     outClass              :   'fade-out-up-lg',
//     inDuration            :    1500,
//     outDuration           :    1500,
//     linkElement           :   '.top-bar a',
//     // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
//     loading               :    true,
//     loadingParentElement  :   'body', //animsition wrapper element
//     loadingClass          :   'animsition-loading',
//     unSupportCss          : [ 'animation-duration',
//                               '-webkit-animation-duration',
//                               '-o-animation-duration'
//                             ],
//     //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
//     //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    
//     overlay               :   false,
    
//     overlayClass          :   'animsition-overlay-slide',
//     overlayParentElement  :   'body'
//   });