<?php
include('includes/config.php');

$studentid = $_POST['studentid'];
$email = $_POST['email'];
$mobileno = $_POST['mobileno'];

$sql = "SELECT * FROM tblstudents WHERE StudentId=:studentid AND EmailId=:email AND MobileNumber=:mobileno";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
$query->execute();

if($query->rowCount() > 0) {
    echo "1";
} else {
    echo "0";
}
?>
