$(document).ready(function() {
    $('.faq-portlet-item').on('show.bs.collapse', function() {
        var id = $(this).attr('id');
        $('#' + id + '-title').children('.icon').html('- ');
    });
    $('.faq-portlet-item').on('hide.bs.collapse', function() {
        var id = $(this).attr('id');
        $('#' + id + '-title').children('.icon').html('+ ');
    });
});