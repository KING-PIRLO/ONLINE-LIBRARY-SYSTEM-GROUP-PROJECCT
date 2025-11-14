<?php
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['submit']))
{
try {
    $email = $_POST['email'];
    $studentid = $_POST['studentid'];
    $mobileno = $_POST['mobileno'];
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Verify student exists
    $sql = "SELECT * FROM tblstudents WHERE EmailId=:email AND StudentId=:studentid AND MobileNumber=:mobileno";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() > 0)
    {
        // Insert password reset request
        $sql = "INSERT INTO tblpasswordreset(StudentId, EmailId, MobileNumber, Message, Status) VALUES(:studentid, :email, :mobileno, :message, 0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->execute();
        
        $_SESSION['msg'] = "Your password reset request has been submitted successfully. Admin will contact you soon.";
        header('location:user-forgot-password.php?success=1');
        exit();
    }
    else
    {
        $_SESSION['error'] = "Invalid details. Please check your Student ID, Email, and Mobile Number.";
        header('location:user-forgot-password.php');
        exit();
    }
} catch(Exception $e) {
    $_SESSION['error'] = "Error: Please make sure you have run the database installer first. <a href='install-password-reset.php'>Click here to install</a>";
    header('location:user-forgot-password.php');
    exit();
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Forgot Password</title>
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
                <h4 class="header-line">Forgot Password</h4>
            </div>
        </div>

        <?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-danger">
                        <strong>Error:</strong> <?php echo $_SESSION['error']; $_SESSION['error']=""; ?>
                    </div>
                </div>
            </div>
        <?php } else if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success">
                        <strong>Success:</strong> <?php echo htmlentities($_SESSION['msg']); $_SESSION['msg']=""; ?>
                    </div>
                </div>
            </div>
        <?php }?>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="admin-card">
                    <div class="card-header">
                        <strong><i class="fa fa-key"></i> Password Reset Request</strong>
                    </div>
                    <div class="card-body">
                        <p style="margin-bottom:20px;">Please fill in your details below. Admin will review your request and contact you.</p>
                        <form role="form" method="post" id="forgotPasswordForm">
                            <div class="form-group">
                                <label>Student ID<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="studentid" id="studentid" required placeholder="e.g., SID001" />
                            </div>

                            <div class="form-group">
                                <label>Email<span style="color:red;">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" required placeholder="your.email@example.com" />
                            </div>

                            <div class="form-group">
                                <label>Mobile Number<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="mobileno" id="mobileno" maxlength="11" required placeholder="Enter your mobile number" />
                                <span id="validation-status" style="font-size:12px; margin-top:5px; display:block;"></span>
                            </div>

                            <div class="form-group">
                                <label>Message (Optional)</label>
                                <textarea class="form-control" name="message" rows="3" placeholder="Any additional information..."></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary" id="submitBtn" disabled>
                                Submit Request
                            </button>
                            <a href="index.php" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Back to Login
                            </a>
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
function validateDetails() {
    var studentid = $('#studentid').val();
    var email = $('#email').val();
    var mobileno = $('#mobileno').val();
    
    if(studentid && email && mobileno) {
        $.ajax({
            url: "validate-student-details.php",
            data: {studentid: studentid, email: email, mobileno: mobileno},
            type: "POST",
            success: function(data) {
                if(data == 1) {
                    $('#validation-status').html('<span style="color:green;"><i class="fa fa-check"></i> Details verified</span>');
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#validation-status').html('<span style="color:red;"><i class="fa fa-times"></i> Details do not match our records</span>');
                    $('#submitBtn').prop('disabled', true);
                }
            }
        });
    }
}

$('#studentid, #email, #mobileno').on('blur', function() {
    validateDetails();
});
</script>
</body>
</html>
