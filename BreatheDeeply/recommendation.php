<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Breathe Deeply - Recommendation</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link href="https://cdn.bootcss.com/weather-icons/2.0.10/css/weather-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/favorite.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/widget.css">
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


  <div class="navbar navbar-pills">
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

  <div id="a-container" class="container">
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
        <h3><b>Add locations into your favorite list for recommendation information</b></h3>
        <br>
        <div class="panel panel-default">
          <div class="panel-heading hometitle"><b>Recommendation</b> - suitable for outdoor activities</div>
          <div class="panel-body">
            <table class="table table-hover table-responsive recommendation">
              <thead>
                <tr>
                  <td><b>Region</b></td>
                  <td><b>Location</b></td>
                  <td><b>Weather</b></td>
                  <td><b>AQI</b></td>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading hometitle"><b>Warning</b> - Not suitable for outdoor activities, need to do extra protection</div>
          <div class="panel-body">
            <table class="table table-hover table-responsive warning">
              <thead>
                <tr>
                  <td><b>Region</b></td>
                  <td><b>Location</b></td>
                  <td><b>Weather</b></td>
                  <td><b>AQI</b></td>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading hometitle"><b>Others</b></div>
          <div class="panel-body">
            <table class="table table-hover table-responsive otherlocation">
              <thead>
                <tr>
                  <td><b>Region</b></td>
                  <td><b>Location</b></td>
                  <td><b>Weather</b></td>
                  <td><b>AQI</b></td>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>
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

<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script src="js/aqi.js"></script>
<script type="text/javascript">
$.ajaxSetup({
  async : false
});
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
    var air_sensitive=<?php echo $profile['air_sensitive']; ?>;
    for (var i = 0; i < list.length; i++) {
      var state=list[i].state;
      var location=list[i].location;

      var aqi = getIndex(state,location);
      if(aqi>=0){
        $.post("ajax_getInfo.php?state="+state+"&location="+location,function(json){
          var info = JSON.parse(json);
          var code=info.code;
          if(getRecommendation(aqi,code,air_sensitive)==1){
            $('.recommendation tbody').append("<tr><td>"+state+"<td><button class='btn btn-success list' value="+i+">"+location+"</button></td><td>"+info.temp+"℃ "+info.text+"</td><td>"+aqi+"</td></tr>");
          }else if(getRecommendation(aqi,code,air_sensitive)==-1) {
            $('.warning tbody').append("<tr><td>"+state+"<td><button class='btn btn-danger list' value="+i+">"+location+"</button></td><td>"+info.temp+"℃ "+info.text+"</td><td>"+aqi+"</td></tr>");
          }else {
            $('.otherlocation tbody').append("<tr><td>"+state+"<td><button class='btn btn-warning list' value="+i+">"+location+"</button></td><td>"+info.temp+"℃ "+info.text+"</td><td>"+aqi+"</td></tr>");
          }
        })
      }
    }

    $('.list').on('click',function() {
      var index = event.target.value;
      parent.location.href='../Capstone/favorite.php?state='+list[index].state+'&location='+list[index].location;
    });

  });

  function getRecommendation(aqi,code,isSensitive){
    function isInArray(arr,value){
        for(var i = 0; i < arr.length; i++){
            if(value == arr[i]){
                return true;
            }
        }
        return false;
    }
    var sunny = [32,34,36];
    var cloudy = [0,2,19,20,21,22,23,24,25,26,28,30,44];
    var rainy = [1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,35,37,38,39,40,41,42,43,45,46,47];
    var night = [27,29,31,33];

    if(isSensitive){
      if(aqi<=50&&(isInArray(sunny,code)||isInArray(cloudy,code))){
        return 1;
      }
      else if (aqi>100||isInArray(rainy,code)) {
        return -1;
      }
      else {
        return 0;
      }
    }else {
      if(aqi<=100&&(isInArray(sunny,code)||isInArray(cloudy,code))){
        return 1;
      }
      else if (aqi>150||isInArray(rainy,code)) {
        return -1;
      }
      else {
        return 0;
      }
    }
  }


  function getIndex(state,location){
    var locationAPI='https://api.openaq.org/v1/latest?country=AU&city='+state+'&location='+location;
    var index;
    var contentJson;
    function getjson(){
      $.ajax({
        url: locationAPI,
        async: false,
        dataType : 'json',
        success: function(data){
            result = data;
        }
      });
      return result;
    }
    contentJson = getjson();
    index = getAqi(contentJson);

    function getAqi(props) {
      var value = -1;
      for (var i = 0; i < props.results[0].measurements.length; i++) {
        if (value < aqi(props.results[0].measurements[i].parameter, props.results[0].measurements[i].value, props.results[0].measurements[i].averagingPeriod.value)) {
          value = aqi(props.results[0].measurements[i].parameter, props.results[0].measurements[i].value, props.results[0].measurements[i].averagingPeriod.value);
        }
      }
      return value;
    }
    return index;
  }
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
