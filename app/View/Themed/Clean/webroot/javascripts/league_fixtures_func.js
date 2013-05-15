$(document).ready(function() {

	// slide toggle the side nav
	$('#sideNav > ul > li:has("ul") > a').click(

			function (e) {
				
				$(this).toggleClass('active');
				$(this).parent('li').children('ul').slideToggle(160);

				e.preventDefault();
	     		return false;
			}

	);

	// slide toggle the details row in the table
	$('#scoresAndResults tbody tr td a.more').click(
		
		function (e) {
			$(this).parent().parent().next('tr.details').slideToggle(160);

			e.preventDefault();
     		return false;
		}
		
	);

	// rotating the videos section
	$("#videoRotator").jCarouselLite({
        btnNext: "#videos .next",
        btnPrev: "#videos .prev",
        visible: 1
    });
	
});