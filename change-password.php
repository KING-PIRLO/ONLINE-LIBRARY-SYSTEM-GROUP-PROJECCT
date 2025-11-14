<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['change']))
  {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['login'];
  $sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";  
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
    <title>Online Library Management System | Change Password</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
  <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Change Password</h4>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if($error){?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert-message error-message">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>Error:</strong> <?php echo htmlentities($error); ?>
                    </div>
                </div>
            </div>
        <?php } else if($msg){?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert-message success-message">
                        <i class="fa fa-check-circle"></i>
                        <strong>Success:</strong> <?php echo htmlentities($msg); ?>
                    </div>
                </div>
            </div>
        <?php }?>

        <div class="row password-section">
            <div class="col-md-6 col-md-offset-3">
                <div class="password-card">
                    <div class="password-header">
                        <div class="password-icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h3 class="password-title">Change Password</h3>
                        <p class="password-subtitle">Update your account security</p>
                    </div>
                    
                    <div class="password-body">
                        <form role="form" method="post" onSubmit="return valid();" name="chngpwd" class="password-form">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa fa-key"></i>
                                    Current Password
                                </label>
                                <input class="form-control modern-input" type="password" name="password" autocomplete="off" required placeholder="Enter current password" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa fa-lock"></i>
                                    New Password
                                </label>
                                <input class="form-control modern-input" type="password" name="newpassword" autocomplete="off" required placeholder="Enter new password" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa fa-lock"></i>
                                    Confirm New Password
                                </label>
                                <input class="form-control modern-input" type="password" name="confirmpassword" autocomplete="off" required placeholder="Confirm new password" />
                            </div>

                            <button type="submit" name="change" class="btn btn-change">
                                <i class="fa fa-save"></i>
                                Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>            
             
 
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
<?php } ?>
