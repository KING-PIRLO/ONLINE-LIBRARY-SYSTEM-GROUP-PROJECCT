<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Admin Dash Board</title>
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
                <h4 class="header-line">Admin Dashboard</h4>
            </div>
        </div>

        <div class="row admin-stats">
            <?php 
            // Registered Students
            $sql3 = "SELECT id FROM tblstudents";
            $query3 = $dbh->prepare($sql3);
            $query3->execute();
            $regstds = $query3->rowCount();

            // Registered Librarians
            $sql4 = "SELECT id FROM tbllibrarians";
            $query4 = $dbh->prepare($sql4);
            $query4->execute();
            $reglibs = $query4->rowCount();
            ?>

            <div class="col-md-6 col-sm-6">
                <a href="manage-students.php">
                    <div class="admin-stat-card admin-stat-users">
                        <div class="admin-stat-icon"><i class="fa fa-users"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($regstds);?></p>
                            <p class="admin-stat-label">Registered Students</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-sm-6">
                <a href="manage-librarians.php">
                    <div class="admin-stat-card admin-stat-cats">
                        <div class="admin-stat-icon"><i class="fa fa-user-md"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($reglibs);?></p>
                            <p class="admin-stat-label">Registered Librarians</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
            
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize dropdowns
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
<?php } ?>
