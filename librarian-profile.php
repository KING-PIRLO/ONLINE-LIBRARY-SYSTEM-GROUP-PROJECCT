<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
{ 
header('location:librarianlogin.php');
}
else{
$libid=$_SESSION['libid'];
$sql = "SELECT * from tbllibrarians where LibrarianId=:libid";
$query = $dbh -> prepare($sql);
$query->bindParam(':libid',$libid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Librarian Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
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
                <h4 class="header-line">My Profile</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Librarian ID</th>
                                <td><?php echo htmlentities($result->LibrarianId);?></td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo htmlentities($result->FullName);?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlentities($result->EmailId);?></td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td><?php echo htmlentities($result->MobileNumber);?></td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td><?php echo htmlentities($result->RegDate);?></td>
                            </tr>
                        </table>
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
<?php }} } ?>
