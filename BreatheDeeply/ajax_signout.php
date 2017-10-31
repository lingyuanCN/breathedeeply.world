<?php
session_start();
$action = $_GET['action'];
if ($action == 'logout') {  //退出
  unset($_SESSION);

  session_destroy();
  echo '1';
}
?>
