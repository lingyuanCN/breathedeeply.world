<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Breathe Deeply - Air quality map</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link href="https://cdn.bootcss.com/weather-icons/2.0.10/css/weather-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/map.css">
  <link rel="stylesheet" href="css/widget.css">

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

        <div id="map"></div>

        <table class="gridtable" width="100%" style="margin-bottom:10px; color: #333333">
          <tbody>
            <tr style="font-weight:bold; background: #e1ebf4">
              <th>Air Quality Index Levels of Health Concern</th>
              <th>Numerical Value</th>
              <th>Meaning</th>
            </tr>

            <tr style="background: #00e400">
              <td>Good</td>
              <td>0 to 50</td>
              <td style="text-align:left">Air quality is considered satisfactory, and air pollution poses little or no risk.</td>
            </tr>

            <tr style="background: #ffff00">
              <td>Moderate</td>
              <td>51 to 100</td>
              <td style="text-align:left">Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution.</td>
            </tr>

            <tr style="background: #ff7e00">
              <td>Unhealthy for Sensitive Groups</td>
              <td>101 to 150</td>
              <td style="text-align:left">Members of sensitive groups may experience health effects. The general public is not likely to be affected. </td>
            </tr>

            <tr style="background: #ff0000; color: #ffffff">
              <td>Unhealthy</td>
              <td>151 to 200</td>
              <td style="text-align:left">Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects.</td>
            </tr>

            <tr style="background: rgb(143, 63, 151); color: #ffffff">
              <td>Very Unhealthy</td>
              <td>201 to 300</td>
              <td style="text-align:left">Health alert: everyone may experience more serious health effects.</td>
            </tr>

            <tr style="background: #7e0023; color: #ffffff">
              <td height="43">Hazardous</td>
              <td>301 to 500</td>
              <td style="text-align:left">Health warnings of emergency conditions. The entire population is more likely to be affected.</td>
            </tr>

            <tr>
              <td colspan="3">
                <p align="left" style="font-size:9px"><em>Note: Values above 500 are considered Beyond the AQI. Follow recommendations for the "Hazardous category." Additional information on reducing exposure to extremely high levels of particle pollution is available <a href="index.cfm?action=aqibasics.pmhilevels">here</a>.</em></p>
              </td>
            </tr>
          </tbody>
        </table>




        <div class="listButton">
          <form action="airquality" method="post" target="nm_iframe">
          <select name="statelist" class="combobox" id="statelist">
            <?php
              $sql="select StateName from locationinfo group by StateName";
              $result=mysqli_query($link,$sql);
              $count=0;
              while ($stateRow=mysqli_fetch_array($result)) {
                $count++;
                echo '<option value="'.$stateRow['StateName'].'">'.$stateRow['StateName'].'</option>';
              }
            ?>
          </select>
          <select name="locationlist" class="combobox" id="locationlist"></select>
          </form>
            <iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>
        </div>

        <div class="panel panel-default panel-city">
          <div class="panel-heading">
            <div id="starContainer" class="panel-title">
              Air Quality Parameters
              <img id="star" src="" align="right">
              <div class="small">latest air quality details</div>
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

        <div class="panel panel-default panel-city">
          <div class="panel-heading">
            <div class="panel-title">
              AQI Trend
              <div class="small">AQI trend in past 24 hours</div>
            </div>
          </div>
          <div class="panel-body">
            <table class="table-responsive" width=100%>
              <tbody>
                <tr class="chart-info">
                  Past 24 hours data
                </tr>
                <tr>
                  <td style="padding-right: 5px">
                    <span class='parameterName-control'>
                    </span>
                    <td style="width:85%">
                      <div>
                        <span id="barChartParent">
                          <canvas id="aqiTrend"></canvas>
                        </span>
                      </div>
                    </td>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- <div class="panel panel-default panel-city">
          <div class="panel-heading">
            <div class="panel-title">
              Air Quality Trend
              <div class="small">air quality trend in past 48 hours</div>
            </div>
          </div>
          <div class="panel-body">
            <table>
              <tbody>
                <tr class="chart-info">
                  Past 48 hours data
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>PM2.5:</div>
                  </td>
                  <td style="width:85%">
                    <div id="pm25Parent">
                      <canvas id="pm25"></canvas>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>PM10:</div>
                  </td>
                  <td style="width:85%">
                    <div id="pm10Parent">
                      <canvas id="pm10"></canvas>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>NO2:</div>
                  </td>
                  <td style="width:85%">
                    <div id="no2Parent">
                      <canvas id="no2"></canvas>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>SO2:</div>
                  </td>
                  <td style="width:85%">
                    <div id="so2Parent">
                      <canvas id="so2"></canvas>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>CO:</div>
                  </td>
                  <td style="width:85%">
                    <div id="coParent">
                      <canvas id="co"></canvas>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-right: 5px" >
                    <div>O3:</div>
                  </td>
                  <td style="width:85%">
                    <div id="o3Parent">
                      <canvas id="o3"></canvas>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div> -->

        <div class="panel panel-default panel-state">
          <div class="panel-heading">
            <div class="panel-title">
              Location List
              <div class="small">AQI for each location in this state</div>
            </div>
          </div>
          <div class="panel-body">
            <table id="location-list" class="table">
            </table>
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


