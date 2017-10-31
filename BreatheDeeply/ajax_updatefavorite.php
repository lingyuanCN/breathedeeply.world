<?php
error_reporting(E_ALL ^ E_NOTICE);

$link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
//设置字符编码
mysqli_query($link, 'set name utf8');
//选择数据库
mysqli_select_db($link, 'database') or exit ('fail to select database');

$state = $_GET['state'];
$location = $_GET['location'];
$userid = $_GET['userid'];

$sql = "select * from favoritelist where userid = '$userid' and favorite_location = '$location'";
// echo $sql;
$result = mysqli_query($link, $sql) or exit ('query failed');
$rows = mysqli_num_rows($result);//返回一个数值
if ($rows) {//0 false 1 true
  $sql="delete from favoritelist where userid = '$userid' and favorite_location = '$location'";
  @mysqli_query($link,$sql) or exit ('fail to update the data');
  echo 'delete success';
}
else {
  $sql="insert into favoritelist (userid, favorite_location, state) values ('$userid', '$location', '$state')";
  @mysqli_query($link,$sql) or exit ('fail to update the data');
  echo 'add success';
}
?>
