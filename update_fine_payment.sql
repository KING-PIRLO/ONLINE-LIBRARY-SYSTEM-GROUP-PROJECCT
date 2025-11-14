-- Add fine payment status column to tblissuedbookdetails
ALTER TABLE `tblissuedbookdetails` ADD `finePaymentStatus` INT(1) DEFAULT 0 AFTER `fine`;
-- 0 = Unpaid, 1 = Paid
