$(document).ready(function(){
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

$(function(){
	$('.button-text a').click(function(){
		$(this).toggleClass('selected');
	});
});



$('.autoplay').slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	autoplay: true,
	autoplaySpeed: 2000,
  });
});