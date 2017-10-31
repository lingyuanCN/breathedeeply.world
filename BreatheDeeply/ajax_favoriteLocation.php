<?php
error_reporting(E_ALL ^ E_NOTICE);

$link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
//设置字符编码
mysqli_query($link, 'set name utf8');
//选择数据库
mysqli_select_db($link, 'database') or exit ('fail to select database');


$userid = $_GET['userid'];

$list=[];

$sql = "select * from favoritelist where userid = '$userid' order by state";
// echo $sql;
$result = mysqli_query($link, $sql) or exit ('query failed');
$i=0;
while ($rows=mysqli_fetch_array($result)) {
  $list[$i]['state']=$rows['state'];
  $list[$i]['location']=$rows['favorite_location'];
  $i++;
}

echo json_encode($list);
?>
