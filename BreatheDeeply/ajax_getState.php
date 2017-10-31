<?php
// error_reporting(E_ALL ^ E_NOTICE);

$link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
//设置字符编码
mysqli_query($link, 'set name utf8');
//选择数据库
mysqli_select_db($link, 'database') or exit ('fail to select database');


$location=$_GET['location'];


$sql = "select * from locationinfo where LocationName = '$location'";
// echo $sql;
$result = mysqli_query($link, $sql) or exit ('query failed');
$rows = mysqli_num_rows($result);//返回一个数值
if ($rows) {//0 false 1 true
  $rs = mysqli_fetch_array($result);
  $state=$rs['StateName'];
}
echo $state;
?>
