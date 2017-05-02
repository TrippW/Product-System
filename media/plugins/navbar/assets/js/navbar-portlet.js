$(document).ready(function(){
	if ($('#bhb-navbar-scrollspy').length > 0 && $('#bhb-navbar-scrollspy').val() == 1){
		$('body').scrollspy({target: '.navbar-static-top'});
	}
    var navbar_height = $('.navbar-static-top').outerHeight(true);
    $('.navbar-static-top').parent().height(navbar_height);
    
    $(".navbar").sticky({ topSpacing: 0 });
});