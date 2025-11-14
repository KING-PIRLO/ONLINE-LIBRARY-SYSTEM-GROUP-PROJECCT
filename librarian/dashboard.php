<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
{
header('location:../librarianlogin.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Librarian Dashboard</title>
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../admin/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../admin/assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
</head>
<body>
<?php include('includes/header.php');?>
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Librarian Dashboard</h4>
            </div>
        </div>
        <div class="row admin-stats">
            <?php 
            $sql = "SELECT id FROM tblbooks";
            $query = $dbh->prepare($sql);
            $query->execute();
            $listdbooks = $query->rowCount();

            $sql2 = "SELECT id FROM tblissuedbookdetails WHERE (RetrunStatus='' OR RetrunStatus IS NULL)";
            $query2 = $dbh->prepare($sql2);
            $query2->execute();
            $returnedbooks = $query2->rowCount();

            $sql3 = "SELECT id FROM tblstudents";
            $query3 = $dbh->prepare($sql3);
            $query3->execute();
            $regstds = $query3->rowCount();

            $sql5 = "SELECT id FROM tblcategory";
            $query5 = $dbh->prepare($sql5);
            $query5->execute();
            $listdcats = $query5->rowCount();
            ?>

            <div class="col-md-3 col-sm-6">
                <a href="manage-books.php">
                    <div class="admin-stat-card admin-stat-books">
                        <div class="admin-stat-icon"><i class="fa fa-book"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($listdbooks);?></p>
                            <p class="admin-stat-label">Books Listed</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="manage-issued-books.php">
                    <div class="admin-stat-card admin-stat-issued">
                        <div class="admin-stat-icon"><i class="fa fa-recycle"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($returnedbooks);?></p>
                            <p class="admin-stat-label">Books Not Returned</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="reg-students.php">
                    <div class="admin-stat-card admin-stat-users">
                        <div class="admin-stat-icon"><i class="fa fa-users"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($regstds);?></p>
                            <p class="admin-stat-label">Registered Students</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="manage-categories.php">
                    <div class="admin-stat-card admin-stat-cats">
                        <div class="admin-stat-icon"><i class="fa fa-file-archive-o"></i></div>
                        <div class="admin-stat-content">
                            <p class="admin-stat-number"><?php echo htmlentities($listdcats);?></p>
                            <p class="admin-stat-label">Listed Categories</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
<?php include('includes/footer.php');?>
    <script src="../admin/assets/js/jquery-1.10.2.js"></script>
    <script src="../admin/assets/js/bootstrap.js"></script>
    <script src="../admin/assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
