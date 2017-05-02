$(document).ready(function(){
	$('.bhb-display-html-code').each(function(){
		$(this).html(prettyPrintOne($(this).html(),"html"))
	});
});