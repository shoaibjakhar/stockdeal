CREATE TABLE `staff` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`beneficiary_name` VARCHAR(255) NULL DEFAULT NULL,
	`mobile` VARCHAR(255) NULL DEFAULT NULL,
	`email` VARCHAR(255) NULL DEFAULT NULL,
	`category` VARCHAR(255) NULL DEFAULT NULL,
	`address` VARCHAR(255) NULL DEFAULT NULL,
	`bank_name` VARCHAR(255) NULL DEFAULT NULL,
	`account_no` VARCHAR(255) NULL DEFAULT NULL,
	`ifsc_code` VARCHAR(255) NULL DEFAULT NULL,
	`amount` INT(11) NULL DEFAULT NULL,
	`remarks` TEXT NULL DEFAULT NULL,
	`status` ENUM('Active','InActive') NOT NULL DEFAULT 'Active',
	`created_by` INT(11) NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;


CREATE TABLE `vendors_expenses` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`beneficiary_name` VARCHAR(255) NULL DEFAULT NULL,
	`mobile` VARCHAR(255) NULL DEFAULT NULL,
	`email` VARCHAR(255) NULL DEFAULT NULL,
	`category` VARCHAR(255) NULL DEFAULT NULL,
	`address` VARCHAR(255) NULL DEFAULT NULL,
	`bank_name` VARCHAR(255) NULL DEFAULT NULL,
	`account_no` VARCHAR(255) NULL DEFAULT NULL,
	`ifsc_code` VARCHAR(255) NULL DEFAULT NULL,
	`amount` INT(11) NULL DEFAULT NULL,
	`remarks` TEXT NULL DEFAULT NULL,
	`status` ENUM('Active','InActive') NOT NULL DEFAULT 'Active',
	`created_by` INT(11) NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;




CREATE TABLE `incentives_definitions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50) NULL DEFAULT NULL,
	`value_from` INT(11) NOT NULL,
	`value_to` INT(11) NOT NULL,
	`incentive_amount` INT(11) NOT NULL,
	`start_date` DATETIME NULL DEFAULT NULL,
	`end_date` DATETIME NULL DEFAULT NULL,
	`status` ENUM('Y','N') NOT NULL DEFAULT 'Y',
	`created_by` INT(11) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;

INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (1, 'std1', 100000, 124999, 8000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (2, 'std1', 125000, 149000, 10000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (3, 'std1', 150000, 174999, 12000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (4, 'std1', 175000, 199999, 15000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (5, 'std1', 200000, 224999, 18000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (6, 'std1', 225000, 249999, 21000, '2023-05-03 21:14:03', NULL, 'Y', 1, '2023-05-03 21:14:03', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (7, 'std1', 250000, 274999, 24000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (8, 'std1', 275000, 299999, 27000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (9, 'std1', 300000, 324999, 30000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (10, 'std1', 325000, 349999, 34000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (11, 'std1', 350000, 374999, 38000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (12, 'std1', 375000, 399999, 42000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (13, 'std1', 400000, 424999, 46000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (14, 'std1', 425000, 449999, 50000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (15, 'std1', 450000, 474999, 54000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (16, 'std1', 475000, 499999, 58000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (17, 'std1', 500000, 524999, 62000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (18, 'std1', 525000, 549999, 67000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (19, 'std1', 550000, 574999, 72000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (20, 'std1', 575000, 599999, 77000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (21, 'std1', 600000, 624999, 82000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (22, 'std1', 625000, 649999, 87000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (23, 'std1', 650000, 674999, 92000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (24, 'std1', 675000, 699999, 97000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (25, 'std1', 700000, 724999, 102000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (26, 'std1', 725000, 749999, 107000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (27, 'std1', 750000, 774999, 112000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (28, 'std1', 775000, 799999, 117000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (29, 'std1', 800000, 824999, 122000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (30, 'std1', 825000, 849999, 127000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (31, 'std1', 850000, 874999, 132000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (32, 'std1', 875000, 899999, 137000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (33, 'std1', 900000, 924999, 142000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (34, 'std1', 925000, 949999, 147000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (35, 'std1', 950000, 974999, 152000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (36, 'std1', 975000, 999999, 157000, '2023-05-03 21:14:04', NULL, 'Y', 1, '2023-05-03 21:14:04', NULL);
INSERT INTO `incentives_definitions` (`id`, `title`, `value_from`, `value_to`, `incentive_amount`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES (37, 'std1', 1000000, 1000000000, 162000, '2023-05-03 21:14:05', NULL, 'Y', 1, '2023-05-03 21:14:05', '2023-05-03 21:14:25');
