<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
{ 
header('location:librarianlogin.php');
}
else{
if(isset($_POST['change']))
{
$libid=$_SESSION['libid'];
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT Password FROM tbllibrarians WHERE LibrarianId=:libid and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':libid', $libid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="UPDATE tbllibrarians SET Password=:newpassword WHERE LibrarianId=:libid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':libid', $libid, PDO::PARAM_STR);
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
    <title>Online Library Management System | Change Password</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
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
</head>
<body>
<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse">
                    <img src="assets/img/logo.png" alt="Logo" class="menu-logo">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a href="librarian-dashboard.php">DASHBOARD</a></li>
                        <li><a href="listed-books.php">Books</a></li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="librarian-profile.php">My Profile</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="librarian-change-password.php">Change Password</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Change Password</h4>
            </div>
        </div>
        <?php if($error){?><div class="alert alert-danger"><strong>ERROR:</strong> <?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="alert alert-success"><strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                        <form name="chngpwd" method="post" onSubmit="return valid();">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input class="form-control" type="password" name="password" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                            </div>
                            <button type="submit" name="change" class="btn btn-info">Change</button>
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
<?php } ?>
