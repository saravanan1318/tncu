ALTER TABLE `tncu`.`users` 
ADD COLUMN `forcePasswordChange` INT(11) NOT NULL DEFAULT 0 AFTER `remember_token`;
