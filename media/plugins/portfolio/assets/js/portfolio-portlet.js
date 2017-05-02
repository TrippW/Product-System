$(window).load(function() {
	$('.bhb-portfolio-isotope-container').each(function(){
		var _this = $(this);
		var container = $(this).children('.portfolio-isotope-items').isotope({});
		$(this).find('.portfolio-filters a[data-filter="*"]').addClass('active');
		// filter items when filter link is clicked
		$(this).find('.portfolio-filters div').click(function() {
			_this.find('.portfolio-filters div').removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			container.isotope({
				filter : selector
			});
			return false;
		});
	});
	
	$('.bhb-portfolio-isotope-container .portfolio-isotope-items > .portfolio-item > div').click(function(){
		var portfolio_id = $(this).data('portfolio-id');
		$('#portfolio-modal-'+portfolio_id).modal('show');
	});
	
});

$(window).resize(function() {
	// ISOTOPE Again, in order to fix the resizing bug
	var container = $('.bhb-portfolio-isotope-container  .portfolio-isotope-items');
	container.isotope({});

});