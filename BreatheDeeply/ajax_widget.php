<?php
error_reporting(E_ALL ^ E_NOTICE);

$link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
//设置字符编码
mysqli_query($link, 'set name utf8');
//选择数据库
mysqli_select_db($link, 'database') or exit ('fail to select database');

$header_city;

$action = $_GET['action'];


$location_name=$_GET['location'];
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
$forecast['woeid']=$woeid;
$forecast['city']=$header_city;
$forecast['location']=$phpObj['query']['results']['channel']['location'];


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

echo json_encode($forecast);

?>
