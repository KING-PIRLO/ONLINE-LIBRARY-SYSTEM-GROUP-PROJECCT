<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{

// Mark as resolved
if(isset($_GET['resolve']))
{
$id = $_GET['resolve'];
$sql = "UPDATE tblpasswordreset SET Status=1 WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Request marked as resolved";
header('location:password-reset-requests.php');
}

// Delete request
if(isset($_GET['del']))
{
$id = $_GET['del'];
$sql = "DELETE FROM tblpasswordreset WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$_SESSION['delmsg']="Request deleted successfully";
header('location:password-reset-requests.php');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Password Reset Requests</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <h4 class="header-line">Password Reset Requests</h4>
            </div>
        </div>
        <?php if($_SESSION['msg']){?>
        <div class="alert alert-success">
            <strong>Success:</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
        </div>
        <?php } ?>
        <?php if($_SESSION['delmsg']){?>
        <div class="alert alert-danger">
            <strong>Success:</strong> <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-list"></i> Password Reset Requests</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Message</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
$sql = "SELECT pr.*, s.FullName, s.id as student_db_id FROM tblpasswordreset pr 
        LEFT JOIN tblstudents s ON pr.StudentId = s.StudentId 
        ORDER BY pr.RequestDate DESC";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>                                      
                                    <tr class="odd gradeX">
                                        <td class="center"><?php echo htmlentities($cnt);?></td>
                                        <td class="center"><?php echo htmlentities($result->StudentId);?></td>
                                        <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                        <td class="center"><?php echo htmlentities($result->EmailId);?></td>
                                        <td class="center"><?php echo htmlentities($result->MobileNumber);?></td>
                                        <td><?php echo htmlentities($result->Message);?></td>
                                        <td class="center"><?php echo htmlentities(date('d-m-Y H:i', strtotime($result->RequestDate)));?></td>
                                        <td class="center">
                                            <?php if($result->Status == 0) { ?>
                                                <span class="badge badge-warning" style="background:#f0ad4e;">Pending</span>
                                            <?php } else { ?>
                                                <span class="badge badge-success" style="background:#5cb85c;">Resolved</span>
                                            <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php if($result->Status == 0) { ?>
                                                <a href="edit-student.php?stid=<?php echo htmlentities($result->student_db_id);?>" class="btn btn-primary btn-xs">
                                                    <i class="fa fa-edit"></i> Reset Password
                                                </a>
                                                <a href="password-reset-requests.php?resolve=<?php echo htmlentities($result->id);?>" onclick="return confirm('Mark this request as resolved?');" class="btn btn-success btn-xs">
                                                    <i class="fa fa-check"></i> Resolve
                                                </a>
                                            <?php } ?>
                                            <a href="password-reset-requests.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
<?php $cnt=$cnt+1;}} ?>                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
