$(function() {
    $.scroll();

    if (window.location.hash) {
        $.animateScroll(700, window.location.hash);
    }
});

$.animateScroll=function(a,c,d){var b=$(c).offset().top;if(d!=undefined){b+=d}$("html, body").animate({scrollTop:b},a)};

$.scroll = function()
{
    $(".scrollTo").on({
        click: function(a) {
            a.preventDefault();
            $.animateScroll(700, $(this).attr("href"));
        }
    })
};
