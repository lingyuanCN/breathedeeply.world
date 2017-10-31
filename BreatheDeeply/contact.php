<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Breathe Deeply - Contact us</title>
  <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
  <link href="https://cdn.bootcss.com/weather-icons/2.0.10/css/weather-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/airquality.css">
  <link rel="stylesheet" href="css/favorite.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/widget.css">
  <link rel="stylesheet" href="css/main.css">

</head>
<?php
  session_start();
?>
<body>
  <?php
  if(!isset($_SESSION['username']))
  {
    echo "<script> alert('Please login first.');parent.location.href='../Capstone/login.php'; </script>";
    exit();
  }
  else {
    $user=$_SESSION["userid"];
    $link =mysqli_connect('localhost','root','asdf1234') or exit('link failed');
    mysqli_query($link,'set name utf8');
    mysqli_select_db($link, 'database') or exit('fail to select database');
    $sql="select * from userinfo where userid ='$user'";
    $result=mysqli_query($link,$sql);
    $profile=mysqli_fetch_array($result);
  }
  ?>


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

  <div id="a-container" class="container">
    <div class="row profile">
      <div class="col-sm-3">
        <div class="profile-sidebar">
          <div class="profile-user-title">
            <div class="profile-user-name">
              <?php
              if($profile['firstname']||$profile['lastname'])
              {
                echo $profile['firstname'].'&nbsp;'.$profile['lastname'];
              }
              else
              {
                echo $profile['username'];
              }
              ?>
            </div>
            <div class="profile-user-job">
              <?php echo $profile['email']; ?>
            </div>
          </div>
          <div class="profile-user-menu">
            <ul class="nav">
              <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
              <li><a id="home" href="#"><i class="glyphicon glyphicon-home"></i>My Home</a></li>
              <li><a id="work" href="#"><i class="glyphicon glyphicon-map-marker"></i>Work Location</a></li>
              <li><a href="favoritelist.php"><i class="glyphicon glyphicon-heart"></i>Favourite</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-sm-9">
        <h1>Contact us</h1>
        <p class="text">Please contact us if you have any suggestions or feedback.</p>
        <p class="text"><b>Lance</p></b><a herf="mailto:y3.ling@connect.qut.edu.au">y3.ling@connect.qut.edu.au</a>
        <p class="text"><b>Paul</p></b><a herf="mailto:y51.lin@connect.qut.edu.au">y51.lin@connect.qut.edu.au</a>
        <p class="text"><b>Steve</p></b><a herf="mailto:shuohang.hu@connect.qut.edu.au">shuohang.hu@connect.qut.edu.au</a>
        <p class="text"><b>Kevin</p></b><a herf="mailto:suwan.zhu@connect.qut.edu.au">suwan.zhu@connect.qut.edu.au</a>


      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
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
</body>


<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
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
  $('#home').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.home,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.home;
      })
    });
  })

  $('#work').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.work,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.work;
      })
    });
  })


</script>
</body>
</html>
