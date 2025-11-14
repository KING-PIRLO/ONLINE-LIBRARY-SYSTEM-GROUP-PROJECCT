<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
header('location:index.php');
}
else{

// Get next librarian ID for display
$sql = "SELECT MAX(CAST(SUBSTRING(LibrarianId, 4) AS UNSIGNED)) as maxid FROM tbllibrarians";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$nextIdPreview = $result->maxid ? $result->maxid + 1 : 1;
$nextLibrarianId = "LIB" . str_pad($nextIdPreview, 3, '0', STR_PAD_LEFT);

if(isset($_POST['add']))
{
$sql = "SELECT MAX(CAST(SUBSTRING(LibrarianId, 4) AS UNSIGNED)) as maxid FROM tbllibrarians";
$query = $dbh->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$nextId = $result->maxid ? $result->maxid + 1 : 1;
$LibrarianId = "LIB" . str_pad($nextId, 3, '0', STR_PAD_LEFT);

$fname = $_POST['fullname'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email']; 
$password = md5($_POST['password']); 
$status = 1;

$sql = "INSERT INTO tbllibrarians(LibrarianId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:LibrarianId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':LibrarianId',$LibrarianId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    $_SESSION['newlibrarian']=array('id'=>$LibrarianId, 'name'=>$fname, 'email'=>$email);
    header('location:add-librarian.php?success=1');
}
else 
{
    $_SESSION['error']="Something went wrong. Please try again";
    header('location:add-librarian.php');
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Add Librarian</title>
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
                <h4 class="header-line">Add Librarian</h4>
            </div>
        </div>
        <?php if(isset($_GET['success']) && isset($_SESSION['newlibrarian'])){?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><i class="fa fa-check-circle"></i> Librarian Added Successfully!</h4>
            <div style="margin-top:15px; padding:15px; background:#f0f9ff; border-left:4px solid #5cb85c;">
                <p style="margin:5px 0;"><strong>Librarian ID:</strong> <span style="font-size:18px; color:#2196F3;"><?php echo htmlentities($_SESSION['newlibrarian']['id']);?></span></p>
                <p style="margin:5px 0;"><strong>Name:</strong> <?php echo htmlentities($_SESSION['newlibrarian']['name']);?></p>
                <p style="margin:5px 0;"><strong>Email:</strong> <?php echo htmlentities($_SESSION['newlibrarian']['email']);?></p>
            </div>
        </div>
        <?php unset($_SESSION['newlibrarian']); } ?>
        <?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']);?><?php echo htmlentities($_SESSION['error']="");?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-user-plus"></i> Librarian Information</strong>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong><i class="fa fa-info-circle"></i> Next Librarian ID:</strong> 
                            <span style="font-size:18px; color:#2196F3; font-weight:bold;"><?php echo $nextLibrarianId; ?></span>
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
                                    <input class="form-control" type="email" name="email" required />
                                </div>
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input class="form-control" type="password" name="password" required />
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <button type="submit" name="add" class="btn btn-primary"><i class="fa fa-check"></i> Add Librarian</button>
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
    <script>
        $(document).ready(function() {
            // Initialize dropdowns
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
<?php } ?>
