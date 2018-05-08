jQuery(document).ready(function($){

/* Mean Menu */
  jQuery('.main-navigation').meanmenu({
      meanMenuContainer: '.bottom-header',
      meanScreenWidth:"850"
    });

/* slick slider starts */

$('.slick-main-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  fade: true,
  arrows:true,
  autoplay: true
  
});

//testimonials slider
$('.tt-testimonial-item-main').slick({
  dots: true,
  infinite: true,
  speed: 300,
  fade: true,
  arrows:false,
  autoplay: true,
  responsive: [
    {
      breakpoint: 479,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  
});


// Partners-slider

  $('.tt-partners-main').slick({
  dots: true,
  infinite: true,
  speed: 600,
  slidesToShow: 5,
  arrows:true,
  slidesToScroll: 2,
  autoplay:true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows:false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows:false
      }
    },
    {
      breakpoint: 551,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows:false
      }
    },
    {
      breakpoint: 479,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

// Go to top.
  var $scroll_obj = $( '#btn-gotop' );
  $( window ).scroll(function(){
    if ( $( this ).scrollTop() > 100 ) {
      $scroll_obj.fadeIn();
    } else {
      $scroll_obj.fadeOut();
    }
  });

  $scroll_obj.click(function(){
    $( 'html, body' ).animate( { scrollTop: 0 }, 600 );
    return false;
  });

});