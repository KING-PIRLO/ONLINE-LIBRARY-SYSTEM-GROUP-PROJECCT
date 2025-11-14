<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
    {   
header('location:../librarianlogin.php');
}
else{ 

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$finePaymentStatus=isset($_POST['finepaid']) ? 1 : 0;
$rstatus=1;
$bookid=$_POST['bookid'];
$sql="update tblissuedbookdetails set fine=:fine,finePaymentStatus=:finePaymentStatus,RetrunStatus=:rstatus where id=:rid;
update tblbooks set isIssued=0 where id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->bindParam(':finePaymentStatus',$finePaymentStatus,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book Returned successfully";
header('location:manage-issued-books.php');
exit();
}

if(isset($_POST['updatepayment']))
{
$rid=intval($_GET['rid']);
$finePaymentStatus=isset($_POST['finepaid']) ? 1 : 0;
$sql="update tblissuedbookdetails set finePaymentStatus=:finePaymentStatus where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':finePaymentStatus',$finePaymentStatus,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Fine payment status updated successfully";
header('location:manage-issued-books.php');
exit();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Book Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="../admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issued Book Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="admin-card">
<div class="card-header">
<strong><i class="fa fa-info-circle"></i> Issued Book Details</strong>
</div>
<div class="card-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT tblstudents.StudentId ,tblstudents.FullName,tblstudents.EmailId,tblstudents.MobileNumber,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.finePaymentStatus,tblissuedbookdetails.RetrunStatus,tblbooks.id as bid,tblbooks.bookImage from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   


<input type="hidden" name="bookid" value="<?php echo htmlentities($result->bid);?>">
<h4>Student Details</h4>
<hr />
<div class="col-md-6"> 
<div class="form-group">
<label>Student ID :</label>
<?php echo htmlentities($result->StudentId);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>Student Name :</label>
<?php echo htmlentities($result->FullName);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>Student Email Id :</label>
<?php echo htmlentities($result->EmailId);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>Student Contact No :</label>
<?php echo htmlentities($result->MobileNumber);?>
</div></div>



<h4>Book Details</h4>
<hr />

<div class="col-md-6"> 
<div class="form-group">
<label>Book Image :</label>
<img src="../admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" width="120">
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label>Book Name :</label>
<?php echo htmlentities($result->BookName);?>
</div>
</div>
<div class="col-md-6"> 
<div class="form-group">
<label>ISBN :</label>
<?php echo htmlentities($result->ISBNNumber);?>
</div>
</div>

<div class="col-md-6"> 
<div class="form-group">
<label>Book Issued Date :</label>
<?php echo htmlentities($result->IssuesDate);?>
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label>Book Returned Date :</label>
<?php if($result->ReturnDate=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->ReturnDate);
}
                                            ?>
</div>
</div>

<div class="col-md-12"> 
<div class="form-group">
<label>Fine (in RM) :</label>
<?php 
if($result->fine=="")
{
    $issueDate = new DateTime($result->IssuesDate);
    $currentDate = new DateTime();
    $diff = $currentDate->diff($issueDate);
    $daysLate = $diff->days - 7;
    $autoFine = ($daysLate > 0) ? $daysLate * 1 : 0;
?>
<input class="form-control" type="text" name="fine" id="fine" value="<?php echo $autoFine; ?>" required />
<small class="help-block">Auto-calculated: RM 1 per day after 7 days (<?php echo $diff->days; ?> days issued)</small>
<?php }else {
echo "RM " . htmlentities($result->fine);
}
?>
</div>
</div>

<div class="col-md-12"> 
<div class="form-group">
<?php if($result->RetrunStatus==1 && $result->fine > 0){?>
<label>Fine Payment Status:</label>
<p><?php echo ($result->finePaymentStatus == 1) ? '<span class="badge" style="background:#5cb85c;">Paid</span>' : '<span class="badge" style="background:#f0ad4e;">Unpaid</span>'; ?></p>
<?php } ?>
<?php if($result->fine=="" || $result->fine > 0){?>
<label>
<input type="checkbox" name="finepaid" value="1" <?php if(isset($result->finePaymentStatus) && $result->finePaymentStatus==1) echo 'checked'; ?> /> Mark Fine as Paid
</label>
<?php } ?>
</div>
</div>

 <?php if($result->RetrunStatus==0){?>

<button type="submit" name="return" id="submit" class="btn btn-primary"><i class="fa fa-undo"></i> Return Book</button>

 </div>

<?php } else if($result->fine > 0) { ?>

<button type="submit" name="updatepayment" class="btn btn-success"><i class="fa fa-money"></i> Update Payment Status</button>

 </div>

<?php } else { ?>
 </div>
<?php } }} ?>
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
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="../admin/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../admin/assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="../admin/assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
