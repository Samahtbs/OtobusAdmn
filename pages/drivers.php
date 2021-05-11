<?php
require("db.php");
include("./auth.php");
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
        Otobüs Drivers
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
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

                <li class="active ">
                    <a href="drivers.php">
                        <i class="fas fa-bus"></i>
                        <p>Otobüs Drivers</p>
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
                <a class="navbar-brand" href="#pablo">Drivers INFORMATION</a>
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
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Requests of New Drivers</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $sql = "SELECT * from `driver` WHERE active=0b0";
                                $result = $con->query($sql);
                                if($result->num_rows>0) {
                                $row = mysqli_fetch_assoc($result);
                                $licenseImage= base64_decode($row['licencoded']);
                                file_put_contents('../driverimgs/'.$row['license'], $licenseImage);
                                $busid=$row['busid'];
                                $query="SELECT * from `bus` WHERE busid ='$busid'";
                                $res = $con->query($query);
                                $ro = mysqli_fetch_assoc($res);
                                $type=$ro['type'];
                                $passnum=$ro['numofpass'];
                                $idcardname=$ro['idcard'];
                                $encidcard=$ro['cardencoded'];
                                $insname=$ro['insurname'];
                                $inscard=$ro['insurencoded'];
                                $insenddate=$ro['insurend'];
                                $idcardImage= base64_decode($encidcard);
                                $insImage=base64_decode($inscard);
                                file_put_contents('../driverimgs/'.$idcardname, $idcardImage);
                                file_put_contents('../driverimgs/'. $insname, $insImage);
                                ?>
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th class="text-center">
                                        Name
                                    </th>
                                    <th class="text-center">
                                        Email
                                    </th>
                                    <th class="text-center">
                                        Phone #
                                    </th>
                                    <th class="text-center">
                                        Driving license
                                    </th>
                                    <th class="text-center">
                                        Bus Info
                                    </th>
                                    <th class="text-center">
                                        State
                                    </th>
                                    </thead>
                                    <tbody>
                                            <tr id="<?php echo $row['driverid']; ?>">
                                                <td class="text-center"><?php $_SESSION['drivername']=$row['name']; echo $row['name']; ?></td>
                                                <td class="text-center"><?php $_SESSION['driveremail']=$row['email']; echo $row['email']; ?></td>
                                                <td class="text-center"><?php echo $row['phonenum']; ?></td>
                                                <td class="text-center"><button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".bd-example-modal-lg">DL picture</button></td>
                                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle"><b>Driving License Picture</b></h5>
                                                            </div>
                                                            <img src=<?php echo '../driverimgs/'.$row['license']?> alt="license" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <td class="text-center"><button button type="button" class="btn btn-primary" data-toggle="modal" data-target="#businfo">See it</button></td>
                                                <div class="modal fade" id="businfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle"><b>Bus Information</b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="text-center">Bus Plate Card :&nbsp;&nbsp;<b><?php echo $busid; ?></b></h5>
                                                                <h5 class="text-center">Bus Type :&nbsp;&nbsp;<b><?php echo $type; ?></b></h5>
                                                                <h5 class="text-center">Number of Passengers :&nbsp;&nbsp;<b><?php echo $passnum; ?></b></h5>
                                                                <h5 class="text-center">Bud ID Card :</h5>
                                                                <img src=<?php echo '../driverimgs/'.$idcardname?> alt="idcard" />
                                                                <h5 class="text-center">Insurance card :</h5>
                                                                <img src=<?php echo '../driverimgs/'.$insname?> alt="insurancecard" />
                                                                <h5 class="text-center">Insurance End Date :&nbsp;&nbsp;<b><?php echo $insenddate; ?></b></h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td class="text-center">
                                                    <form action="accept.php">
                                                        <button name="accept" type="submit" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                                                    </form>
                                                    <form action="delete.php">
                                                        <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                             }else{
                                                  echo"
                                                   <br/>
                        <br/>
                        <h5 style=\"color: limegreen ;text-align: center\">
                             There is no requests for now
                        </h5>
                        </br>";}
                                            ?>

                                            <script>
                                                function myFunc() {
                                                    // onclick="myFunc();"
                                                    //var $emmail=document.getElementById("70").innerHTML;
                                                    //return $emmail;
                                                    //document.getElementById("demo").innerHTML =$emmail;
                                                }
                                            </script>
                                            <h5 id="demo"></h5>

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