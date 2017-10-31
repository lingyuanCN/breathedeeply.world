<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Breathe Deeply - Weather</title>

  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://cdn.bootcss.com/weather-icons/2.0.10/css/weather-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/widget.css">
</head>
<body>
  <?php
  error_reporting(E_ALL ^ E_NOTICE);

  $link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
  //设置字符编码
  mysqli_query($link, 'set name utf8');
  //选择数据库
  mysqli_select_db($link, 'database') or exit ('fail to select database');

  $header_city;

  if(isset($_POST['submit']))
  {
    $location_name=$_POST['city-name'];
    $header_city=$location_name;
    $sql = "select woeid from locationinfo where LocationName = '$location_name'";
    // echo $sql;
    $result = mysqli_query($link, $sql) or exit ('query failed');
    $rows = mysqli_num_rows($result);//返回一个数值
    if ($rows) {//0 false 1 true
      $rs = mysqli_fetch_array($result);
      $woeid = $rs['woeid'];
      // echo($woeid);
    }
    echo '<script type="text/javascript">var woeid ='.$woeid.';</script>';

    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from weather.forecast where woeid = '.$woeid.' and u="c"';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
    // echo $yql_query_url;
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    // Convert JSON to PHP object
    $phpObj =  json_decode($json,true);

    $forecast =[];

    for($i=0;$i<count($phpObj['query']['results']['channel']['item']['forecast']);$i++){
      $forecast['forecast'][$i]['code']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['code'];
      $forecast['forecast'][$i]['high']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['high'];
      $forecast['forecast'][$i]['low']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['low'];
      $forecast['forecast'][$i]['date']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['date'];
      $forecast['forecast'][$i]['day']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['day'];
      $forecast['forecast'][$i]['text']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['text'];

      $sql = "select weather_icon_str from weather_icon where weather_code =  ".$phpObj['query']['results']['channel']['item']['forecast'][$i]['code'];

      $result = mysqli_query($link, $sql) or exit ('query failed');
      $rows = mysqli_num_rows($result);//返回一个数值
      if ($rows) {//0 false 1 true
        $rs = mysqli_fetch_array($result);
        $forecast['forecast'][$i]['weather_icon_str'] = $rs['weather_icon_str'];
      }
    }
    $forecast['current']['code'] = $phpObj['query']['results']['channel']['item']['condition']['code'];
    $forecast['current']['date'] = $phpObj['query']['results']['channel']['item']['condition']['date'];
    $forecast['current']['temp'] = $phpObj['query']['results']['channel']['item']['condition']['temp'];
    $forecast['current']['text'] = $phpObj['query']['results']['channel']['item']['condition']['text'];
    $forecast['current']['windspeed'] = $phpObj['query']['results']['channel']['wind']['speed'];

    $sql = "select weather_icon_str from weather_icon where weather_code =  ".$forecast['current']['code'];

    $result = mysqli_query($link, $sql) or exit ('query failed');
    $rows = mysqli_num_rows($result);//返回一个数值
    if ($rows) {//0 false 1 true
      $rs = mysqli_fetch_array($result);
      $forecast['current']['weather_icon_str'] = $rs['weather_icon_str'];
    }
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
  <div class="container">
    <form role="form" action="weather.php" method="post">
      <div class="form-group">
        <label for="name">City</label>
        <select class="form-control" name="city-name">
          <?php
            $sql='select * from locationinfo';
            $result = mysqli_query($link, $sql) or exit ('query failed');
            $city_num = mysqli_num_rows($result);//返回一个数值
            for($i=0;$i < $city_num;$i++)
            {
              $sql='select LocationName from locationinfo where id = '.$i;
              $result = mysqli_query($link, $sql) or exit ('query failed');
              $rows = mysqli_num_rows($result);//返回一个数值
              if ($rows) //0 false 1 true
              {
                $rs = mysqli_fetch_array($result);
                $location_name = $rs['LocationName'];
              }
              echo '<option>'.$location_name.'</option>';
            }
          ?>
        </select>
      </div>
      <input type="submit" id="submit" class="btn btn-primary draw-chart" name="submit" value="submit">
    </form>
    <div id="widget">
      <div class="header"></div>
      <div class="rows">
        <div class="col-sm-3">
          <table>
            <tbody>
              <tr>
                <td>
                  <i id="current-weather-icon" class="current wi"></i>
                  <i class="current-weather-temperature"><?php echo $forecast['current']['temp']; ?></i>
                  <?php
                  if(isset($_POST['submit'])){
                    echo '<i id="current-weather-icon" class="wi wi-celsius"></i>';

                  ?>
                </td>
              </tr>
              <tr>
                <td class="weather-description">
                  <?php echo $forecast['current']['text']; ?>
                </td>
              </tr>
              <tr>
                <td class="wind">
                  <?php
                    $speed = 0.44704 * $forecast['current']['windspeed'];
                    $speed = round($speed,2);
                    if($speed){
                      echo 'Wind:&nbsp'.$speed.'&nbsp m/s';
                    }
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-9 table-responsive">
          <table class="forecast-10 table">
            <thead>
              <tr>
                <?php
                  for($i=0;$i<count($forecast['forecast']);$i++)
                  {
                    echo '<td>'.$forecast['forecast'][$i]['day'].'</td>';
                  }
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                  for($i=0;$i<count($forecast['forecast']);$i++)
                  {
                    echo '<td>'.substr ( $forecast['forecast'][$i]['date'], 0 , 6 ).'</td>';
                  }
                ?>
              </tr>
              <tr>
                <?php
                  for($i=0;$i<count($forecast['forecast']);$i++)
                  {
                    echo '<td><i class="wi forecast forecast-weather-icon-'.$i.'"></i></td>';
                  }
                ?>
              </tr>
              <tr>
                <?php
                for($i=0;$i<count($forecast['forecast']);$i++)
                {
                  echo '<td>'.$forecast['forecast'][$i]['high'].'/'.$forecast['forecast'][$i]['low'].'℃'.'</td>';
                }
                ?>
              </tr>
              <tr>
                <?php
                  for($i=0;$i<count($forecast['forecast']);$i++)
                  {
                    echo '<td>'.$forecast['forecast'][$i]['text'].'</td>';
                  }
                }
                ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- prepare a DOM container with width and height -->
    <div id="main" style="width: 100%;height:350px;"></div>


</body>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/echarts.js"></script>

<script type="text/javascript">

var url_API = "https://query.yahooapis.com/v1/public/yql?q=select+%2A+from+weather.forecast+where+woeid+%3D+"+woeid+"+and+u%3D%22c%22&format=json";

function getForecast() {
  var forecast = new Object();
  forecast.code=[];
  forecast.date=[];
  forecast.day=[];
  forecast.high=[];
  forecast.low=[];
  forecast.text=[];
  forecast.location=[];
  $.ajax({
    url: url_API,
    async : false,
    dataType : "json",
    success : function(data) {
      for (var i = 0; i < data.query.results.channel.item.forecast.length; i++) {
        forecast.code[i]=data.query.results.channel.item.forecast[i].code;
        forecast.date[i]=data.query.results.channel.item.forecast[i].date;
        forecast.day[i]=data.query.results.channel.item.forecast[i].day;
        forecast.high[i]=data.query.results.channel.item.forecast[i].high;
        forecast.low[i]=data.query.results.channel.item.forecast[i].low;
        forecast.text[i]=data.query.results.channel.item.forecast[i].text;
      }
      forecast.location=data.query.results.channel.location;
    }
  });
  return forecast;
}

var forecast = getForecast();

$('#widget .header').append('<?php echo $header_city; ?>'+', '+forecast.location.region+', '+forecast.location.country);

var weather_icon_str = "<?php echo $forecast['current']['weather_icon_str']; ?>";
console.log(weather_icon_str);
var icon_class = "wi "+weather_icon_str;
// var icon_element = "<i class="+ weather_icon_str +"></i>";
// $('#current-weather-icon').removeClass("wi wi-alien");
$('#current-weather-icon').addClass(icon_class);
<?php $json = json_encode($forecast); ?>
var arr = <?php echo $json; ?>;
for (var i = 0; i < arr.forecast.length; i++) {
  var icon_str = 'wi '+ arr.forecast[i].weather_icon_str;
  var class_str = '.forecast-weather-icon-'+i;
  $(class_str).addClass(icon_str);
}

function drawChart(){
  // based on prepared DOM, initialize echarts instance
  var myChart = echarts.init(document.getElementById('main'));

  // specify chart configuration item and data
  option = {
  title: {
      text: 'Weather forecast',
      subtext: 'Temperature in the future 10 days'
  },
  tooltip: {
    trigger: 'axis'
  },
  legend: {
    data:['High','Low']
  },
  toolbox: {
    show: false,
    feature: {
      dataZoom: {
        yAxisIndex: 'none'
      },
      dataView: {readOnly: true},
      magicType: {type: ['line', 'bar']},
      restore: {},
      saveAsImage: {}
    }
  },
  xAxis:  {
    type: 'category',
    boundaryGap: false,
    data: forecast.day
  },
  yAxis: {
    type: 'value',
    axisLabel: {
      formatter: '{value} °C'
    }
  },
  series: [
    {
      name:'High',
      type:'line',
      data:forecast.high,
      // markPoint: {
      //     data: [
      //         {type: 'max', name: 'Maximum'}
      //     ]
      // },
      markLine: {
        data: [
          {type: 'average', name: 'Average'}
        ]
      }
    },
    {
      name:'Low',
      type:'line',
      data:forecast.low,
      // markPoint: {
      //     data: [
      //         {type: 'min', name: 'Minimum'}
      //     ]
      // },
      markLine: {
        data: [
          {type: 'average', name: 'Average'},
          // [{
          //     symbol: 'none',
          //     x: '90%',
          //     yAxis: 'max'
          // }, {
          //     symbol: 'circle',
          //     label: {
          //         normal: {
          //             position: 'start',
          //             formatter: 'Min'
          //         }
          //     },
          //     type: 'max',
          //     name: 'Max'
          // }]
          ]
        }
      }
    ]
  };
  // use configuration item and data specified to show chart
  myChart.setOption(option);
}
drawChart();

</script>
</html>
