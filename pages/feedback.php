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


// Code for record deletion
if(isset($_REQUEST['del'])) {
    $feedbackid = intval($_GET['del']);
    $sql = "SELECT * from `feedback` WHERE id='$feedbackid'";
    $ress = $con->query($sql);
    $row = mysqli_fetch_assoc($ress);
    $driverphone = $row['driverid'];
    $query = "SELECT * from `driver` WHERE phonenum ='$driverphone'";
    $res = $con->query($query);
    $ro = mysqli_fetch_assoc($res);
    $drivername = $ro['name'];
    $driveremail = $ro['email'];

    $to_email = $driveremail;
    $subject = "حذف من أوتوباس";
    $body="بناءاً على عدد البلاغات الكبير التي وصلت عنك , تم حذفك من تطبيق أوتوباس , يُرجى تفهم الموقف..";
    $headers = "From: otobus@gmail.com";
    mail($to_email, $subject, $body, $headers)&&$result;

    $query = "DELETE FROM `driver` WHERE email = '$driveremail'";
    $result = mysqli_query($con,$query);



}
if(isset($_REQUEST['idd'])){
    $feedbackid = intval($_GET['idd']);

    $sql = "SELECT * from `feedback` WHERE id='$feedbackid'";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    $driverphone = $row['driverid'];
    $query = "SELECT * from `driver` WHERE phonenum ='$driverphone'";
    $res = $con->query($query);
    $ro = mysqli_fetch_assoc($res);
    $drivername = $ro['name'];
    $driveremail = $ro['email'];
    $reportcount = $ro['repcnt'] + 1;
    $qqq = "UPDATE `driver` SET repcnt ='$reportcount' WHERE email = '$driveremail'";
    $ress = $con->query($qqq);

    $to_email = $driveremail;
    $subject = "وصلك إبلاغ جديد";
    $body=" يُرجى الانتباه أنه تم الإبلاغ عنك للمرة $reportcount 
      واذا وصل عدد البلاغات لأكثر من 20 بلاغ سيتم حذفك من التطبيق ";
    $headers = "From: otobus@gmail.com";
    mail($to_email, $subject, $body, $headers)&&$result;

    $qqq = "UPDATE `feedback` SET report ='0' WHERE id = '$feedbackid'";
    $ress = $con->query($qqq);

    echo "<script>alert('Driver is still exsist and work');</script>";
    echo "<script>window.location.href='feedback.php'</script>";
}
if(isset($_REQUEST['dont'])){
    $feedbackid = intval($_GET['dont']);
    $qqq = "UPDATE `feedback` SET report ='0' WHERE id = '$feedbackid'";
    $ress = $con->query($qqq);
}

if(isset($_REQUEST['pdel'])) {
    $passsid = intval($_GET['pdel']);
    $sql = "SELECT * from `passenger` WHERE passid='$passsid'";
    $ress = $con->query($sql);
    $row = mysqli_fetch_assoc($ress);
    $passemail = $row['email'];

    $to_email = $passemail;
    $subject = "حذف الحساب";
    $body="بناءاً على عدد البلاغات الكبير التي وصلت عنك , تم حذفك من تطبيق أوتوباس , يُرجى تفهم الموقف..";
    $headers = "From: otobus@gmail.com";
    mail($to_email, $subject, $body, $headers);

    $query = "DELETE FROM `passenger` WHERE email = '$passemail'";
    $result = mysqli_query($con,$query);

}

