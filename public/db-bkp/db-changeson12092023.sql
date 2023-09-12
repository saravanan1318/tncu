ALTER TABLE `tncu`.`student_params` 
ADD COLUMN `upiid` TEXT NULL DEFAULT NULL AFTER `challonfile`,
ADD COLUMN `transno` TEXT NULL DEFAULT NULL AFTER `upiid`,
ADD COLUMN `qrpaymentscreenshotfile` TEXT NULL DEFAULT NULL AFTER `transno`;
