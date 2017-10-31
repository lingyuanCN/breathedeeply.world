<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Breathe Deeply - Register</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/verification.css">
    <style type="text/css">
      html,
      body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        background: url("./picture/kalen-emsley-100238.jpg") no-repeat 50% 50%;
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
  <div id="register" class="form container container-small">
    <h1>Sign up</h1>
    <form id="register-form" class="form-horizontal" action="register.php" method="post">
      <div class="form-group">
        <input id="username" class="form-control required" type="text" name="username" value="" placeholder="Username">
      </div>
      <div class="form-group">
        <input id="email" class="form-control" type="text" name="email" value="" placeholder="Email">
      </div>
      <div class="form-group">
        <input id="password" class="form-control" type="password" name="password" value="" placeholder="Password">
      </div>
      <div class="form-group">
        <input id="confirm_password" class="form-control" type="password" name="confirm_password" value="" placeholder="Confirm Password">
      </div>
      <input class="btn btn-primary" type="submit" name="signup" value="Sign up">
    </form>
  </div>

  <?php
  if(isset($_POST['signup']))
  {
    //获取input中用户输入的值
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    //表单判断


    //连接数据库
    $link = mysqli_connect('localhost','root','asdf1234') or exit ('link failed');
    //设置字符编码
    mysqli_query($link, 'set name utf8');
    //选择数据库
    mysqli_select_db($link, 'database') or exit ('fail to select database');
    //定义query命令
    $sql="insert into userinfo (userid,email,username,password) values (null,'$email','$username','$password')";
    //插入注册用户信息
    if(mysqli_query($link, $sql)){
      echo '<script>alert("Register success.");</script>';
      header("Location: ./login.php");
    }else {
      echo '<script>alert("Register failed, please check your input.");</script>';
    }



  }
  ?>

</body>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/signup-validate.js"></script>
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
