<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Breathe Deeply - Login</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/verification.css">
  <style type="text/css">
    html,
    body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      background: url("../Capstone/picture/kalen-emsley-100238.jpg") no-repeat 50% 50%;
      top: 0;
      background-size: cover;
    }

    .navbar .navbar-pills {
      background: transparent;
      border: none;
    }
  </style>
</head>
<?php
  session_start();
?>
<body>
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
        <li id="yo"><a href="./login.php">Login</a></li>
        <li id="hi"><a href="./register.php">Sign up</a></li>
        <li id="dropdown" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
              if($_SESSION)
              {
                echo $_SESSION["username"];
                echo "<script type='text/javascript'>var islogin = true;</script>";
              }
              else
              {
                echo 'User';
                echo "<script type='text/javascript'>var islogin = false;</script>";
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

  <div id="login" class="form container container-small">
    <h1>Login</h1>
    <form id="login-form" class="form-horizontal" action="login.php" method="post">
      <div class="form-group">
        <input id="email" class="form-control required" type="text" name="email" value="" placeholder="Email">
      </div>
      <div class="form-group">
        <input id="password" class="form-control" type="password" name="password" value="" placeholder="Password">
      </div>
      <input class="btn btn-primary" type="submit" name="login" value="Login">
    </form>
  </div>

  <?php
    if (isset($_POST['login'])) {
      //获取input中用户输入的值
      $email=$_POST['email'];
      $password=$_POST['password'];
      //表单判断
      //..

      $link = mysqli_connect('localhost', 'root', 'asdf1234') or exit ('link failed');//连接数据库
      mysqli_query($link, 'set name utf8');//设置字符编码
      mysqli_select_db($link, 'database') or exit ('fail to select database');//选择数据库
      $sql="select password from user where email = $email";//定义query命令
      //插入注册用户信息
      if ($email && $password) {//如果用户名和密码都不为空
        $sql = "select * from userinfo where email = '$email' and password='$password'";//检测数据库是否有对应的username和password的sql
        $result = mysqli_query($link, $sql);//执行sql
        $rows = mysqli_num_rows($result);//返回一个数值
        if ($rows) {//0 false 1 true
          // echo "success";
          $rs = mysqli_fetch_array($result);
          //set cookie
          $expire=time()+60*60;
          $_SESSION['username']=$rs['username'];
          $_SESSION['userid']=$rs['userid'];
          $_SESSION['email']=$rs['email'];
          setcookie("userid", "$rs[userid]", $expire);
          setcookie("username", "$rs[username]", $expire);
          setcookie("email", "$rs[email]", $expire);

          header("Location: ./products.php");//重定向浏览器
          exit;//确保重定向后，后续代码不会被执行
        }
        else {
          echo '<script>alert("Login failed, please check your username and password.")</script>';
          exit;
        }
      }
      else {//如果用户名或密码有空
        echo '<script>alert("Please enter your email and password to login.")</script>';
      }
      mysqli_close($link);//关闭连接
    }
  ?>


</body>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/login-validate.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript">
$(function(){
  if(islogin){
    $('#yo').hide();
    $('#hi').hide();
    $('#dropdown').show();
  }
  else {
    $('#yo').show();
    $('#hi').show();
    $('#dropdown').hide();
  }
})
</script>

</html>
