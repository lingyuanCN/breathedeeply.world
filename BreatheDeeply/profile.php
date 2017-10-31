<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Breathe Deeply - Profile</title>

  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/verification.css">

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
          <div class="profile-user-buttons">
            <!-- <button id="up-img" class="btn btn-primary btn-sm">Photo</button> -->
            <button id="edit" class="btn btn-success btn-sm">Edit profile</button>
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
        <div class="panel panel-default">
          <div class="panel-heading"><b>Personal profile</b></div>
          <div class="panel-body">
            <form id="profile-submit" method="post" class="form-horizontal" action="profile.php" hidden="hidden">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="firstname">First name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="firstname" value="<?php echo $profile['firstname'];?>" placeholder="First Name">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="lastname">Last name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="lastname" value="<?php echo $profile['lastname']; ?>" placeholder="Last Name ">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="age">Age</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="age" value="<?php echo $profile['age']; ?>" placeholder="Age">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="email">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email" value="<?php echo $profile['email']; ?>" placeholder="Email Address" disabled>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="homelocation">Home Location</label>
                <div class="col-sm-9">
                  <select class="form-control" name="homelocation">
                    <option value="<?php echo $profile['homelocation']; ?>"><?php echo $profile['homelocation']; ?></option>
                    <?php
                      $sql='select * from locationinfo';
                      $result = @mysqli_query($link, $sql) or exit ('query failed');
                      $city_num = @mysqli_num_rows($result);//返回一个数值
                      for($i=1;$i < $city_num;$i++)
                      {
                        $sql='select LocationName from locationinfo where id = '.$i;
                        $result = @mysqli_query($link, $sql) or exit ('query failed');
                        $rows = @mysqli_num_rows($result);//返回一个数值
                        if ($rows) {//0 false 1 true
                          $rs = @mysqli_fetch_array($result);
                          $cityName = $rs['LocationName'];
                        }
                        echo "<option value='$cityName'>".$cityName.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="worklocation">Work Location</label>
                <div class="col-sm-9">
                  <select class="form-control" name="worklocation">
                    <option value="<?php echo $profile['worklocation'];?>"><?php echo $profile['worklocation'];?></option>
                    <?php
                      for($i=1;$i < $city_num;$i++)
                      {
                        $sql='select LocationName from locationinfo where id = '.$i;
                        $result = @mysqli_query($link, $sql) or exit ('query failed');
                        $rows = @mysqli_num_rows($result);//返回一个数值
                        if ($rows)
                        {
                          //0 false 1 true
                          $rs = @mysqli_fetch_array($result);
                          $cityName = $rs['LocationName'];
                        }
                        echo "<option value='$cityName'>".$cityName.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="outdoortime">Outdoor Time</label>
                <div class="col-sm-9">
                  <select class="form-control" name="outdoortime">
                    <option value="<?php echo $profile['outdoortime'];?>">
                      <?php
                        switch ($profile['outdoortime'])
                        {
                          case '1':
                            echo "Less than 2 hours";
                            break;
                          case '2':
                            echo "2 ~ 6 hours";
                            break;
                          case '3':
                            echo "More than 6 hours";
                            break;
                          default:
                            # code...
                            break;
                        }
                      ?>
                    </option>
                    <option value="1">less than 2 hours</option>
                    <option value="2">2 ~ 6 hours</option>
                    <option value="3">more than 6 hours</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Disease&amp;Allergy</label>
                <div class="col-sm-9">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="disease[]" value="1">
                      Do you have cardiovascular diseases, lung disease, respiratory disease or other allergy symptoms
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" class="btn btn-primary info-submit" name="update" value="submit"></input>
                  </div>
                </div>
              </form>
              <?php
              if(isset($_POST['update']))
              {
                //获取用户输入的个人信息
                $first_name=$_POST['firstname'];
                $last_name=$_POST['lastname'];
                $email=$_SESSION["email"];
                $age=$_POST['age'];
                $homelocation=$_POST['homelocation'];
                $worklocation=$_POST['worklocation'];
                $outdoortime=$_POST['outdoortime'];
                $is_disease;
                $air_sensitive;



                if(isset($_REQUEST['disease']))
                {
                  $is_disease=1;
                  $air_sensitive=1;
                  $sql="update low_priority ignore userinfo set isdisease = '$is_disease', air_sensitive='$air_sensitive' where email='$email'";
                  @mysqli_query($link,$sql) or exit ('fail to update the data');
                }
                else
                {
                  $is_disease=0;
                  $sql="update low_priority ignore userinfo set isdisease = '$is_disease' where email='$email'";
                  @mysqli_query($link,$sql) or exit ('fail to update the data');
                }
                if($age<16||$age>60||$outdoortime==3){
                  $air_sensitive=1;
                }else {
                  $air_sensitive=0;
                }
                $sql="update low_priority ignore userinfo set firstname = '$first_name',lastname='$last_name', homelocation='$homelocation',worklocation='$worklocation',outdoortime='$outdoortime', age='$age', air_sensitive='$air_sensitive' where email='$email'";
                @mysqli_query($link,$sql) or exit ('fail to update the data');


              }
              ?>
            </div>
            <table id="profile" class="table table-hover">
              <tr>
                <td>First Name</td>
                <td><?php echo $profile['firstname']; ?></td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td><?php echo $profile['lastname']; ?></td>
              </tr>
              <tr>
                <td>Age</td>
                <td><?php echo $profile['age']; ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $profile['email'] ?></td>
              </tr>
              <tr>
                <td>Home Location</td>
                <td><?php echo $profile['homelocation'] ?></td>
              </tr>
              <tr>
                <td>Work Location</td>
                <td><?php echo $profile['worklocation'] ?></td>
              </tr>
              <tr>
                <td>Outdoor Time</td>
                <td>
                <?php
                  switch ($profile['outdoortime'])
                  {
                    case '1':
                      echo "Less than 2 hours per day";
                      break;
                    case '2':
                      echo "2 ~ 6 hours per day";
                      break;
                    case '3':
                      echo "More than 6 hours per day";
                      break;
                    default:
                      # code...
                      break;
                  }
                ?>
                </td>
              </tr>
              <tr>
                <td>Disease&amp;Allergy</td>
                <td>
                  <?php
                  if($profile['isdisease']==1)
                  {
                      echo "You have cardiovascular diseases, lung disease, respiratory disease or other allergy symptoms";
                  }
                  else if($profile['isdisease']==0)
                  {
                      echo "You do not have cardiovascular diseases, lung disease, respiratory disease or other allergy symptoms";
                  }
                  @mysqli_close($link);
                  ?>
                </td>
              </tr>
              <tr>
                <td>Sensitive Group</td>
                <td>
                  <?php
                  if($profile['air_sensitive']==1)
                  {
                      echo "Yes";
                  }
                  else if($profile['air_sensitive']==0)
                  {
                      echo "No";
                  }
                  @mysqli_close($link);
                  ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="js/main.js"></script>
<script src="js/profile-validate.js"></script>
<script type="text/javascript">
$(function(){
  $('#home').on('click',function(){
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.home,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.home;
      })
    });
  })

  $('#work').on('click',function(){
    console.log(1);
    $.post('ajax_getHome.php?userid='+'<?php echo $_SESSION['userid']; ?>',function(json){
      var list=JSON.parse(json);
      $.post('ajax_getState.php?location='+list.work,function(state){
        parent.location.href='../Capstone/favorite.php?state='+state+'&location='+list.work;
      })
    });
  })

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

  $('#edit').click(function fun(){
    $('#profile-submit').toggle();
    $('#profile').toggle();
  })
});


</script>

</html>
