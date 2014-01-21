$(function() {
    $.viewEvent();
    $.search();

    $('.textEditor').jqte();
});

$.viewEvent = function()
{
    /*$("a.view").on("click", function() {
        $('#modal').modal({
            remote: $(this).attr("href"),
            show: true
        }) 

        $.viewEvent();

        return false;
    });*/
}

$.search = function()
{
    $('#search').on('click', function(){
       $('.searchForm').toggle(); 
       
       if ($('.searchForm').is(':visible')) {
           $(this).addClass('active');
       } else {
           $(this).removeClass('active');
       }
    });
}
