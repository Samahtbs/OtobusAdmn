<?php
include("./auth.php");
require('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../images/icon2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Admin info
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="user-profile">
<div class="wrapper ">
    <div class="sidebar" data-color="yellow" style="overflow-x: hidden">
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <div>
                <!--<img src="../images/icon2.png" style="width:70px;height:70px;">-->
                <h3 style="color: aliceblue;margin-left: 25px;margin-top: 20px;">Otobüs Admin</h3>
            </div>
            <ul class="nav">

                <li>
                    <a href="dashboard.php">
                        <i class="now-ui-icons design_app"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li>
                    <a href="drivers.php">
                        <i class="fas fa-bus"></i>
                        <p>Otobus Drivers</p>
                    </a>
                </li>

                <li class="active ">
                    <a href="admin.php">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Admins Information</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute" >
            <div class="container-fluid" >
                <div class="navbar-wrapper"">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">ADMINS INFORMATION</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <i class="now-ui-icons users_single-02" "></i>
                            <p>
                                &nbsp;<?php echo $_SESSION['adname']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>

                        </li>
                        <li>
                            <a href="./logout.php">
                                <span class="glyphicon" >&#xe163;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
      <div class="panel-header panel-header-sm" style="background-color:#FFB236">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Add A New Admin</h5>
              </div>
              <div class="card-body">
                  <?php
                  if (isset($_REQUEST['aemail'])&&isset($_REQUEST['aname'])&&isset($_REQUEST['apass'])){
                      $adminame = stripslashes($_REQUEST['aname']);
                      $adminame = mysqli_real_escape_string($con,$adminame);
                      $email = stripslashes($_REQUEST['aemail']);
                      $email = mysqli_real_escape_string($con,$email);
                      $password = stripslashes($_REQUEST['apass']);
                      $password = mysqli_real_escape_string($con,$password);
                      $trn_date = date("Y-m-d H:i:s");
                      $qu = "SELECT * FROM `admin` WHERE email='$email'";
                      $res = mysqli_query($con,$qu) or die(mysql_error());
                      $ro = mysqli_num_rows($res);
                      if($ro==1){
                          echo "<div class='form'>
                          <h3>Admin Email is already exist.</h3>
                          <br/>Click here to <a href='admin.php'>Try Again</a></div>";
                      }else{
                          $query = "INSERT into `admin` (adname, email, password)VALUES ('$adminame', '$email', '".md5($password)."')";
                          $result = mysqli_query($con,$query);
                          if($result){
                              echo "<div class='form'>
                          <h3>Admin registered successfully.</h3>
                          <br/>Click here to <a href='login.php'>Login</a> or <a href='admin.php'>Add another admin</a></div>";
                          }
                      }
                  }else{
                  ?>
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Admin Name</label>
                            <input type="text" name="aname" class="form-control" placeholder="Name" style="width: 300px">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" name="aemail" class="form-control" placeholder="Email"style="width: 300px">
                      </div>
                    </div>
                  </div>
                  <div class="row-cols-md-4 px-1">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="apass" class="form-control" placeholder="Password" style="width: 300px">
                        </div>
                  </div>
                  <div class="form-group">
                        <button name="submit" type="submit" value="Login" class="form-control btn btn-primary submit px-3" style="background-color:#FFB236">Register</button>
                  </div>
                </form>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Edit Your Info</h5>
                            </div>
                            <div class="card-body" >
                                <?php
                                $prevemail=$_SESSION['ademail'];
                                if (isset($_REQUEST['name'])||isset($_REQUEST['email'])||isset($_REQUEST['pass'])){
                                    $adminame = stripslashes($_REQUEST['name']);
                                    $adminame = mysqli_real_escape_string($con,$adminame);
                                    $email = stripslashes($_REQUEST['email']);
                                    $email = mysqli_real_escape_string($con,$email);
                                    $password = stripslashes($_REQUEST['pass']);
                                    $password = mysqli_real_escape_string($con,$password);
                                    $query = "UPDATE `admin` SET adname ='$adminame', email = '$email', password ='".md5($password)."'WHERE email = '$prevemail'";//
                                    $result = mysqli_query($con,$query);
                                    if($result){
                                        echo "<div class='form'>
                                              <h3>Your information update successfully</h3>
                                              <br/>Click<a href='login.php'>Login</a> to complete operation</div>";
                                    }
                                }else{
                                ?>
                                <form>
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                <input type="text" name="name" value="<?php echo $_SESSION['adname']; ?>" class="form-control"  style="width: 250px">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="email" value="<?php echo $_SESSION['ademail']; ?>" class="form-control" style="width: 250px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-cols-md-4 px-1">
                                        <div class="form-group">
                                            <input type="password" name="pass" value="<?php echo $_SESSION['adpass']; ?>" class="form-control" style="width: 250px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button name="submit" type="submit" class="form-control btn btn-primary submit px-3" style="background-color:#FFB236">Submit</button>
                                    </div>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
          </div>
  </div>
 </div>
</div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
</body>

</html>