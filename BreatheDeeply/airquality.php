<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Breathe Deeply - Air quality</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/profile.css">
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
        <li><a href="#">Contact us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./login.php">Login</a></li>
        <li><a href="./register.php">Sign up</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php
            if($_SESSION)
            {
              echo $_SESSION["username"];
            }
            else
            {
              echo 'User';
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
          <div class="profile-user-buttons">
            <!-- <button id="up-img" class="btn btn-primary btn-sm">Photo</button> -->
            <button id="edit" class="btn btn-success btn-sm">Edit profile</button>
          </div>
          <div class="profile-user-menu">
            <ul class="nav">
              <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
              <li class="active"><a href="#"><i class="glyphicon glyphicon-home"></i>My Home</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-map-marker"></i>worklocation</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-heart"></i>Favourite</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9">
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
              Air Quality Analysis
              <div class="small">analyze air quality parameters for warning</div>
            </div>
          </div>
          <div class="panel-body" id="parameter"></div>
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

        <div class="panel panel-default panel-city">
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
        </div>

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


      </div>
    </div>
  </div>

<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main"></script>
<script src="js/aqi.js"></script>
<script src="js/aqiRange.js"></script>
<script src="js/chartEncapsulation.js"></script>
<script src="js/Chart.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
  $.ajaxSetup({
    async : false
  });

  $(".panel-city").hide();
  $(".panel-state").show();
  showLocationList();
  getLocationList();
  showState();

  $("#statelist").change(function(){
    $('#location-list tr').remove();
    $(".panel-city").hide();
    $(".panel-state").show();
    showLocationList();
    showState();
    getLocationList();
  });

  $("#locationlist").change(function(){
    $(".panel-city").show();
    $(".panel-state").hide();
    showLocation();
    getStarStatus();
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
});


</script>
</body>
</html>
