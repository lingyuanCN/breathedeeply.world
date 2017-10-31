<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Breathe Deeply - Products</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/products.css">
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
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

  <div class="container clearf">
    <div class="rows">
      <div class="function-group">
        <div class="title">Main Functions</div>
        <div class="content clearf">

          <div class="col-sm-4 item">
            <div class="card">
              <a href="map.php" class="function-name">
                <i class="glyphicon glyphicon-globe"></i>
                Air Quality Map
              </a>
            </div>
          </div>
          <div class="col-sm-4 item">
            <div class="card">
              <a href="recommendation.php" class="function-name">
                <i class="glyphicon glyphicon-thumbs-up"></i>
                Recommendations
                <br>
                <i class="glyphicon glyphicon-alert"></i>
                Warnings
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>

</body>
<footer class="footer">
  <div class="container">
    <div class="row">
      <div style="display:inline;height:75px;display:float-left;" class="">
        <img style="box-shadow:5px 2px 6px #white; height: 50px;" src="img/logo.png">
      </div>
      <div style="display:inline;color:#eeeeee;display:float-left;" class="">
        <h6>Capstone Project</h6>
        <h6>Copyright@ Group39 2017</h6>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript">
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
</script>
</html>
