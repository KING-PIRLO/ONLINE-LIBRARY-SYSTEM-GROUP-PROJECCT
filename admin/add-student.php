<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{ 

// Get next student ID for display
$sql = "SELECT MAX(CAST(SUBSTRING(StudentId, 4) AS UNSIGNED)) as maxid FROM tblstudents";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$nextIdNum = ($result && $result->maxid) ? $result->maxid + 1 : 1;
$nextStudentId = "SID" . str_pad($nextIdNum, 3, '0', STR_PAD_LEFT);

if(isset($_POST['add']))
{
$sql = "SELECT MAX(CAST(SUBSTRING(StudentId, 4) AS UNSIGNED)) as maxid FROM tblstudents";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$nextId = $result->maxid ? $result->maxid + 1 : 1;
$StudentId = "SID" . str_pad($nextId, 3, '0', STR_PAD_LEFT);   
$fname = $_POST['fullname'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email']; 
$password = md5($_POST['password']); 
$status = 1;

$sql = "INSERT INTO tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    $_SESSION['newstudent']=array('id'=>$StudentId, 'name'=>$fname, 'email'=>$email);
    header('location:add-student.php?success=1');
}
else 
{
    $_SESSION['error']="Something went wrong. Please try again";
    header('location:add-student.php');
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Add Student</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body>
<?php include('includes/header.php');?>
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Student</h4>
            </div>
        </div>
        <?php if(isset($_GET['success']) && isset($_SESSION['newstudent'])){?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><i class="fa fa-check-circle"></i> Student Added Successfully!</h4>
            <div style="margin-top:15px; padding:15px; background:#f0f9ff; border-left:4px solid #5cb85c;">
                <p style="margin:5px 0;"><strong>Student ID:</strong> <span style="font-size:18px; color:#2196F3;"><?php echo htmlentities($_SESSION['newstudent']['id']);?></span></p>
                <p style="margin:5px 0;"><strong>Name:</strong> <?php echo htmlentities($_SESSION['newstudent']['name']);?></p>
                <p style="margin:5px 0;"><strong>Email:</strong> <?php echo htmlentities($_SESSION['newstudent']['email']);?></p>
            </div>
        </div>
        <?php unset($_SESSION['newstudent']); } ?>
        <?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']);?><?php echo htmlentities($_SESSION['error']="");?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-user-plus"></i> Student Information</strong>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong><i class="fa fa-info-circle"></i> Next Student ID:</strong> 
                            <span style="font-size:18px; color:#2196F3; font-weight:bold;"><?php echo $nextStudentId; ?></span>
                        </div>
                        <form role="form" method="post">
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>Full Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="fullname" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Mobile Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="mobileno" maxlength="11" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()" required />
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input class="form-control" type="password" name="password" required />
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <button type="submit" name="add" class="btn btn-primary"><i class="fa fa-check"></i> Add Student</button>
                            </div>
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