<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0lZZTp7lZs_lI7UbvFgUqYXgt1s_p3-Q&callback=initMap">
</script>
<script src="js/main.js"></script>
<script src="js/aqi.js"></script>
<script src="js/aqiRange.js"></script>
<script src="js/chartEncapsulation.js"></script>
<script src="js/Chart.js" charset="utf-8"></script>
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

  $.ajaxSetup({
    async : false
  });

  $(".panel-city").hide();
  $(".panel-state").show();
  $("#widget").hide();
  showLocationList();
  getLocationList();
  showState();

  $("#statelist").change(function(){
    $('#location-list tr').remove();
    $(".panel-city").hide();
    $("#widget").hide();
    $(".panel-state").show();
    showLocationList();
    showState();
    getLocationList();
  });

  $("#locationlist").change(function(){
    $(".panel-city").show();
    $(".panel-state").hide();
    $("#widget").show();
    showLocation();
    getStarStatus();
    showWidget();
  });

  function getLocationList(){
    $.getJSON("ajax_getLocationList.php",{stateName:$("#statelist").val()},function(json){
      var locationName=$("#locationlist");
      $("option",locationName).remove();
      locationName.append("<option value=''>"+$("#statelist").val()+" Overview</option>");
      $.each(json,function(index,array){
        var option="<option value='"+array['locationName']+"'>"+array['locationName']+"</option>";
        locationName.append(option);
      })
    })
  }

  var userid = '<?php echo $_SESSION['userid']; ?>';

  function getStarStatus(){
    $.ajax({
      url: 'ajax_star.php',
      data: {
        location: $('#locationlist').val(),
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
        state: $("#statelist").val(),
        location: $('#locationlist').val(),
        userid: userid,
      },
      dataType:'json',
      success: function(){

      }
    });
    getStarStatus();
  });

  function showWidget(){
    $.post("ajax_widget.php?location="+$('#locationlist').val(),function(json){
      var forecast = JSON.parse(json);
      $('#widget .header').empty();
      $('#widget .header').append(forecast.city+', '+forecast.location.region+', '+forecast.location.country);
      var weather_icon_str = forecast.current.weather_icon_str;
      var icon_class = "wi "+weather_icon_str;
      // var icon_element = "<i class="+ weather_icon_str +"></i>";
      // $('#current-weather-icon').removeClass("wi wi-alien");
      $('.current-weather-temperature').text(forecast.current.temp);
      $('.weather-description').text(forecast.current.text);
      var wind=Math.round(forecast.current.windspeed*0.44704,2);
      $('.wind').text('Wind: '+wind+' m/s');

      $('.day').empty();
      $('.date').empty();
      $('.icon').empty();
      $('.temp').empty();
      $('.text').empty();
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
  }

});

function initMap() {
  // Map options
  var options = {
    zoom: 13,
    center: {
      lat: -27.4698,
      lng: 153.0251
    }
  }

  // New map
  var map = new google.maps.Map(document.getElementById('map'), options);



  var latestAPI = 'https://api.openaq.org/v1/latest?country=AU&coordinates=latitude%2Clongitude&has_geo=true';


  //同步
  var contentJson;

  function getjson() {
    $.ajax({
      url: latestAPI,
      async: false,
      dataType: 'json',
      success: function(data) {
        result = data;
      }
    });
    return result;
  }

  contentJson = getjson();



  // Loop through markers
  for (var i = 0; i < contentJson.results.length; i++) {
    if (getAqi(contentJson) > 0&&contentJson.results[i].location!='Deception Bay') {
      addMarker(contentJson); // Add marker
    }
    // addMarker(contentJson);
  }


  function getAqi(props) {
    var index = -1;
    for (var j = 0; j < props.results[i].measurements.length; j++) {
      if (index < aqi(props.results[i].measurements[j].parameter, props.results[i].measurements[j].value, props.results[i].measurements[j].averagingPeriod.value)) {
        index = aqi(props.results[i].measurements[j].parameter, props.results[i].measurements[j].value, props.results[i].measurements[j].averagingPeriod.value);
      }
    }
    return index;
  }



  // Add Marker Function
  function addMarker(props) {
    var labelValue = getAqi(props);
    var iconStr;
    var location=props.results[i].location;
    if (labelValue <= 50) {
      iconStr = './icon/iconMarker50.png';
    } else if (labelValue <= 100) {
      iconStr = './icon/iconMarker100.png';
    } else if (labelValue <= 150) {
      iconStr = './icon/iconMarker150.png';
    } else if (labelValue <= 200) {
      iconStr = './icon/iconMarker200.png';
    } else if (labelValue <= 300) {
      iconStr = './icon/iconMarker300.png';
    } else {
      iconStr = './icon/iconMarker500.png';
    }

    var marker = new google.maps.Marker({
      position: {
        lat: props.results[i].coordinates.latitude,
        lng: props.results[i].coordinates.longitude
      },
      map: map,
      icon: iconStr,
      label: '' + labelValue
    });

    var infoWindow = new google.maps.InfoWindow({
      content: location
    });

    marker.addListener('mouseover', function() {
      infoWindow.open(map, marker);
    });

    marker.addListener('mouseout', function() {
      infoWindow.close(map, marker);
    });

    marker.addListener('click',function(){
      $.post("ajax_getState.php?location="+location,function(state){
        if(state!=""&&state!=null){
          parent.location.href='../Capstone/favorite.php?state='+state+'&location='+location;

        }
      });

    })


  }
}
</script>
</html>
