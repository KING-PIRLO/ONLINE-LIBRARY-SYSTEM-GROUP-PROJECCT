<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "DELETE FROM tbllibrarians WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$_SESSION['delmsg']="Librarian deleted successfully";
header('location:manage-librarians.php');
}
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "UPDATE tbllibrarians SET Status=:status WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
header('location:manage-librarians.php');
}
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "UPDATE tbllibrarians SET Status=:status WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
header('location:manage-librarians.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Manage Librarians</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />
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
                <h4 class="header-line">Manage Librarians</h4>
            </div>
        </div>
        <?php if($_SESSION['delmsg']!=""){?>
        <div class="alert alert-success">
            <strong>Success:</strong> <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
        </div>
        <?php } ?>
        <?php if($_SESSION['msg']!=""){?>
        <div class="alert alert-success">
            <strong>Success:</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
        </div>
        <?php } ?>
        <?php if($_SESSION['error']!=""){?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']);?><?php echo htmlentities($_SESSION['error']="");?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-users"></i> Librarians List</strong>
                        <a href="add-librarian.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add Librarian</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Librarian ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th>Reg Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
$sql = "SELECT * FROM tbllibrarians";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                    <tr class="odd gradeX">
                                        <td class="center"><?php echo htmlentities($cnt);?></td>
                                        <td class="center"><?php echo htmlentities($result->LibrarianId);?></td>
                                        <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                        <td class="center"><?php echo htmlentities($result->EmailId);?></td>
                                        <td class="center"><?php echo htmlentities($result->MobileNumber);?></td>
                                        <td class="center"><?php if($result->Status==1)
                                        {
                                            echo htmlentities("Active");
                                        } else {
                                            echo htmlentities("Blocked");
                                        }
                                        ?></td>
                                        <td class="center"><?php echo htmlentities($result->RegDate);?></td>
                                        <td class="center">
<a href="edit-librarian.php?libid=<?php echo htmlentities($result->id);?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
<?php if($result->Status==1)
{?>
<a href="manage-librarians.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to block this librarian?');"  class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Block</a>
<?php } else {?>
<a href="manage-librarians.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to activate this librarian?');"  class="btn btn-success btn-xs"><i class="fa fa-check"></i> Activate</a>
<?php } ?>
<a href="manage-librarians.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
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
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>
</html>
<?php } ?>
