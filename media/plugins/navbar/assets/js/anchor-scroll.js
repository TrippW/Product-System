$(document).ready(function() {
	$('.anchor-scroll a').click(function(event) {
		var anchor = $(this);
		var navbar_height = $('.navbar').height();
		$('html, body').stop().animate({
			scrollTop : $(anchor.attr('href')).offset().top
		}, 1200, 'easeOutQuint');
		event.preventDefault();
	});
});