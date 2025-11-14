<?php
// Database installer for password reset requests table
include('includes/config.php');

try {
    // Create password reset requests table
    $sql = "CREATE TABLE IF NOT EXISTS `tblpasswordreset` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `StudentId` varchar(100) DEFAULT NULL,
      `EmailId` varchar(120) DEFAULT NULL,
      `MobileNumber` char(11) DEFAULT NULL,
      `Message` text DEFAULT NULL,
      `Status` int(1) DEFAULT 0 COMMENT '0=Pending, 1=Resolved',
      `RequestDate` timestamp NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";
    
    $dbh->exec($sql);
    
    echo "<h2>Installation Successful!</h2>";
    echo "<p>Password reset requests table has been created successfully.</p>";
    echo "<p><a href='admin/password-reset-requests.php'>Go to Admin Panel</a></p>";
    
} catch(PDOException $e) {
    echo "<h2>Installation Failed!</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
