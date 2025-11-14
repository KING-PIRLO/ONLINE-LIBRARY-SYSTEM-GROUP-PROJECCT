<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['llogin'])==0)
    {   
header('location:../librarianlogin.php');
}
else{ 

if(isset($_POST['issue']))
{
$studentid=strtoupper($_POST['studentid']);
$bookid=isset($_POST['bookid']) ? $_POST['bookid'] : ''; 
$aremark=$_POST['aremark']; 
$isissued=1;
$aqty=isset($_POST['aqty']) ? $_POST['aqty'] : 0;

if(empty($bookid)){
    $_SESSION['error']="Please select a book";
    header('location:issue-book.php');
    exit();
}

if($aqty>0){
$sql="INSERT INTO  tblissuedbookdetails(StudentID,BookId,remark) VALUES(:studentid,:bookid,:aremark)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->bindParam(':aremark',$aremark,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book issued successfully";
header('location:manage-issued-books.php');
exit();
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:issue-book.php');
exit();
} } else {
 $_SESSION['error']="Book Not available";
header('location:issue-book.php');   
exit();
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
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="../admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <h4 class="header-line">Issue a New Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="admin-card">
<div class="card-header">
<strong><i class="fa fa-plus"></i> Issue a New Book</strong>
</div>
<div class="card-body">
<form role="form" method="post">

<div class="form-group">
<label>Student ID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>





<div class="form-group">
<label>ISBN Number or Book Title<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookid" id="bookid" placeholder="Start typing ISBN or book name..." required="required" />
</div>
 <div class="form-group" id="get_book_name">

 </div>
<div class="form-group">
<label>Remark<span style="color:red;">*</span></label>
<textarea class="form-control"  name="aremark" id="aremark" required></textarea> 
</div>


<button type="submit" name="issue" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> Issue Book</button>

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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../admin/assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="../admin/assets/js/custom.js"></script>
    <script>
    $(document).ready(function(){
        $("#bookid").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "search_books.php",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $("#bookid").val(ui.item.value);
                getbook();
                return false;
            }
        });
    });
    </script>

</body>
</html>
<?php } ?>
