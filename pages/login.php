<!doctype html>
<html lang="en">
<head>
    <title>Otobüs Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../images/icon2.png">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(../images/ssdasda.png);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Admin Signin</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <?php
                    require('db.php');
                    session_start();
                    if (isset($_POST['email'])){
                        $email = stripslashes($_REQUEST['email']);
                        $email  = mysqli_real_escape_string($con,$email );
                        $password = stripslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($con,$password);
                        $query = "SELECT * FROM `admin` WHERE email='$email'and password='".md5($password)."'";
                        $result = mysqli_query($con,$query) or die(mysql_error());
                        $rows = mysqli_num_rows($result);
                        if($rows==1){
                            $qur="SELECT * FROM `admin` WHERE email='$email'";
                            $res= mysqli_query($con,$qur) or die(mysql_error());
                            $row = mysqli_fetch_assoc($res);
                            $admname =$row['adname'];
                            $_SESSION['adname'] = $admname;
                            $_SESSION['ademail'] = $email;
                            $_SESSION['adpass'] = $password;
                            $_SESSION['srcid']="";
                            $_SESSION['destid']="";
                            header("Location: ./dashboard.php");
                        }else{
                            echo "<div >
                              <h3>Email/password is incorrect.</h3>
                              <br/>Click here to <a href='login.php'>Login</a></div>";
                        }
                    }else{
                    ?>
                    <form method="post" name="login" action="" class="signin-form">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password" class="form-control" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button name="submit" type="submit" value="Login" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>

