<?php
require_once'db.php';
include("./auth.php");
$ReqCnt=0;
$InsCnt=0;
$DrvPep=0;
$PssRep=0;
$Count=0;

$sq1 = "SELECT * from `driver` WHERE active=0b0";
$re1 = $con->query($sq1);
$ReqCnt=$re1->num_rows;

$sq2 = "SELECT * from `driver` WHERE onofflag=0b1";
$re2 = $con->query($sq2);
$InsCnt=$re2->num_rows;

$sq3 = "SELECT * from `feedback` WHERE report='1'";
$re3 = $con->query($sq3);
$DrvPep=$re3->num_rows;

$sq4 = "SELECT * from `passenger` WHERE report='1'";
$re4 = $con->query($sq4);
$PssRep=$re4->num_rows;

$Count=$ReqCnt+$InsCnt+$DrvPep+$PssRep;

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
      Otobüs| Dashboard
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
    <style>
        .notification {
            color: white;
            text-decoration: none;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }
        .notification .badge {
            position: absolute;
            border-radius: 50%;
            background: red;
            color: white;
        }
    </style>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="yellow" style="overflow-x: hidden">
       <div class="sidebar-wrapper" id="sidebar-wrapper"><!--style="background-color: #1ABC9C"-->
          <div>
              <!--<img src="../images/icon2.png" style="width:70px;height:70px;">-->
              <h3 style="color: aliceblue;margin-left: 25px;margin-top: 20px;">Otobüs Admin</h3>
          </div>
        <ul class="nav">

          <li class="active ">
            <a href="dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
            <li>
                <a href="passengers.php">
                    <i class="glyphicon glyphicon-user"></i>
                    <p>Otobüs Passengers</p>
                </a>
            </li>
          <li>
                <a href="drivers.php">
                    <i class="fas fa-bus"></i>
                    <p>Otobüs Drivers</p>
                </a>
          </li>
          <li>
                <a href="requests.php">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Drivers Requests</p>
                </a>
          </li>
          <li>
                <a href="feedback.php">
                        <i class="fas fa-exclamation-circle"></i>
                        <p> Reports </p>
                </a>
          </li>

          <li>
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
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <!--###############################################################################-->
                <div class="dropdown" >
                    <a class="notification" href='#' id="view-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="badge" id="notification-badge"><?php if($Count>0) echo $Count;else echo "";?></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="requests.php" style="font-size: 15px">New Drivers: <b style="color: red"><?php echo $ReqCnt;?></b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="requests.php" style="font-size: 15px">New insurance requests: <b style="color: red"><?php echo $InsCnt;?></b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="feedback.php" style="font-size: 15px">Reported Drivers: <b style="color: red"><?php echo $DrvPep;?></b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="feedback.php" style="font-size: 15px">Reported Passengers: <b style="color: red"><?php echo $PssRep;?></b></a>
                        <div class="dropdown-divider"></div>

                    </div>
                </div>
                <script>
                    $('#view-notification').click(function () {
                        $('#notification-badge').hide();
                    });
                </script>

                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <!--###############################################################################-->
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
      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      <div class="content">
        <div class="row">

          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Requests</h5>
                <h4 class="card-title">Driver Requests</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Booking</h5>
                <h4 class="card-title">Passengers Booking</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Rating</h5>
                <h4 class="card-title">Drivers Rating</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="barChartSimpleGradientsNumbers"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                </div>
              </div>
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
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>