<?php
include('includes/config.php');

try {
    $sql = "ALTER TABLE `tblissuedbookdetails` ADD `finePaymentStatus` INT(1) DEFAULT 0 AFTER `fine`";
    $dbh->exec($sql);
    
    echo "<h2>Database Updated Successfully!</h2>";
    echo "<p>Fine payment status column has been added.</p>";
    echo "<p><a href='librarianlogin.php'>Go to Librarian Login</a></p>";
    
} catch(PDOException $e) {
    if(strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<h2>Already Updated!</h2>";
        echo "<p>The fine payment status column already exists.</p>";
        echo "<p><a href='librarianlogin.php'>Go to Librarian Login</a></p>";
    } else {
        echo "<h2>Error:</h2>";
        echo "<p>" . $e->getMessage() . "</p>";
    }
}
?>
