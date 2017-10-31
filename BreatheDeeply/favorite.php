<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Breathe Deeply - Favorite</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link href="https://cdn.bootcss.com/weather-icons/2.0.10/css/weather-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/favorite.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/widget.css">
  <link rel="stylesheet" href="css/products.css">
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

  <div class="topbackground img-responsive"></div>

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
        <div class="panel panel-default panel-city">
          <div class="panel-heading">
            <div class="panel-title">
              <div id="starContainer" class="panel-title">
                Air Quality Parameters
                <img id="star" src="" align="right">
                <div class="small">latest air quality details</div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <span class="parameter-control">
            </span>
            <table class="api">
              <tbody>
                <tr>
                  <td style="padding-right:5px; width:50%">
                    <span class="aqivalue-control"></span>
                  </td>
                  <td style="width:50%" nowarp="true">
                    <span class="aqiinfo-control"></span>
                    <span class="updateinfo-control"></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <br>
            <div class="parameter">
            </div>
          </div>
        </div>

        <div id="widget">
          <div class="header"></div>
          <div class="rows">
            <div class="col-sm-3">
              <table>
                <tbody>
                  <tr>
                    <td>
                      <i id="current-weather-icon" class="current wi"></i>
                      <i class="current-weather-temperature"></i>
                      <i id="current-weather-icon" class="wi wi-celsius"></i>
                    </td>
                  </tr>
                  <tr>
                    <td class="weather-description"></td>
                  </tr>
                  <tr>
                    <td class="wind"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-9 table-responsive">
              <table class="forecast-10 table">
                <thead>
                  <tr class="day"></tr>
                </thead>
                <tbody>
                  <tr class="date"></tr>
                  <tr class="icon"></tr>
                  <tr class="temp"></tr>
                  <tr class="text"></tr>
                </tbody>
              </table>
            </div>
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

<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/aqi.js"></script>
<script src="js/aqiRange.js"></script>
<script src="js/showTopPic.js"></script>
<script src="js/Chart.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){

  var userid = '<?php echo $_SESSION['userid']; ?>';


  $('#home').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.home,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.home;
      })
    });
  })

  $('#work').on('click',function(){
    console.log(1);
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.work,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.work;
      })
    });
  })

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

  function request(paras){
  var url = decodeURIComponent(location.href);
  var paraString = url.substring(url.indexOf("?")+1,url.length).split("&");
  var paraObj = {}
  for (i=0; j=paraString[i]; i++){
    paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=")+1,j.length);
    }
    var returnValue = paraObj[paras.toLowerCase()];
    if(typeof(returnValue)=="undefined"){
      return "";
    }
    else{
    return returnValue;
    }
  }

  var weathercode=3200;
  var locationName = request("location");
  var stateName = request("state");
  // var locationName = "South Brisbane";
  // var stateName = "South East Queensland";
  $.ajaxSetup({
    async : false
  });
  $.post("ajax_widget.php?location="+locationName,function(json){
    var forecast = JSON.parse(json);
    $('#widget .header').append(forecast.city+', '+forecast.location.region+', '+forecast.location.country);
    var weather_icon_str = forecast.current.weather_icon_str;
    var icon_class = "wi "+weather_icon_str;
    // var icon_element = "<i class="+ weather_icon_str +"></i>";
    // $('#current-weather-icon').removeClass("wi wi-alien");
    $('.current-weather-temperature').text(forecast.current.temp);
    $('.weather-description').text(forecast.current.text);
    var wind=Math.round(forecast.current.windspeed*0.44704,2);
    $('.wind').text('Wind: '+wind+' m/s');

    for (var i = 0; i < 5; i++) {
      $('.day').append('<td>'+forecast.forecast[i].day+'</td>');
      $('.date').append('<td>'+forecast.forecast[i].date.substr(0,6)+'</td>');
      $('.icon').append('<td><i class="wi forecast forecast-weather-icon-'+i+'"></i></td>>');
      $('.temp').append('<td>'+forecast.forecast[i].high+forecast.forecast[i].low+'</td>');
      $('.text').append('<td>'+forecast.forecast[i].text+'</td>');
    }
    $('#current-weather-icon').addClass(icon_class);
    for (var i = 0; i < forecast.forecast.length; i++) {
      var icon_str = 'wi '+ forecast.forecast[i].weather_icon_str;
      var class_str = '.forecast-weather-icon-'+i;
      $(class_str).addClass(icon_str);
    }
    weathercode=forecast.current.code;

  });


  //AQI
  var locationAPI='https://api.openaq.org/v1/latest?country=AU&city='+stateName+'&location='+locationName;

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


  function showLocationAqi(contentJson,location){
    var max=-1;
    var maxParameter;
    var maxParameterPeriod;
    for (var i = 0; i < contentJson.meta.found; i++) {
      $(".updateinfo-control").after("<div class='updateinfo'>"+contentJson.results[i].measurements[0].lastUpdated.substring(0,19).replace(/T/g," ")+"</div>")
      for (var j = 0; j < contentJson.results[i].measurements.length; j++){
        if(max<=aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value)){
          max=aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value);
          maxParameter = contentJson.results[i].measurements[j].parameter;
          maxParameterPeriod = contentJson.results[i].measurements[j].averagingPeriod.value
        }
      }
    }
    if (max==-1){
      maxParameter = 'no found';
      maxParameterPeriod = 'no found';
    }
    range(max);
    $(".parameter-control").after("<div class='parameter-title'>"+location.replace(/\+/g," ")+" AQI"+"</div>");
    return [maxParameter,maxParameterPeriod,max];
  }


  //background

  $('.topbackground').append("<div>"+locationName+"</div>");
  var info = showLocationAqi(contentJson,locationName);
  console.log(info[2]);
  console.log(weathercode);
  showTopPic(info[2],weathercode);


  function getStarStatus(){
    $.ajax({
      url: 'ajax_star.php',
      data: {
        location: locationName,
        userid: userid
      },
      dataType : 'json',
      success: function(status){
        $('#star').attr({src:'img/star'+status+'.png'})
      }
    });
  }

  $('#star').on('click',function(){
    $.ajax({
      url: 'ajax_updatefavorite.php',
      async : false,
      data:{
        state: stateName,
        location: locationName,
        userid: userid,
      },
      dataType:'json',
      success: function(){

      }
    });
    getStarStatus();
  });
  getStarStatus();
})

</script>
</html>
