$(document).ready(function () {
	$('#input0').click(function () {
		if ($("select#input0 :selected").val() == "ru") {
			$("select#input0").attr('style', 'background-image:url(images/ru.png);');
		}
		if ($("select#input0 :selected").val() == "eng") {
			$("select#input0").attr('style', 'background-image:url(images/us.png);');
		}
		if ($("select#input0 :selected").val() == "ua") {
			$("select#input0").attr('style', 'background-image:url(images/ua.png);');
		}
	});

	$('.sl').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		dots: true,
	});

	// ==========magnific==========
	$('.galery-link').magnificPopup({
		callbacks: {
			open: function () {
				$('.mfp-slider').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
				});
			}
		}
	});
});