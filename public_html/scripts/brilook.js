$(document).ready(function() {
  $(document).ready(function() {
    $(".galery-link").click(function() {
      $(".slick-list ").toggleClass("slick-list-brand");
    });
  });

  $(".sl").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    // autoplay: true,
    // autoplaySpeed: 2000,
    dots: true
  });

  // ==========magnific==========
  $(".galery-link").magnificPopup({
    callbacks: {
      open: function() {
        $(".mfp-slider").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true
        });
      }
    }
  });
});
