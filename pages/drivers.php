<?php
require_once'db.php';
include("./auth.php");
$source="";
$destination="";
if(isset($_REQUEST['dest'])) {
    $placeid = intval($_GET['dest']);
    $_SESSION['destid']=$placeid;
}
if(isset($_REQUEST['src'])) {
    $placeid = intval($_GET['src']);
    $_SESSION['srcid']=$placeid;
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
        Otobüs| Drivers
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
                <li>
                    <a href="requests.php">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Drivers Requests</p>
                    </a>
                </li>
                <li>
                    <a href="feedback.php">
                        <i class="fas fa-exclamation-circle"></i>
                        <p> Reported Drivers</p>
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
            <div class="row">
                <div class="”col-3">
                    <div class="card">
                        <?php
                        $src=$_SESSION['srcid'];
                        $dest=$_SESSION['destid'];
                        //echo $src;
                        //echo $dest;
                        ?>
                        <div class="container-fluid">
                        <div class="row" >
                            <span>&nbsp;&nbsp;&nbsp;</span>
                            <div class="dropdown" >
                                <button style="background-color: #0c2646; font-size: 15px;"  class="btn btn-secondary dropdown-toggle" type="button" id="from" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &nbsp;&nbsp;&nbsp;&nbsp;Source&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    $sql = "SELECT * from `places` WHERE 1";
                                    $result = $con->query($sql);
                                    for($i=0;$i<$result->num_rows;$i++) {
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <a class="dropdown-item" href="drivers.php?src=<?php echo $row['id']; ?>" style="font-size: 15px"><?php echo $row['PlaceName'];?></a>
                                        <div class="dropdown-divider"></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>
                            <div class="dropdown">
                                <button style="background-color: #0c2646; font-size: 15px;" class="btn btn-secondary dropdown-toggle" type="button" id="to" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Destination
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    $sql = "SELECT * from `places` WHERE 1";
                                    $result = $con->query($sql);
                                    for($i=0;$i<$result->num_rows;$i++) {
                                      $row = mysqli_fetch_assoc($result);
                                    ?>
                                    <a class="dropdown-item" href="drivers.php?dest=<?php echo $row['id']; ?>" style="font-size: 15px"><?php echo $row['PlaceName'];?></a>
                                    <div class="dropdown-divider"></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <span>&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        <div class="row">
            <div class="card-body all-icons">
                <div class="card">
                    <div class="card-header">
                        <?php
                    $sql1 = "SELECT * from `places` WHERE id='$src'";
                    $res1 = $con->query($sql1);
                    $row1 = mysqli_fetch_assoc($res1);
                    if($res1->num_rows>0)
                    $source = $row1['PlaceName'];
                    $sql2 = "SELECT * from `places` WHERE id='$dest'";
                    $res2 = $con->query($sql2);
                    $row2 = mysqli_fetch_assoc($res2);
                    if($res2->num_rows>0)
                    $destination = $row2['PlaceName'];
                    ?>
                        <h4 class="card-title"><b>(&nbsp;&nbsp;<?php echo $source;?>&nbsp;&nbsp;<->&nbsp;&nbsp;<?php echo $destination ?>&nbsp;&nbsp;) Drivers</b></h4>
                    </div>
                    <div class="card-body">
                    <?php
                    $cnt=1;
                    $sql = "SELECT * from `driver` WHERE (begname='$source' AND endname='$destination') OR (begname='$destination' AND endname='$source')";
                    $result = $con->query($sql);
                    for($i=0;$i<$result->num_rows;$i++) {
                        $row = mysqli_fetch_assoc($result);
                        $drivername= $row['name'];
                    ?>
                        <div class="font-icon-list col-lg-3 col-md-6 col-sm-6 col-xs-6 col-xs-6">
                            <div class="font-icon-detail">
                                <i class="fas fa-star" style="color:orange;font-size: 20px"></i>
                                <i class="fas fa-star-half-alt" style="color:orange;font-size: 20px"></i>
                                <i class="far fa-star" style="color:orange;font-size: 20px"></i>
                                <p style="font-size: 20px;color: black"><?php
                                    echo $drivername;
                                    ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }
    var arr = ["UK", "France", "Spain", "Russia", "Italy", "Turkey", "Austrlia", "USA", "Egypt", "Lebanon", "Germany", "Portughal", "Emirate", "Switzerland", "Brazil", "Canada", "Jaban", "Malaysia", "Trabzon"];
    autocomplete(document.getElementById("inp"), arr);
</script>

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