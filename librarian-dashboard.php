<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
{ 
header('location:librarianlogin.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Librarian Dashboard</title>
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
                        <li><a href="librarian-dashboard.php" class="menu-top-active">DASHBOARD</a></li>
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
                <h4 class="header-line">Librarian Dashboard</h4>
            </div>
        </div>
        <div class="row dashboard-stats">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="listed-books.php" class="dashboard-card-link">
                    <div class="dashboard-card books-card">
                        <div class="card-icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="card-content">
                            <?php 
                            $sql ="SELECT id from tblbooks";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $listdbooks=$query->rowCount();
                            ?>
                            <h2 class="card-number"><?php echo htmlentities($listdbooks);?></h2>
                            <p class="card-label">Books Listed</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-card pending-card">
                    <div class="card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-content">
                        <?php 
                        $sql2 ="SELECT id from tblstudents";
                        $query2 = $dbh -> prepare($sql2);
                        $query2->execute();
                        $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                        $totalstudents=$query2->rowCount();
                        ?>
                        <h2 class="card-number"><?php echo htmlentities($totalstudents);?></h2>
                        <p class="card-label">Total Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-card issued-card">
                    <div class="card-icon">
                        <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="card-content">
                        <?php 
                        $sql3 ="SELECT id from tblissuedbookdetails WHERE (RetrunStatus='' OR RetrunStatus IS NULL)";
                        $query3 = $dbh -> prepare($sql3);
                        $query3->execute();
                        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                        $issuedbooks=$query3->rowCount();
                        ?>
                        <h2 class="card-number"><?php echo htmlentities($issuedbooks);?></h2>
                        <p class="card-label">Books Issued</p>
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
