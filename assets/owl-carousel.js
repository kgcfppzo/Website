$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      navText: [
        "<button class='custom-prev'><</button>",
        "<button class='custom-next'>></button>"
    ],
      autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      items:1,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  });
});