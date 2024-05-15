$(document).ready(function () {
    $('.radio-group .radio').click(function () {
        $('.selected .fa').removeClass('fa-check');
        if($(this).attr('value')=="standard")
        $("#standard").prop("checked", true);
        else if($(this).attr('value')=="express")
        $("#express").prop("checked", true);
        $('.radio').removeClass('selected');
        $(this).addClass('selected');
    });
});