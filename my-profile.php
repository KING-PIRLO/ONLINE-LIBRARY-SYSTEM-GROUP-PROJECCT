<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{    
$sid=$_SESSION['stdid'];  
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];

$sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile has been updated")</script>';
}

?>

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
    <title>Online Library Management System | My Profile</title>
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
                <h4 class="header-line">My Profile</h4>
            </div>
        </div>

        <div class="row profile-section">
            <div class="col-md-8 col-md-offset-2">
                <?php 
                $sid=$_SESSION['stdid'];
                $sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
                $query = $dbh -> prepare($sql);
                $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0) {
                    foreach($results as $result) {               
                ?>  
                
                <!-- Profile Info Card -->
                <div class="profile-info-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <div class="profile-basic-info">
                            <h3 class="profile-name"><?php echo htmlentities($result->FullName);?></h3>
                            <p class="profile-email"><?php echo htmlentities($result->EmailId);?></p>
                            <div class="profile-status">
                                <?php if($result->Status==1){?>
                                    <span class="status-badge status-active">
                                        <i class="fa fa-check-circle"></i>
                                        Active Account
                                    </span>
                                <?php } else { ?>
                                    <span class="status-badge status-blocked">
                                        <i class="fa fa-ban"></i>
                                        Blocked Account
                                    </span>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-details">
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa fa-id-card"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Student ID</span>
                                    <span class="detail-value"><?php echo htmlentities($result->StudentId);?></span>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Registration Date</span>
                                    <span class="detail-value"><?php echo htmlentities($result->RegDate);?></span>
                                </div>
                            </div>
                            
                            <?php if($result->UpdationDate!=""){?>
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Last Updated</span>
                                    <span class="detail-value"><?php echo htmlentities($result->UpdationDate);?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Card -->
                <div class="profile-edit-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fa fa-edit"></i>
                            Edit Profile
                        </h5>
                    </div>
                    
                    <div class="card-body">
                        <form name="profile" method="post" class="profile-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fa fa-user"></i>
                                            Full Name
                                        </label>
                                        <input class="form-control modern-input" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fa fa-phone"></i>
                                            Mobile Number
                                        </label>
                                        <input class="form-control modern-input" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa fa-envelope"></i>
                                    Email Address
                                </label>
                                <input class="form-control modern-input" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>" autocomplete="off" required readonly />
                                <small class="form-text">Email cannot be changed after registration</small>
                            </div>
                            
                            <button type="submit" name="update" class="btn btn-update" id="submit">
                                <i class="fa fa-save"></i>
                                Update Profile
                            </button>
                        </form>
                    </div>
                </div>
                
                <?php }} ?>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
