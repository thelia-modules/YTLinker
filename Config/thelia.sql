
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- ytlinker
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ytlinker`;

CREATE TABLE `ytlinker`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `position` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ytlinker_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ytlinker_i18n`;

CREATE TABLE `ytlinker_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `link` TEXT NOT NULL,
    `description` LONGTEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `ytlinker_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `ytlinker` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ytlinker_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ytlinker_version`;

CREATE TABLE `ytlinker_version`
(
    `id` INTEGER NOT NULL,
    `position` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `ytlinker_version_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `ytlinker` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
