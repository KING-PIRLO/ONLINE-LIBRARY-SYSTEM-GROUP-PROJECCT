<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
// normalize input
$email = isset($_POST['emailid']) ? strtolower(trim($_POST['emailid'])) : '';
$enteredPlain = isset($_POST['password']) ? trim($_POST['password']) : '';
$password = md5($enteredPlain);
$sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE LOWER(EmailId)=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
    $result = $results[0];
    $_SESSION['stdid']=$result->StudentId;
    if(strtolower(trim($result->EmailId)) !== $email) {
        echo "<script>alert('Invalid email or password');</script>";
    } else if($result->Password !== $password && $result->Password !== $enteredPlain) {
        echo "<script>alert('Invalid email or password');</script>";
    } else if($result->Status != 1) {
        echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
    } else {
        $_SESSION['login']=$email;
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    }
} 
else{
    echo "<script>alert('Invalid email or password');</script>";
}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<!--Hero Section---->
<div class="row">
    <div class="col-md-12">
        <div class="hero-section">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Welcome to Online Library</h1>
                    <p class="hero-subtitle">Discover thousands of books and manage your reading journey</p>
                </div>
                <div class="hero-image">
                    <div id="carousel-example" class="carousel slide modern-carousel" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/img/1.jpg" alt="Library Books" />
                            </div>
                            <div class="item">
                                <img src="assets/img/2.jpg" alt="Reading Space" />
                            </div>
                            <div class="item">
                                <img src="assets/img/3.jpg" alt="Book Collection" />
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span class="fa fa-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span class="fa fa-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<a name="ulogin"></a>
<!--LOGIN SECTION START-->
<div class="row login-section">
    <div class="col-md-6 col-md-offset-3">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fa fa-user-circle"></i>
                </div>
                <h3 class="login-title">User Login</h3>
                <p class="login-subtitle">Access your library account</p>
            </div>

            <div class="login-body">
                <form role="form" method="post" class="login-form">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-envelope"></i>
                            Enter Email ID
                        </label>
                        <input class="form-control modern-input" type="text" name="emailid" required autocomplete="off" placeholder="your.email@example.com" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-lock"></i>
                            Password
                        </label>
                        <input class="form-control modern-input" type="password" name="password" required autocomplete="off" placeholder="Enter your password" />
                    </div>

                    <div class="form-options">
                        <a href="user-forgot-password.php" class="forgot-link">
                            <i class="fa fa-question-circle"></i>
                            Forgot Password?
                        </a>
                    </div>

                    <button type="submit" name="login" class="btn btn-login">
                        <i class="fa fa-sign-in"></i>
                        Login to Account
                    </button>

                    <div class="signup-prompt">
                        <span>Contact administrator to create an account</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!---LOGIN SECTION END-->


    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
