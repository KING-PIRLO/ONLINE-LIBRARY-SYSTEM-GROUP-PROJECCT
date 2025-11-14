<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 



    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System |  Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <h4 class="header-line">Manage Issued Books</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Modern Table Card -->
                <div class="modern-table-card">
                    <div class="card-header">
                        <div class="header-content">
                            <h5 class="card-title">
                                <i class="fa fa-bookmark"></i>
                                Issued Books
                            </h5>
                            <div class="header-actions">
                                <div class="search-box">
                                    <input type="text" id="tableSearch" placeholder="Search books..." class="form-control">
                                    <i class="fa fa-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table modern-table" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN </th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Fine (RM)</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['stdid'];
try {
    $sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.finePaymentStatus from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
    foreach($results as $result)
    {               ?>                                      
                                        <tr>
                                            <td><span class="row-number"><?php echo htmlentities($cnt);?></span></td>
                                            <td>
                                                <div class="book-info">
                                                    <strong><?php echo htmlentities($result->BookName);?></strong>
                                                </div>
                                            </td>
                                            <td><code class="isbn-code"><?php echo htmlentities($result->ISBNNumber);?></code></td>
                                            <td><span class="date-text"><?php echo htmlentities($result->IssuesDate);?></span></td>
                                            <td>
                                                <?php if($result->ReturnDate=="") { ?>
                                                    <span class="status-badge status-pending">
                                                        <i class="fa fa-clock-o"></i>
                                                        Not Returned
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="status-badge status-returned">
                                                        <i class="fa fa-check"></i>
                                                        <?php echo htmlentities($result->ReturnDate); ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($result->fine > 0) { ?>
                                                    <span class="fine-amount fine-due">RM <?php echo htmlentities($result->fine);?></span>
                                                <?php } else { ?>
                                                    <span class="fine-amount fine-none">RM 0.00</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($result->fine > 0) { ?>
                                                    <?php if($result->finePaymentStatus == 1) { ?>
                                                        <span class="status-badge status-returned">
                                                            <i class="fa fa-check-circle"></i>
                                                            Paid
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="status-badge status-pending">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                            Unpaid
                                                        </span>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <span class="fine-amount fine-none">N/A</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}}
} catch(PDOException $e) {
    echo '<tr><td colspan="7" class="text-center"><div class="alert alert-warning">Error loading issued books. Please contact administrator.</div></td></tr>';
}
?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
