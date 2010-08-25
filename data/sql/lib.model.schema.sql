
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- mb_mail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mb_mail`;


CREATE TABLE `mb_mail`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255),
	`body_html` TEXT,
	`body_text` TEXT,
	`created_at` DATETIME,
	`subject` VARCHAR(255),
	`strfrom` VARCHAR(255),
	`reply_to` VARCHAR(255),
	`notify_to` VARCHAR(255),
	`platform` VARCHAR(50),
	`public_path` VARCHAR(255),
	`batch_size` TINYINT default 10,
	`state` VARCHAR(50),
	`error` VARCHAR(255),
	`token` VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- mb_mailto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mb_mailto`;


CREATE TABLE `mb_mailto`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mail_id` INTEGER,
	`mailto` VARCHAR(255),
	`state` VARCHAR(50),
	`created_at` DATETIME,
	`sent_at` DATETIME,
	`tries` TINYINT,
	`error` TEXT,
	PRIMARY KEY (`id`),
	INDEX `mb_mailto_FI_1` (`mail_id`),
	CONSTRAINT `mb_mailto_FK_1`
		FOREIGN KEY (`mail_id`)
		REFERENCES `mb_mail` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- mb_mail_attachment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mb_mail_attachment`;


CREATE TABLE `mb_mail_attachment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mail_id` INTEGER,
	`url` VARCHAR(255),
	`type` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `mb_mail_attachment_FI_1` (`mail_id`),
	CONSTRAINT `mb_mail_attachment_FK_1`
		FOREIGN KEY (`mail_id`)
		REFERENCES `mb_mail` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- log_mail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_mail`;


CREATE TABLE `log_mail`
(
	`id` INTEGER  NOT NULL,
	`username` VARCHAR(255),
	`body_html` TEXT,
	`body_text` TEXT,
	`created_at` DATETIME,
	`subject` VARCHAR(255),
	`strfrom` VARCHAR(255),
	`reply_to` VARCHAR(255),
	`notify_to` VARCHAR(255),
	`platform` VARCHAR(50),
	`public_path` VARCHAR(255),
	`batch_size` TINYINT default 10,
	`state` VARCHAR(50),
	`error` VARCHAR(255),
	`token` VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- log_mailto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_mailto`;


CREATE TABLE `log_mailto`
(
	`id` INTEGER  NOT NULL,
	`mail_id` INTEGER,
	`mailto` VARCHAR(255),
	`state` VARCHAR(50),
	`created_at` DATETIME,
	`sent_at` DATETIME,
	`tries` TINYINT,
	`error` TEXT,
	PRIMARY KEY (`id`),
	INDEX `log_mailto_FI_1` (`mail_id`),
	CONSTRAINT `log_mailto_FK_1`
		FOREIGN KEY (`mail_id`)
		REFERENCES `log_mail` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- log_mail_attachment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_mail_attachment`;


CREATE TABLE `log_mail_attachment`
(
	`id` INTEGER  NOT NULL,
	`mail_id` INTEGER,
	`url` VARCHAR(255),
	`type` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `log_mail_attachment_FI_1` (`mail_id`),
	CONSTRAINT `log_mail_attachment_FK_1`
		FOREIGN KEY (`mail_id`)
		REFERENCES `log_mail` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- cuenta
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cuenta`;


CREATE TABLE `cuenta`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100)  NOT NULL,
	`credential` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log`;


CREATE TABLE `log`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cuenta_id` INTEGER,
	`what` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `log_FI_1` (`cuenta_id`),
	CONSTRAINT `log_FK_1`
		FOREIGN KEY (`cuenta_id`)
		REFERENCES `cuenta` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
