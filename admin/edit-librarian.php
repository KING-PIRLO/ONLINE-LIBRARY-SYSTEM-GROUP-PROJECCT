<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{
$libid=intval($_GET['libid']);
$fname=$_POST['fullname'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email'];

$sql="UPDATE tbllibrarians SET FullName=:fname,MobileNumber=:mobileno,EmailId=:email WHERE id=:libid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':libid',$libid,PDO::PARAM_STR);
$query->execute();

if(isset($_POST['newpassword']) && $_POST['newpassword']!='')
{
    $newpassword=md5($_POST['newpassword']);
    $sql2="UPDATE tbllibrarians SET Password=:newpassword WHERE id=:libid";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':newpassword',$newpassword,PDO::PARAM_STR);
    $query2->bindParam(':libid',$libid,PDO::PARAM_STR);
    $query2->execute();
}

$_SESSION['msg']="Librarian updated successfully";
header('location:manage-librarians.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Edit Librarian</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet' />
</head>
<body>
<?php include('includes/header.php');?>
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Edit Librarian</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-edit"></i> Librarian Information</strong>
                    </div>
                    <div class="card-body">
<?php 
$libid=intval($_GET['libid']);
$sql = "SELECT * from tbllibrarians where id=:libid";
$query = $dbh -> prepare($sql);
$query->bindParam(':libid',$libid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>  
                        <form role="form" method="post">
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>Librarian ID (Read Only)</label>
                                    <input class="form-control" type="text" value="<?php echo htmlentities($result->LibrarianId);?>" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>Full Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="fullname" value="<?php echo htmlentities($result->FullName);?>" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Mobile Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="mobileno" value="<?php echo htmlentities($result->MobileNumber);?>" maxlength="11" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo htmlentities($result->EmailId);?>" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>New Password (Leave blank to keep current)</label>
                                    <input class="form-control" type="password" name="newpassword" />
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-check"></i> Update Librarian</button>
                            </div>
                        </form>
<?php }} ?>
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
