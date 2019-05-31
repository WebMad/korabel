$( document ).ready(function () {
    $('.msg-close').bind('click', function(e){console.log($(e.currentTarget).parent().hide())})
});