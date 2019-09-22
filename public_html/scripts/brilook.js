$(document).ready(function() {
  $(".sl").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true
  });

  $(".galery-link").magnificPopup({
    callbacks: {
      open: function() {
        $(".mfp-slider").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true
        });
      },
      close: function() {
        $(".mfp-slider").slick("unslick");
      }
    }
  });
  $(".galery-link").click(function() {
    $(".slick-list ").toggleClass("slick-list-brand");
  });
});
