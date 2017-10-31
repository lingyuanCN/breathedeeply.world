$(function(){
  function footerPosition(){
    $("footer").removeClass("fixed-bottom");
    var contentHeight = document.body.scrollHeight,//网页正文全文高度
      winHeight = window.innerHeight;//可视窗口高度，不包括浏览器顶部工具栏
    if(!(contentHeight > winHeight)){
      //当网页正文高度小于可视窗口高度时，为footer添加类fixed-bottom
      $("footer").addClass("fixed-bottom");
    }
  }
  footerPosition();
  $(window).resize(footerPosition);

  $("#sign-out").click(function(){
    $.post("ajax_signout.php?action=logout",function(msg){
      if(msg==1){
        parent.location.href='../Capstone/login.php';
      }
    });
  })

  if(islogin){
    $('#yo').hide();
    $('#dropdown').show();
  }
  else {
    $('#yo').show();
    $('#dropdown').hide();
  }
});
