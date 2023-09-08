ALTER TABLE `tncu`.`student_params` 
ADD COLUMN `nationality` TEXT NULL DEFAULT NULL AFTER `parent`,
ADD COLUMN `slcertificateno` TEXT NULL DEFAULT NULL AFTER `slnameinst`,
ADD COLUMN `hscertificateno` TEXT NULL DEFAULT NULL AFTER `hsnameinst`,
ADD COLUMN `ugcertificateno` TEXT NULL DEFAULT NULL AFTER `ugnameinst`,
ADD COLUMN `bgcertificateno` TEXT NULL DEFAULT NULL AFTER `bgnameinst`;
