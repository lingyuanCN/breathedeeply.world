$(function()
{
    $(window).scroll(function()
    {
        var landing = document.documentElement.scrollTop + document.body.scrollTop;
        if( landing >300 )
        {
            $("#back-top").fadeIn(400);
        }
        else
        {
            $("#back-top").stop().fadeOut(400);
        }
    });
    $("#back-top").click(function(){
        $("body").animate({scrollTop:"0px"},200);
    });
});
