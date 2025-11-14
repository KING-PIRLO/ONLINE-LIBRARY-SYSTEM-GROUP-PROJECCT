-- Add librarians table
CREATE TABLE IF NOT EXISTS `tbllibrarians` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Add unique constraint to student email if not exists
ALTER TABLE `tblstudents` ADD UNIQUE KEY `EmailId` (`EmailId`);
