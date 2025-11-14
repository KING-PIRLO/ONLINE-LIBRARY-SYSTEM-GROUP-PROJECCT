<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['llogin']!=''){
$_SESSION['llogin']='';
}
if(isset($_POST['login']))
{
$email = isset($_POST['emailid']) ? strtolower(trim($_POST['emailid'])) : '';
$enteredPlain = isset($_POST['password']) ? trim($_POST['password']) : '';
$password = md5($enteredPlain);
$sql ="SELECT EmailId,Password,LibrarianId,Status FROM tbllibrarians WHERE LOWER(EmailId)=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
    $result = $results[0];
    $_SESSION['libid']=$result->LibrarianId;
    if(strtolower(trim($result->EmailId)) !== $email) {
        echo "<script>alert('Invalid email or password');</script>";
    } else if($result->Password !== $password && $result->Password !== $enteredPlain) {
        echo "<script>alert('Invalid email or password');</script>";
    } else if($result->Status != 1) {
        echo "<script>alert('Your Account Has been blocked. Please contact admin');</script>";
    } else {
        $_SESSION['llogin']=$email;
        echo "<script type='text/javascript'> document.location ='librarian/dashboard.php'; </script>";
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
    <title>Online Library Management System | Librarian Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
</head>
<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
    <div class="col-md-12">
        <h4 class="header-line">Librarian Access</h4>
    </div>
</div>
<div class="row admin-login-section">
    <div class="col-md-6 col-md-offset-3">
        <div class="admin-login-card">
            <div class="admin-login-header">
                <div class="admin-login-icon">
                    <i class="fa fa-book"></i>
                </div>
                <h3 class="admin-login-title">Librarian Login</h3>
                <p class="admin-login-subtitle">Library staff access</p>
            </div>
            <div class="admin-login-body">
                <form role="form" method="post" class="admin-login-form">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-envelope"></i>
                            Email Address
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
                    <button type="submit" name="login" class="btn btn-admin-login">
                        <i class="fa fa-sign-in"></i>
                        Access Librarian Panel
                    </button>
                    <div class="admin-notice">
                        <i class="fa fa-info-circle"></i>
                        <span>Authorized librarians only</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
</div>
</div>
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
