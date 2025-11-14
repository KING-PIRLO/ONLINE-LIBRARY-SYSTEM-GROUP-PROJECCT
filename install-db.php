<?php
include('includes/config.php');

try {
    // Create librarians table
    $sql = "CREATE TABLE IF NOT EXISTS `tbllibrarians` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `LibrarianId` varchar(100) DEFAULT NULL,
      `FullName` varchar(120) DEFAULT NULL,
      `EmailId` varchar(120) DEFAULT NULL,
      `MobileNumber` char(11) DEFAULT NULL,
      `Password` varchar(120) DEFAULT NULL,
      `Status` int(1) DEFAULT 1,
      `RegDate` timestamp NULL DEFAULT current_timestamp(),
      `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `LibrarianId` (`LibrarianId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";
    
    $dbh->exec($sql);
    
    echo "<h2>Database Updated Successfully!</h2>";
    echo "<p>The librarians table has been created.</p>";
    echo "<p><a href='adminlogin.php'>Go to Admin Login</a></p>";
    
} catch(PDOException $e) {
    echo "<h2>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
