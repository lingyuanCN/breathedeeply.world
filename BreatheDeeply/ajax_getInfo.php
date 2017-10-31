<?php
error_reporting(E_ALL ^ E_NOTICE);

$link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
//设置字符编码
mysqli_query($link, 'set name utf8');
//选择数据库
mysqli_select_db($link, 'database') or exit ('fail to select database');


$state = $_GET['state'];
$location = $_GET['location'];


$sql = "select woeid from locationinfo where LocationName = '$location'";
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

$info =[];

// for($i=0;$i<count($phpObj['query']['results']['channel']['item']['forecast']);$i++){
//     $info['forecast'][$i]['code']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['code'];
//     $info['forecast'][$i]['high']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['high'];
//     $info['forecast'][$i]['low']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['low'];
//     $info['forecast'][$i]['date']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['date'];
//     $info['forecast'][$i]['day']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['day'];
//     $info['forecast'][$i]['text']=$phpObj['query']['results']['channel']['item']['forecast'][$i]['text'];
//
//     $sql = "select weather_icon_str from weather_icon where weather_code =  ".$phpObj['query']['results']['channel']['item']['forecast'][$i]['code'];
//
//     $result = mysqli_query($link, $sql) or exit ('query failed');
//     $rows = mysqli_num_rows($result);//返回一个数值
//     if ($rows) {//0 false 1 true
//         $rs = mysqli_fetch_array($result);
//         $info['forecast'][$i]['weather_icon_str'] = $rs['weather_icon_str'];
//     }
// }
$info['code'] = $phpObj['query']['results']['channel']['item']['condition']['code'];
$info['date'] = $phpObj['query']['results']['channel']['item']['condition']['date'];
$info['temp'] = $phpObj['query']['results']['channel']['item']['condition']['temp'];
$info['text'] = $phpObj['query']['results']['channel']['item']['condition']['text'];
$info['windspeed'] = $phpObj['query']['results']['channel']['wind']['speed'];

$sql = "select weather_icon_str from weather_icon where weather_code =  ".$info['code'];

$result = mysqli_query($link, $sql) or exit ('query failed');
$rows = mysqli_num_rows($result);//返回一个数值
if ($rows) {//0 false 1 true
    $rs = mysqli_fetch_array($result);
    $info['weather_icon_str'] = $rs['weather_icon_str'];
}

echo json_encode($info);
?>
