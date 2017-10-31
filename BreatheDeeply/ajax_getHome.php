<?php
  $link =mysqli_connect('localhost','root','asdf1234') or exit('link failed');
  mysqli_query($link,'set name utf8');
  mysqli_select_db($link, 'database') or exit('fail to select database');
  $userid=$_GET['userid'];
  $list=[];

  $sql="select * from userinfo where userid= '$userid'";
  $result=mysqli_query($link,$sql);
  $rows = mysqli_num_rows($result);//返回一个数值
  if ($rows) {//0 false 1 true
    $rs = mysqli_fetch_array($result);
    $list['home']=$rs['homelocation'];
    $list['work']=$rs['worklocation'];
  }

  echo json_encode($list);
?>
