<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
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
    <title>Online Library Management System | User Dash Board</title>
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
                <h4 class="header-line">User DASHBOARD</h4>
                
                            </div>

        </div>
             
             <div class="row dashboard-stats">
                 
                 <!-- Books Listed Card -->
                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <a href="listed-books.php" class="dashboard-card-link">
                         <div class="dashboard-card books-card">
                             <div class="card-icon">
                                 <i class="fa fa-book"></i>
                             </div>
                             <div class="card-content">
                                 <?php 
                                 $sql ="SELECT id from tblbooks ";
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

                 <!-- Books Not Returned Card -->
                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <a href="issued-books.php" class="dashboard-card-link">
                         <div class="dashboard-card pending-card">
                             <div class="card-icon">
                                 <i class="fa fa-clock-o"></i>
                             </div>
                             <div class="card-content">
                                 <?php 
                                 $rsts=0;
                                 $sid=$_SESSION['stdid'];
                                 $sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and (RetrunStatus=:rsts || RetrunStatus is null || RetrunStatus='')";
                                 $query2 = $dbh -> prepare($sql2);
                                 $query2->bindParam(':sid',$sid,PDO::PARAM_STR);
                                 $query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
                                 $query2->execute();
                                 $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                                 $returnedbooks=$query2->rowCount();
                                 ?>
                                 <h2 class="card-number"><?php echo htmlentities($returnedbooks);?></h2>
                                 <p class="card-label">Books Not Returned</p>
                             </div>
                         </div>
                     </a>
                 </div>

                 <!-- Total Issued Books Card -->
                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <a href="issued-books.php" class="dashboard-card-link">
                         <div class="dashboard-card issued-card">
                             <div class="card-icon">
                                 <i class="fa fa-bookmark"></i>
                             </div>
                             <div class="card-content">
                                 <?php 
                                 $ret =$dbh -> prepare("SELECT id from tblissuedbookdetails where StudentID=:sid");
                                 $ret->bindParam(':sid',$sid,PDO::PARAM_STR);
                                 $ret->execute();
                                 $results22=$ret->fetchAll(PDO::FETCH_OBJ);
                                 $totalissuedbook=$ret->rowCount();
                                 ?>
                                 <h2 class="card-number"><?php echo htmlentities($totalissuedbook);?></h2>
                                 <p class="card-label">Total Issued Books</p>
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
</body>
</html>
<?php } ?>