if(isset($_REQUEST['pidd'])){
    $passsid = intval($_GET['pidd']);
    $sql = "SELECT * from `passenger` WHERE passid='$passsid'";
    $ress = $con->query($sql);
    $row = mysqli_fetch_assoc($ress);
    $passemail = $row['email'];
    $reportcount=$row['repcnt'];

    $to_email = $passemail;
    $subject = "ابلاغ جديد";
    $body=" يُرجى الانتباه أنه تم الإبلاغ عنك للمرة $reportcount 
      واذا وصل عدد البلاغات لأكثر من 20 بلاغ سيتم حذفك من التطبيق ";
    $headers = "From: otobus@gmail.com";
    mail($to_email, $subject, $body, $headers);

    $qqq = "UPDATE `passenger` SET report ='0' WHERE passid = '$passsid'";
    $ress = $con->query($qqq);
}


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
        Otobüs| Reports
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
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
                    <a href="passengers.php">
                        <i class="glyphicon glyphicon-user"></i>
                        <p>Otobüs Passengers</p>
                    </a>
                </li>
                <li >
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
                <li class="active ">
                    <a href="feedback.php">
                        <!--  <i class="far fa-star"></i>-->
                        <i class="fas fa-exclamation-circle"></i>
                        <p> Reports</p>
                    </a>
                </li>
                <li >
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
                <a class="navbar-brand" href="#pablo">Reports</a>
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
    <div class="panel-header panel-header-sm" style="background-color:#FFB236">
    </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header">
                            <h4 class="card-title">Reported Drivers</h4>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>#</th>
                                    <th class="text-center">
                                        Passenger
                                    </th>
                                    <th class="text-center">
                                        Driver
                                    </th>
                                    <th class="text-center">
                                        Driver Phone
                                    </th>
                                    <th class="text-center">
                                         Message
                                    </th>
                                    <th class="text-center">
                                         Times
                                    </th>
                                    <th class="text-center">Accept</th>
                                    <th class="text-center">Don't</th>
                                    <th class="text-center">Delete Driver</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * from `feedback` WHERE report='1'";
                                    $result = $con->query($sql);
                                    $cnt=1;
                                    for($i=0;$i<$result->num_rows;$i++) {
                                        $row = mysqli_fetch_assoc($result);
                                        $passname = $row['passid'];
                                        $driverphone = $row['driverid'];
                                        $reportedmsg = $row['comment'];
                                        $feedid= $row['id'];
                                        $query = "SELECT * from `driver` WHERE phonenum ='$driverphone'";
                                        $res = $con->query($query);
                                        $ro = mysqli_fetch_assoc($res);
                                        $drivername = $ro['name'];
                                        $driveremail = $ro['email'];
                                        $reportcount = $ro['repcnt'];
                                        //$driverid = $ro['driverid'];
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td class="text-center"><b><?php echo htmlentities($passname); ?></b></td>
                                            <td class="text-center"><b><?php echo htmlentities($drivername); ?></b></td>
                                            <td class="text-center"><?php echo htmlentities($driverphone); ?></td>
                                            <td class="text-center"><?php echo htmlentities($reportedmsg); ?></td>
                                            <td class="text-center"><?php echo htmlentities($reportcount); ?></td>

                                            <td class="text-center" ><a href="feedback.php?idd=<?php echo htmlentities($feedid); ?>">
                                                    <button class="btn btn-success btn-xs"><span
                                                            class="glyphicon glyphicon-ok"></span></button>
                                                </a></td>
                                            <td class="text-center" ><a href="feedback.php?dont=<?php echo htmlentities($feedid); ?>">
                                                    <button class="btn btn-primary btn-xs"><span
                                                            class="glyphicon glyphicon-remove"></span></button>
                                                </a></td>
                                            <td class="text-center"><a href="feedback.php?del=<?php echo htmlentities($feedid); ?>">
                                                    <button class="btn btn-danger btn-xs"
                                                            onClick="return confirm('Do you really want to delete driver');">
                                                        <span class="glyphicon glyphicon-trash"></span></button>
                                                </a></td>
                                        </tr>

                                        <?php
                                        $cnt++;
                                        } ?>
                                    </tbody>
                                </table>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header">
                            <h4 class="card-title">Reported Passengers</h4>
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>#</th>
                                    <th class="text-center">
                                        Passenger
                                    </th>
                                    <th class="text-center">
                                        Times
                                    </th>
                                    <th class="text-center">Accept</th>
                                    <th class="text-center">Delete Passenger</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * from `passenger` WHERE report='1'";
                                    $result = $con->query($sql);
                                    $cnt=1;
                                    for($i=0;$i<$result->num_rows;$i++) {
                                        $row = mysqli_fetch_assoc($result);
                                        $passname = $row['name'];
                                        $reportcount=$row['repcnt'];
                                        $passid= $row['passid'];
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td class="text-center"><b><?php echo htmlentities($passname); ?></b></td>
                                            <td class="text-center"><?php echo htmlentities($reportcount); ?></td>

                                            <td class="text-center" ><a href="feedback.php?pidd=<?php echo htmlentities($passid); ?>">
                                                    <button class="btn btn-success btn-xs"><span
                                                                class="glyphicon glyphicon-ok"></span></button>
                                                </a>
                                            </td>

                                            <td class="text-center"><a href="feedback.php?pdel=<?php echo htmlentities($passid); ?>">
                                                    <button class="btn btn-danger btn-xs"
                                                            onClick="return confirm('Do you really want to delete passenger');">
                                                        <span class="glyphicon glyphicon-trash"></span></button>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                        $cnt++;
                                    } ?>
                                    </tbody>
                                </table>
                                <div>
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
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <script src="../assets/demo/demo.js"></script>
</body>

</html>
