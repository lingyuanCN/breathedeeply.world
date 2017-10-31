<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Breathe Deeply - Favorite list</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="css/products.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<?php
  session_start();
?>
<body>
  <?php
  if(!isset($_SESSION['username']))
  {
    echo "<script> alert('Please login first.');parent.location.href='../Capstone/login.php'; </script>";
    exit();
  }
  else {
    $user=$_SESSION["userid"];
    $link =mysqli_connect('localhost','root','asdf1234') or exit('link failed');
    mysqli_query($link,'set name utf8');
    mysqli_select_db($link, 'database') or exit('fail to select database');
    $sql="select * from userinfo where userid ='$user'";
    $result=mysqli_query($link,$sql);
    $profile=mysqli_fetch_array($result);
  }
  ?>
  <div class="navbar navbar-default top-bar">
    <div class="container">
      <div class="navbar-header">
        <a href="./index.php" class="navbar-brand"></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="./products.php">Products</a></li>
        <li><a href="./profile.php">Profile</a></li>
        <li><a href="./contact.php">Contact us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="yo"><a href="./login.php">Login</a></li>
        <li id="hi"><a href="./register.php">Sign up</a></li>
        <li id="dropdown" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
              if($_SESSION)
              {
                echo $_SESSION["username"];
                echo "<script type='text/javascript'>var islogin = true;</script>";
              }
              else
              {
                echo 'User';
                echo "<script type='text/javascript'>var islogin = false;</script>";
              }
            ?>

            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li>
              <a href="#">
                <?php
                  if($_SESSION)
                  {
                    echo '<div>Signed in as</div><div><b>'.$_SESSION["username"].'</b></div>';
                  }
                  else
                  {
                    echo 'User';
                  }
                ?>
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="favoritelist.php">Favourite</a></li>
            <li class="divider"></li>
            <li id="sign-out"><a href="#">Sign out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row profile">
      <div class="col-sm-3">
        <div class="profile-sidebar">
          <div class="profile-user-title">
            <div class="profile-user-name">
              <?php
              if($profile['firstname']||$profile['lastname'])
              {
                echo $profile['firstname'].'&nbsp;'.$profile['lastname'];
              }
              else
              {
                echo $profile['username'];
              }
              ?>
            </div>
            <div class="profile-user-job">
              <?php echo $profile['email']; ?>
            </div>
          </div>
          <!-- <div class="profile-user-buttons">
            <button id="edit" class="btn btn-success btn-sm">Edit profile</button>
          </div> -->
          <div class="profile-user-menu">
            <ul class="nav">
              <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
              <li><a id="home" href="#"><i class="glyphicon glyphicon-home"></i>My Home</a></li>
              <li><a id="work" href="#"><i class="glyphicon glyphicon-map-marker"></i>Work Location</a></li>
              <li><a href="favoritelist.php"><i class="glyphicon glyphicon-heart"></i>Favourite</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-sm-9">
        <div class="panel panel-default">
          <div class="panel-heading hometitle"><b>Favorite location list<b></div>
          <div class="panel-body">
            <table class="table table-hover table-responsive favoritelist">
              <thead>
                <tr>
                  <td><b>Region</b></td>
                  <td><b>Location</b></td>
                  <td></td>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div style="display:inline;height:75px;display:float-left;" class="">
          <img style="box-shadow:5px 2px 6px #white; height: 50px;" src="img/logo.png">
        </div>
        <div style="display:inline;color:#eeeeee;display:float-left;" class="">
          <h6>Capstone Project</h6>
          <h6>Copyright@ Group39 2017</h6>
        </div>
        <div class="col-sm-2">
        </div>
      </div>
    </div>
  </footer>
</body>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script type="text/javascript">
$(function(){
  if(islogin){
    $('#yo').hide();
    $('#hi').hide();
    $('#dropdown').show();
  }
  else {
    $('#yo').show();
    $('#hi').show();
    $('#dropdown').hide();
  }

  $('#home').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.home,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.home;
      })
    });
  })

  $('#work').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.work,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.work;
      })
    });
  })

  $.post("ajax_favoriteLocation.php?userid="+<?php echo $_SESSION['userid']; ?>,function(json){
    var list = JSON.parse(json);
    for (var i = 0; i < list.length; i++) {
      $('.favoritelist tbody').append("<tr><td>"+list[i].state+"</td><td><button class='btn btn-primary list' value="+i+">"+list[i].location+"</button></td><td><button class='btn btn-danger delete' value="+i+">DELETE</button></td></tr>");
    }
    $('.list').on('click',function() {
      var index = event.target.value;
      parent.location.href='../Capstone/favorite.php?state='+list[index].state+'&location='+list[index].location;
    });
    $('.delete').on('click',function() {
      var index = event.target.value;
      $.post('ajax_deletefavorite.php?location='+list[index].location+'&userid='+'<?php echo $_SESSION['userid']; ?>',function(msg){
        parent.location.href='favoritelist.php';
      });
    });
  });

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
</script>
</html>
