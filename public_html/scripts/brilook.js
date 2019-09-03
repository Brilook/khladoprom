$('#input0').click(function() {
	if($("select#input0 :selected").val() == "ru") {
	   $("select#input0").attr('style', 'background-image:url(images/ru.png);');
	}
	if($("select#input0 :selected").val() == "eng") {
	   $("select#input0").attr('style', 'background-image:url(images/us.png);');
	}
	if($("select#input0 :selected").val() == "ua") {
	   $("select#input0").attr('style', 'background-image:url(images/ua.png);');
	}
   });
