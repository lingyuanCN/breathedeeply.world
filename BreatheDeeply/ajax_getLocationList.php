<?php
  $link =mysqli_connect('localhost','root','asdf1234') or exit('link failed');
  mysqli_query($link,'set name utf8');
  mysqli_select_db($link, 'database') or exit('fail to select database');
  $state=$_GET['stateName'];
  if(isset($state)){
    $sql="select LocationName from locationinfo where StateName= '$state'";
    $res=mysqli_query($link,$sql);
    while ($row=mysqli_fetch_array($res)) {
      $location[]=array("locationName"=>$row['LocationName']);
    }
    echo json_encode($location);
  }
?>
