<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
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
    <title>Online Library Management System | Admin Login</title>
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
<div class="row pad-botm">
    <div class="col-md-12">
        <h4 class="header-line">Administrator Access</h4>
    </div>
</div>
             
<!--ADMIN LOGIN SECTION START-->           
<div class="row admin-login-section">
    <div class="col-md-6 col-md-offset-3">
        <div class="admin-login-card">
            <div class="admin-login-header">
                <div class="admin-login-icon">
                    <i class="fa fa-shield"></i>
                </div>
                <h3 class="admin-login-title">Admin Login</h3>
                <p class="admin-login-subtitle">Secure administrator access</p>
            </div>
            
            <div class="admin-login-body">
                <form role="form" method="post" class="admin-login-form">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-user-circle"></i>
                            Username
                        </label>
                        <input class="form-control modern-input" type="text" name="username" autocomplete="off" required placeholder="Enter admin username" />
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-lock"></i>
                            Password
                        </label>
                        <input class="form-control modern-input" type="password" name="password" autocomplete="off" required placeholder="Enter admin password" />
                    </div>

                    <button type="submit" name="login" class="btn btn-admin-login">
                        <i class="fa fa-sign-in"></i>
                        Access Admin Panel
                    </button>
                    
                    <div class="admin-notice">
                        <i class="fa fa-info-circle"></i>
                        <span>Authorized personnel only</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
<!---ADMIN LOGIN SECTION END-->            
             
 
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
</script>
</body>
</html>
