DROP TABLE appointments;

CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned DEFAULT NULL,
  `doctor_id` int(10) unsigned DEFAULT NULL,
  `clinic_id` int(10) unsigned DEFAULT NULL,
  `appointment_number` varchar(191) DEFAULT NULL,
  `appointment_type` varchar(191) DEFAULT NULL,
  `appointment_status` varchar(191) NOT NULL DEFAULT 'pending',
  `appointment_reason` varchar(191) DEFAULT NULL,
  `appointment_note` varchar(191) DEFAULT NULL,
  `appointment_time` varchar(191) DEFAULT NULL,
  `appointment_date` varchar(191) DEFAULT NULL,
  `appointment_duration` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attended_at` timestamp NULL DEFAULT NULL,
  `patient_package_id` bigint(20) unsigned DEFAULT NULL,
  `review` tinyint(1) DEFAULT NULL,
  `appointment_id` bigint(20) unsigned DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_patient_package_id_foreign` (`patient_package_id`),
  KEY `appointments_appointment_id_foreign` (`appointment_id`),
  CONSTRAINT `appointments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `appointments_patient_package_id_foreign` FOREIGN KEY (`patient_package_id`) REFERENCES `patient_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO appointments VALUES("1","1","1","3","1","BYHFrl7oUd","","transferred","","","13:18","2023-07-06","morning","2023-07-06 13:18:01","2023-07-06 13:23:28","2023-07-06 13:23:28","","","","");
INSERT INTO appointments VALUES("2","1","1","3","1","Rd7S160O9D","","transferred","","","13:28","2023-07-06","morning","2023-07-06 13:28:10","2023-07-08 09:53:00","2023-07-08 09:53:00","","","","");
INSERT INTO appointments VALUES("3","1","1","3","1","rAgS0LZBfV","","transferred","","","10:37","2023-07-08","morning","2023-07-08 10:37:46","2023-07-08 11:20:17","2023-07-08 11:20:17","","","","");
INSERT INTO appointments VALUES("4","1","1","3","1","34g59pv6lA","","transferred","","","11:20","2023-07-08","morning","2023-07-08 11:20:55","2023-07-12 13:52:09","2023-07-12 13:52:09","","","","");
INSERT INTO appointments VALUES("5","1","1","3","1","SPoqP0poZP","","transferred","","","13:51","2023-07-12","morning","2023-07-12 13:51:36","2023-07-12 14:05:21","2023-07-12 14:05:21","","","","");
INSERT INTO appointments VALUES("6","1","1","3","1","jKaklMOsGK","","transferred","","","14:06","2023-07-12","morning","2023-07-12 14:06:07","2023-07-12 14:06:15","2023-07-12 14:06:15","","","","");
INSERT INTO appointments VALUES("7","1","1","3","1","c8cmMXo0Vy","","transferred","","","14:11","2023-07-12","morning","2023-07-12 14:11:17","2023-07-12 14:11:24","2023-07-12 14:11:24","","","","");



DROP TABLE categories;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_foreign` (`parent`),
  CONSTRAINT `categories_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE cities;

CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cities VALUES("1","الرياض","2023-07-06 13:07:51","2023-07-06 13:07:51");



DROP TABLE countries;

CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO countries VALUES("1","سعودي","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO countries VALUES("2","غير سعودي","2023-07-06 13:07:51","2023-07-06 13:07:51");



DROP TABLE departments;

CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `parent` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transferstatus` tinyint(1) NOT NULL DEFAULT 0,
  `appointmentstatus` tinyint(1) NOT NULL DEFAULT 0,
  `is_lab` tinyint(1) DEFAULT NULL,
  `is_scan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_parent_foreign` (`parent`),
  CONSTRAINT `departments_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO departments VALUES("1","أسنان","","2023-07-06 13:07:51","2023-07-06 13:17:49","1","1","","");
INSERT INTO departments VALUES("2","مختبر","","2023-07-06 13:07:51","2023-07-06 13:07:51","0","0","","");
INSERT INTO departments VALUES("3","أشعة","","2023-07-06 13:07:51","2023-07-06 13:07:51","0","0","","");



DROP TABLE diagnoses;

CREATE TABLE `diagnoses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` bigint(20) unsigned NOT NULL,
  `patient_id` bigint(20) unsigned NOT NULL,
  `dr_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `treatment` text NOT NULL,
  `taken` text NOT NULL,
  `tooth` varchar(191) DEFAULT NULL,
  `time` varchar(191) NOT NULL,
  `day` varchar(191) NOT NULL,
  `period` enum('morning','evening') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` varchar(191) DEFAULT NULL,
  `complaint` text DEFAULT NULL,
  `clinical_examination` text DEFAULT NULL,
  `chief_complain` text DEFAULT NULL,
  `sign_and_symptom` text DEFAULT NULL,
  `other` text DEFAULT NULL,
  `patient_package_id` bigint(20) unsigned DEFAULT NULL,
  `session_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diagnoses_appointment_id_foreign` (`appointment_id`),
  KEY `diagnoses_patient_id_foreign` (`patient_id`),
  KEY `diagnoses_dr_id_foreign` (`dr_id`),
  KEY `diagnoses_department_id_foreign` (`department_id`),
  KEY `diagnoses_patient_package_id_foreign` (`patient_package_id`),
  CONSTRAINT `diagnoses_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `diagnoses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `diagnoses_dr_id_foreign` FOREIGN KEY (`dr_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `diagnoses_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `diagnoses_patient_package_id_foreign` FOREIGN KEY (`patient_package_id`) REFERENCES `patient_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO diagnoses VALUES("1","1","1","3","1","شسيشسي","شسشس","[]","13:23","2023-07-06","morning","2023-07-06 13:23:28","2023-07-06 13:23:28","[]","","","ئءؤئءؤ","ئءؤئءؤ","شسشسشس","","");
INSERT INTO diagnoses VALUES("2","2","1","3","1","شسيشسي","شسيشسي","[]","09:53","2023-07-08","morning","2023-07-08 09:53:00","2023-07-08 09:53:00","[]","","","شسيشسي","شسيشسيشسي","شسيشسي","","");
INSERT INTO diagnoses VALUES("3","3","1","3","1","sasdasdasd","ssasa","[]","11:20","2023-07-08","morning","2023-07-08 11:20:17","2023-07-08 11:28:08","[]","","","sdddddddsdsdsdsd","sdsdsdsdsdsdsdsdsdasasas","asdasd","1","1");
INSERT INTO diagnoses VALUES("4","4","1","3","1","asdasdsa","asdasd","[]","13:52","2023-07-12","morning","2023-07-12 13:52:09","2023-07-12 13:52:09","[]","","","adfasd","asdasdasd","asdasdasd","","");
INSERT INTO diagnoses VALUES("5","5","1","3","1","asas","asas","[]","14:05","2023-07-12","morning","2023-07-12 14:05:21","2023-07-12 14:05:21","[]","","","asasas","","","","");
INSERT INTO diagnoses VALUES("6","6","1","3","1","sdfsdf","sdfsdf","[]","14:06","2023-07-12","morning","2023-07-12 14:06:15","2023-07-12 14:06:15","[]","","","sdfsdf","","","","");
INSERT INTO diagnoses VALUES("7","7","1","3","1","asdasd","asd","[]","14:11","2023-07-12","morning","2023-07-12 14:11:24","2023-07-12 14:11:24","[]","","","asdasd","","","","");



DROP TABLE discounts;

CREATE TABLE `discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discounts_user_id_foreign` (`user_id`),
  CONSTRAINT `discounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE expenses;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `last_update` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_category_id_foreign` (`category_id`),
  KEY `expenses_employee_id_foreign` (`employee_id`),
  KEY `expenses_last_update_foreign` (`last_update`),
  CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_last_update_foreign` FOREIGN KEY (`last_update`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE forms;

CREATE TABLE `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `file` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE increases;

CREATE TABLE `increases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `increases_user_id_foreign` (`user_id`),
  CONSTRAINT `increases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE insurances;

CREATE TABLE `insurances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE invoice_bonds;

CREATE TABLE `invoice_bonds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rest` double DEFAULT 0,
  `status` varchar(191) DEFAULT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_bonds_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_bonds_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE invoice_items;

CREATE TABLE `invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `quantity` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department` varchar(191) NOT NULL,
  `tax` double(10,2) NOT NULL DEFAULT 0.00,
  `offer_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `is_lab` tinyint(1) DEFAULT NULL,
  `is_scan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_offer_id_foreign` (`offer_id`),
  CONSTRAINT `invoice_items_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE invoices;

CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned DEFAULT NULL,
  `total` double NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `tax` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `dr_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `cash` double(10,2) NOT NULL DEFAULT 0.00,
  `card` double(10,2) NOT NULL DEFAULT 0.00,
  `bank` double DEFAULT 0,
  `mastercard` double DEFAULT 0,
  `visa` double DEFAULT 0,
  `rest` double(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `offers_discount` double(10,2) DEFAULT 0.00,
  `installment_company` tinyint(1) DEFAULT 0,
  `installment_company_tax` double DEFAULT NULL,
  `installment_company_max_amount_tax` double DEFAULT NULL,
  `installment_company_min_amount_tax` double DEFAULT NULL,
  `installment_company_rest` double DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `is_entered` tinyint(1) DEFAULT 1,
  `tab` tinyint(1) DEFAULT 0,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_dr_id_foreign` (`dr_id`),
  KEY `invoices_department_id_foreign` (`department_id`),
  KEY `invoices_package_id_foreign` (`package_id`),
  CONSTRAINT `invoices_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `invoices_dr_id_foreign` FOREIGN KEY (`dr_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `invoices_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO invoices VALUES("1","1","1","3","575","0","75","2023-07-06 13:26:42","2023-07-06 13:26:42","Paid","3","1","500","0","0","0","0","0","575","","0","0","","","","","","","1","0","");
INSERT INTO invoices VALUES("2","2","1","1","500","0","0","2023-07-08 09:53:07","2023-07-08 10:18:52","Paid","3","1","500","0","500","0","0","0","0","","0","0","","","","","package","1","1","0","2023-07-08");
INSERT INTO invoices VALUES("3","3","1","3","500","0","0","2023-07-12 14:11:29","2023-07-12 14:11:29","Unpaid","3","1","500","0","0","0","0","0","500","","0","0","","","","","package","1","1","0","2023-07-12");



DROP TABLE lab_categories;

CREATE TABLE `lab_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE lab_requests;

CREATE TABLE `lab_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint(20) unsigned DEFAULT NULL,
  `patient_id` bigint(20) unsigned NOT NULL,
  `clinic_id` bigint(20) unsigned DEFAULT NULL,
  `appointment_id` bigint(20) unsigned DEFAULT NULL,
  `dr_content` text DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `lab_content` text DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `delivered_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lab_requests_doctor_id_foreign` (`doctor_id`),
  KEY `lab_requests_patient_id_foreign` (`patient_id`),
  KEY `lab_requests_clinic_id_foreign` (`clinic_id`),
  KEY `lab_requests_appointment_id_foreign` (`appointment_id`),
  KEY `lab_requests_product_id_foreign` (`product_id`),
  CONSTRAINT `lab_requests_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lab_requests_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lab_requests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lab_requests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lab_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE labs;

CREATE TABLE `labs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("2","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("3","2019_12_14_000001_create_personal_access_tokens_table","1");
INSERT INTO migrations VALUES("4","2022_04_10_000002_create_settings_table","1");
INSERT INTO migrations VALUES("5","2022_04_11_140930_create_departments_table","1");
INSERT INTO migrations VALUES("6","2022_04_11_140931_create_users_table","1");
INSERT INTO migrations VALUES("7","2022_05_23_142732_create_notifications_table","1");
INSERT INTO migrations VALUES("8","2022_06_22_171551_create_permission_tables","1");
INSERT INTO migrations VALUES("9","2022_07_26_155002_create_categories_table","1");
INSERT INTO migrations VALUES("10","2022_07_26_155021_create_products_table","1");
INSERT INTO migrations VALUES("11","2022_07_26_155039_create_invoices_table","1");
INSERT INTO migrations VALUES("12","2022_07_26_155049_create_invoice_items_table","1");
INSERT INTO migrations VALUES("13","2022_07_26_155659_create_patient_files_table","1");
INSERT INTO migrations VALUES("14","2022_07_26_155743_create_appointments_table","1");
INSERT INTO migrations VALUES("15","2022_07_27_085356_create_relationships_table","1");
INSERT INTO migrations VALUES("16","2022_07_27_093508_create_countries_table","1");
INSERT INTO migrations VALUES("17","2022_07_27_093730_create_cities_table","1");
INSERT INTO migrations VALUES("18","2022_07_27_093731_create_patients_table","1");
INSERT INTO migrations VALUES("19","2022_07_27_093732_create_patient_conditions_table","1");
INSERT INTO migrations VALUES("20","2022_07_28_062816_create_forms_table","1");
INSERT INTO migrations VALUES("21","2022_07_28_085810_create_diagnoses_table","1");
INSERT INTO migrations VALUES("22","2022_07_30_071231_add_department_id_to_products_table","1");
INSERT INTO migrations VALUES("23","2022_07_30_100613_add_status_to_invoices_table","1");
INSERT INTO migrations VALUES("24","2022_07_30_135110_delete_add_status_to_invoices_table","1");
INSERT INTO migrations VALUES("25","2022_07_31_060132_create_offers_table","1");
INSERT INTO migrations VALUES("26","2022_07_31_065815_create_discounts_table","1");
INSERT INTO migrations VALUES("27","2022_07_31_082548_create_insurances_table","1");
INSERT INTO migrations VALUES("28","2022_07_31_083515_add_insurance_id_to_patients_table","1");
INSERT INTO migrations VALUES("29","2022_07_31_091051_delete_slug_from_categories_table","1");
INSERT INTO migrations VALUES("30","2022_07_31_091052_create_expenses_table","1");
INSERT INTO migrations VALUES("31","2022_07_31_120946_create_purchases_table","1");
INSERT INTO migrations VALUES("32","2022_08_01_073755_add_columns_to_invoices_table","1");
INSERT INTO migrations VALUES("33","2022_08_01_085943_add_department_to_invoice_items_table","1");
INSERT INTO migrations VALUES("34","2022_08_02_084446_add_offer_id_to_invoice_items_table","1");
INSERT INTO migrations VALUES("35","2022_08_06_085056_add_visitor_to_patients_table","1");
INSERT INTO migrations VALUES("36","2022_08_06_100537_add_delete_transfer_to_settings_table","1");
INSERT INTO migrations VALUES("37","2022_08_10_170934_add_offers_discount_to_invoices_table","1");
INSERT INTO migrations VALUES("38","2022_08_13_055205_add_photo_to_users","1");
INSERT INTO migrations VALUES("39","2022_08_16_182215_create_scan_services_table","1");
INSERT INTO migrations VALUES("40","2022_08_16_182216_create_scan_requests_table","1");
INSERT INTO migrations VALUES("41","2022_08_16_195138_create_labs_table","1");
INSERT INTO migrations VALUES("42","2022_08_17_093633_create_lab_categories_table","1");
INSERT INTO migrations VALUES("43","2022_08_17_093634_create_services_table","1");
INSERT INTO migrations VALUES("44","2022_08_17_133835_make_all_columns_null_in_appointments_table","1");
INSERT INTO migrations VALUES("45","2022_08_17_170410_add_is_pregnant_to_patients_table","1");
INSERT INTO migrations VALUES("46","2022_08_18_070842_add_service_id_to_scan_requests","1");
INSERT INTO migrations VALUES("47","2022_08_18_115317_create_lab_requests_table","1");
INSERT INTO migrations VALUES("48","2022_08_18_123543_change_type_in_users","1");
INSERT INTO migrations VALUES("49","2022_08_18_140508_add_columns_to_scan_requests","1");
INSERT INTO migrations VALUES("50","2022_08_18_171637_add_tax_value_to_purchases","1");
INSERT INTO migrations VALUES("51","2022_08_22_123357_add_capital_to_settings","1");
INSERT INTO migrations VALUES("52","2022_08_27_144639_add_transfer_status_departments_table","1");
INSERT INTO migrations VALUES("53","2022_08_28_231508_add_appointment_status_departments_table","1");
INSERT INTO migrations VALUES("54","2022_08_30_094407_add_user_id_to_notifications","1");
INSERT INTO migrations VALUES("55","2022_09_03_174003_show_department_products_to_users","1");
INSERT INTO migrations VALUES("56","2022_09_06_103532_add_columns_to_departments_table","1");
INSERT INTO migrations VALUES("57","2022_09_06_110747_delete_columns_from_lab_requests_table","1");
INSERT INTO migrations VALUES("58","2022_09_06_112018_delete_columns_from_scan_requests_table","1");
INSERT INTO migrations VALUES("59","2022_09_06_121230_add_columns_to_lab_invoice_items_table","1");
INSERT INTO migrations VALUES("60","2022_09_07_111136_add_is_dentist_to_users","1");
INSERT INTO migrations VALUES("61","2022_09_24_164949_add_is_dermatologist_to_users","1");
INSERT INTO migrations VALUES("62","2022_09_24_173853_add_body_to_diagnoses","1");
INSERT INTO migrations VALUES("63","2022_10_04_145131_add_new_invoice_form_to_settings","1");
INSERT INTO migrations VALUES("64","2022_10_08_121028_add_complaint_to_diagnoses","1");
INSERT INTO migrations VALUES("65","2022_10_08_122723_add_complaint_to_settings","1");
INSERT INTO migrations VALUES("66","2022_10_24_131852_add_installment_companies_to_settings","1");
INSERT INTO migrations VALUES("67","2022_10_24_132857_add_installment_company_to_invoices","1");
INSERT INTO migrations VALUES("68","2022_11_12_200926_add_attended_at_to_appointments_table","1");
INSERT INTO migrations VALUES("69","2022_11_12_203744_create_invoice_bonds_table","1");
INSERT INTO migrations VALUES("70","2022_11_16_140631_add_columns_to_bonds","1");
INSERT INTO migrations VALUES("71","2022_12_12_143425_add_payment_method_to_bonds_table","1");
INSERT INTO migrations VALUES("72","2022_12_26_144136_add_bank_to_invoices_table","1");
INSERT INTO migrations VALUES("73","2023_01_07_131825_create_increases_table","1");
INSERT INTO migrations VALUES("74","2023_02_09_163520_create_overtimes_table","1");
INSERT INTO migrations VALUES("75","2023_02_19_054815_create_packages_table","1");
INSERT INTO migrations VALUES("76","2023_02_19_055354_create_package_items_table","1");
INSERT INTO migrations VALUES("77","2023_02_21_113156_create_patient_packages_table","1");
INSERT INTO migrations VALUES("78","2023_02_21_121709_add_type_to_invoices_table","1");
INSERT INTO migrations VALUES("79","2023_02_21_121811_create_package_days_table","1");
INSERT INTO migrations VALUES("80","2023_02_22_120809_add_patient_package_id_to_appointments_table","1");
INSERT INTO migrations VALUES("81","2023_02_27_101339_add_employee_id_to_tables","1");
INSERT INTO migrations VALUES("82","2023_03_08_201851_create_program_modules_table","1");
INSERT INTO migrations VALUES("83","2023_03_11_113435_change_column_type_in_users_table","1");
INSERT INTO migrations VALUES("84","2023_03_15_115151_add_column_to_diagnoses","1");
INSERT INTO migrations VALUES("85","2023_03_15_131842_add_evening_status_column_to_settings_table","1");
INSERT INTO migrations VALUES("86","2023_03_15_193412_add_is_entered_to_invoices_table","1");
INSERT INTO migrations VALUES("87","2023_03_16_063843_create_user_manuals_table","1");
INSERT INTO migrations VALUES("88","2023_03_16_153951_add_payment_gateways_column","1");
INSERT INTO migrations VALUES("89","2023_03_16_155611_add_visa_to_invoices","1");
INSERT INTO migrations VALUES("90","2023_03_16_183212_create_patient_groups_table","1");
INSERT INTO migrations VALUES("91","2023_03_16_183328_add_patient_group_id_to_patients_table","1");
INSERT INTO migrations VALUES("92","2023_03_18_111835_add_date_to_purchases_table","1");
INSERT INTO migrations VALUES("93","2023_03_18_113337_add_rate_to_patient_groups_table","1");
INSERT INTO migrations VALUES("94","2023_03_19_120720_add_new_cols_to_settings_table","1");
INSERT INTO migrations VALUES("95","2023_03_19_145515_add_type_to_patient_files_table","1");
INSERT INTO migrations VALUES("96","2023_03_25_123732_add_columns_to_user_manuals_table","1");
INSERT INTO migrations VALUES("97","2023_03_26_150334_add_review_to_appointments","1");
INSERT INTO migrations VALUES("98","2023_03_27_134210_add_rate_type_to_users_table","1");
INSERT INTO migrations VALUES("99","2023_03_28_122303_add_target_to_users_table","1");
INSERT INTO migrations VALUES("100","2023_03_28_131101_add_department_id_to_packages_table","1");
INSERT INTO migrations VALUES("101","2023_05_21_160121_add_session_duration_to_users_table","1");
INSERT INTO migrations VALUES("102","2023_05_23_115951_add_cols_to_appointments_table","1");
INSERT INTO migrations VALUES("103","2023_05_24_124358_add_tab_to_invoices","1");
INSERT INTO migrations VALUES("104","2023_06_17_202049_add_cols_to_settings_table","1");
INSERT INTO migrations VALUES("105","2023_06_17_203036_add_cols_to_patients_table","1");
INSERT INTO migrations VALUES("106","2023_06_21_154228_create_vacation_requests_table","1");
INSERT INTO migrations VALUES("107","2023_06_22_153010_add_status_reason_to_vacation_requests_table","1");
INSERT INTO migrations VALUES("108","2023_07_04_114445_add_date_to_invoices_table","1");
INSERT INTO migrations VALUES("109","2023_07_06_111550_change_gender_in_patients_table","1");
INSERT INTO migrations VALUES("110","2023_07_08_104543_add_cols_to_diagnoses_table","2");
INSERT INTO migrations VALUES("111","2023_07_11_092045_add_active_transfer_print_to_settings","3");



DROP TABLE model_has_permissions;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE model_has_roles;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO model_has_roles VALUES("1","App\Models\User","1");
INSERT INTO model_has_roles VALUES("2","App\Models\User","2");
INSERT INTO model_has_roles VALUES("3","App\Models\User","3");
INSERT INTO model_has_roles VALUES("4","App\Models\User","4");
INSERT INTO model_has_roles VALUES("5","App\Models\User","5");
INSERT INTO model_has_roles VALUES("6","App\Models\User","6");



DROP TABLE notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `body` longtext NOT NULL,
  `link` varchar(191) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notifications VALUES("1","فاتورة جديدة"," تم اضافة فاتورة جديدة بواسطة الطبيب  دكتور 1 للمريض عمرو مجدي   ","http://127.0.0.1:8000/ar/pay-visit","0","","2023-07-06 13:26:42","2023-07-06 13:26:42","");
INSERT INTO notifications VALUES("2","فاتورة جديدة"," تم اضافة فاتورة جديدة بواسطة الطبيب  دكتور 1 للمريض عمرو مجدي   ","http://127.0.0.1:8000/ar/pay-visit","0","","2023-07-08 09:53:07","2023-07-08 09:53:07","");
INSERT INTO notifications VALUES("3","تم تأكيد الدفع","تم تأكيد الدفع للفاتورة رقم 2","http://127.0.0.1:8000/ar/invoices/2","0","","2023-07-08 10:18:52","2023-07-08 10:18:52","1");
INSERT INTO notifications VALUES("4","فاتورة جديدة"," تم اضافة فاتورة جديدة بواسطة الطبيب  دكتور 1 للمريض عمرو مجدي   ","http://127.0.0.1:8000/ar/pay-visit","0","","2023-07-12 14:11:29","2023-07-12 14:11:29","");



DROP TABLE offers;

CREATE TABLE `offers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `rate` double(8,2) DEFAULT 0.00,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_product_id_foreign` (`product_id`),
  CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE overtimes;

CREATE TABLE `overtimes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `overtimes_user_id_foreign` (`user_id`),
  CONSTRAINT `overtimes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE package_days;

CREATE TABLE `package_days` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `patient_package_id` bigint(20) unsigned DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(191) NOT NULL,
  `session_time` varchar(191) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `attend_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_days_patient_id_foreign` (`patient_id`),
  KEY `package_days_patient_package_id_foreign` (`patient_package_id`),
  CONSTRAINT `package_days_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `package_days_patient_package_id_foreign` FOREIGN KEY (`patient_package_id`) REFERENCES `patient_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE package_items;

CREATE TABLE `package_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned NOT NULL,
  `item` varchar(191) NOT NULL,
  `type` enum('exercise','advice') NOT NULL,
  `time` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_items_package_id_foreign` (`package_id`),
  CONSTRAINT `package_items_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE packages;

CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `type` enum('adult','child') NOT NULL DEFAULT 'adult',
  `num_of_sessions` int(11) DEFAULT 0,
  `session_period` double DEFAULT 0,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `last_update` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packages_employee_id_foreign` (`employee_id`),
  KEY `packages_last_update_foreign` (`last_update`),
  KEY `packages_department_id_foreign` (`department_id`),
  CONSTRAINT `packages_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `packages_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `packages_last_update_foreign` FOREIGN KEY (`last_update`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO packages VALUES("1","خطة 1","adult","5","1","100","2023-07-06 13:18:42","2023-07-06 13:18:42","1","1","1");



DROP TABLE password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE patient_conditions;

CREATE TABLE `patient_conditions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `condition_name` varchar(191) NOT NULL,
  `condition_description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE patient_files;

CREATE TABLE `patient_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `file_type` varchar(191) NOT NULL,
  `file_size` varchar(191) NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('medical_files','sick_leave','prescription') NOT NULL DEFAULT 'medical_files',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE patient_groups;

CREATE TABLE `patient_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `parent` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_groups_parent_foreign` (`parent`),
  CONSTRAINT `patient_groups_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `patient_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE patient_packages;

CREATE TABLE `patient_packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `dayes_period` int(11) DEFAULT NULL,
  `session_period` int(11) DEFAULT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `package_price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_packages_patient_id_foreign` (`patient_id`),
  KEY `patient_packages_package_id_foreign` (`package_id`),
  KEY `patient_packages_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `patient_packages_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `patient_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `patient_packages_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patient_packages VALUES("1","1","1","1","5","1","5","500","2023-07-06 13:26:42","2023-07-06 13:26:42");
INSERT INTO patient_packages VALUES("2","1","1","2","5","1","5","500","2023-07-08 09:53:07","2023-07-08 09:53:07");
INSERT INTO patient_packages VALUES("3","1","1","3","5","1","5","500","2023-07-12 14:11:29","2023-07-12 14:11:29");



DROP TABLE patients;

CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `civil` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `parent_name` varchar(191) DEFAULT NULL,
  `grand_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `relationship_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  `birthdate` varchar(191) DEFAULT NULL,
  `age` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `phone2` varchar(191) DEFAULT NULL,
  `near_name` varchar(191) DEFAULT NULL,
  `near_mobile` varchar(191) DEFAULT NULL,
  `notes_health_record` text DEFAULT NULL,
  `goal_of_visit` text DEFAULT NULL,
  `penicillin` tinyint(1) DEFAULT 0,
  `teeth_problems` tinyint(1) DEFAULT 0,
  `drugs` tinyint(1) DEFAULT 0,
  `heart` tinyint(1) DEFAULT 0,
  `pressure` tinyint(1) DEFAULT 0,
  `fever` tinyint(1) DEFAULT 0,
  `anemia` tinyint(1) DEFAULT 0,
  `thyroid_glands` tinyint(1) DEFAULT 0,
  `liver` tinyint(1) DEFAULT 0,
  `sugar` tinyint(1) DEFAULT 0,
  `tb` tinyint(1) DEFAULT 0,
  `kidneys` tinyint(1) DEFAULT 0,
  `convulsion` tinyint(1) DEFAULT 0,
  `other_diseases` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insurance_id` bigint(20) unsigned DEFAULT NULL,
  `visitor` tinyint(1) DEFAULT NULL,
  `is_pregnant` tinyint(1) NOT NULL DEFAULT 0,
  `patient_group_id` bigint(20) unsigned DEFAULT NULL,
  `age_type` enum('adult','baby') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_user_id_foreign` (`user_id`),
  KEY `patients_relationship_id_foreign` (`relationship_id`),
  KEY `patients_department_id_foreign` (`department_id`),
  KEY `patients_city_id_foreign` (`city_id`),
  KEY `patients_country_id_foreign` (`country_id`),
  KEY `patients_insurance_id_foreign` (`insurance_id`),
  KEY `patients_patient_group_id_foreign` (`patient_group_id`),
  CONSTRAINT `patients_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `patients_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `patients_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `patients_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE SET NULL,
  CONSTRAINT `patients_patient_group_id_foreign` FOREIGN KEY (`patient_group_id`) REFERENCES `patient_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `patients_relationship_id_foreign` FOREIGN KEY (`relationship_id`) REFERENCES `relationships` (`id`) ON DELETE SET NULL,
  CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patients VALUES("1","1234567899","عمرو مجدي","","","","1","","","","","1","","","0559826862","","","","","","","","","","","","","","","","","","","","","","2023-07-06 13:17:25","2023-07-06 13:17:25","","","0","","");



DROP TABLE permissions;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO permissions VALUES("1","الأقسام","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("2","العروض","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("3","النماذج","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("4","الخدمات","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("5","المصاريف","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("6","المشتريات","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("7","اضافة فاتورة","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("8","المحولون","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("9","التقارير","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO permissions VALUES("10","اضافة مريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("11","تعديل مريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("12","حذف مريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("13","تحويل مريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("14","المرضى","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("15","المواعيد","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("16","الفواتير","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("17","التشخيصات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("18","تسديد الزيارات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("19","الاشعارات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("20","المرضى بالانتظار","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("21","الاعدادات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("22","الصلاحيات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("23","المشرفين","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("24","الموظفين","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("25","خصم الفاتورة","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("26","رؤية جوال المريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("27","طلبات الأشعة داخل ملف المريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("28","طلبات المختبر داخل ملف المريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("29","رفع الملفات على الاشعه والمختبرات","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("30","تعديل السعر","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("31","بيانات المواعيد","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("32","حذف الفواتير","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("33","تحضير المرضى","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("34","عرض الملف الشخصي للمريض","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("35","اضافة الفواتير","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("36","تعديل الفواتير","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("37","استرجاع الفواتير","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("38","حذف الموعد","web","2023-07-06 13:07:51","2023-07-06 13:07:51");
INSERT INTO permissions VALUES("39","تعديل الموعد","web","2023-07-06 13:07:51","2023-07-06 13:07:51");



DROP TABLE personal_access_tokens;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE products;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_department_id_foreign` (`department_id`),
  CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","خدمة 1","100","","","2023-07-06 13:07:51","2023-07-06 13:07:51","1");
INSERT INTO products VALUES("2","خدمة 2","200","","","2023-07-06 13:07:51","2023-07-06 13:07:51","1");



DROP TABLE program_modules;

CREATE TABLE `program_modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE purchases;

CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `tax` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax_value` double DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `last_update` bigint(20) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_employee_id_foreign` (`employee_id`),
  KEY `purchases_last_update_foreign` (`last_update`),
  CONSTRAINT `purchases_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchases_last_update_foreign` FOREIGN KEY (`last_update`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE relationships;

CREATE TABLE `relationships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO relationships VALUES("1","متزوج","2023-07-06 13:07:51","2023-07-06 13:07:51");



DROP TABLE role_has_permissions;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_has_permissions VALUES("1","1");
INSERT INTO role_has_permissions VALUES("2","1");
INSERT INTO role_has_permissions VALUES("3","1");
INSERT INTO role_has_permissions VALUES("4","1");
INSERT INTO role_has_permissions VALUES("5","1");
INSERT INTO role_has_permissions VALUES("6","1");
INSERT INTO role_has_permissions VALUES("7","1");
INSERT INTO role_has_permissions VALUES("8","1");
INSERT INTO role_has_permissions VALUES("9","1");
INSERT INTO role_has_permissions VALUES("10","1");
INSERT INTO role_has_permissions VALUES("11","1");
INSERT INTO role_has_permissions VALUES("12","1");
INSERT INTO role_has_permissions VALUES("13","1");
INSERT INTO role_has_permissions VALUES("14","1");
INSERT INTO role_has_permissions VALUES("15","1");
INSERT INTO role_has_permissions VALUES("16","1");
INSERT INTO role_has_permissions VALUES("17","1");
INSERT INTO role_has_permissions VALUES("18","1");
INSERT INTO role_has_permissions VALUES("19","1");
INSERT INTO role_has_permissions VALUES("20","1");
INSERT INTO role_has_permissions VALUES("21","1");
INSERT INTO role_has_permissions VALUES("22","1");
INSERT INTO role_has_permissions VALUES("23","1");
INSERT INTO role_has_permissions VALUES("24","1");
INSERT INTO role_has_permissions VALUES("25","1");
INSERT INTO role_has_permissions VALUES("26","1");
INSERT INTO role_has_permissions VALUES("27","1");
INSERT INTO role_has_permissions VALUES("28","1");
INSERT INTO role_has_permissions VALUES("29","1");
INSERT INTO role_has_permissions VALUES("30","1");
INSERT INTO role_has_permissions VALUES("31","1");
INSERT INTO role_has_permissions VALUES("32","1");
INSERT INTO role_has_permissions VALUES("33","1");
INSERT INTO role_has_permissions VALUES("34","1");
INSERT INTO role_has_permissions VALUES("35","1");
INSERT INTO role_has_permissions VALUES("36","1");
INSERT INTO role_has_permissions VALUES("37","1");
INSERT INTO role_has_permissions VALUES("38","1");
INSERT INTO role_has_permissions VALUES("39","1");



DROP TABLE roles;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","مدير","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO roles VALUES("2","الاستقبال","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO roles VALUES("3","الأطباء","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO roles VALUES("4","المحاسبين","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO roles VALUES("5","الأشعة","web","2023-07-06 13:07:50","2023-07-06 13:07:50");
INSERT INTO roles VALUES("6","المختبر","web","2023-07-06 13:07:50","2023-07-06 13:07:50");



DROP TABLE scan_requests;

CREATE TABLE `scan_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `clinic_id` int(10) unsigned NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `scanned_at` date DEFAULT NULL,
  `delivered_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dr_content` text DEFAULT NULL,
  `scan_content` text DEFAULT NULL,
  `appointment_id` bigint(20) unsigned DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `dr_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `scan_requests_appointment_id_foreign` (`appointment_id`),
  KEY `scan_requests_product_id_foreign` (`product_id`),
  KEY `scan_requests_dr_id_foreign` (`dr_id`),
  CONSTRAINT `scan_requests_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `scan_requests_dr_id_foreign` FOREIGN KEY (`dr_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `scan_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE scan_services;

CREATE TABLE `scan_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE services;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `last_update` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_category_id_foreign` (`category_id`),
  KEY `services_employee_id_foreign` (`employee_id`),
  KEY `services_last_update_foreign` (`last_update`),
  CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `lab_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `services_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `services_last_update_foreign` FOREIGN KEY (`last_update`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `message_status` longtext DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  `sms_status` enum('open','close') NOT NULL DEFAULT 'open',
  `sms_username` varchar(191) DEFAULT NULL,
  `sms_password` varchar(191) DEFAULT NULL,
  `sms_sender` varchar(191) DEFAULT NULL,
  `from_morning` varchar(191) DEFAULT NULL,
  `to_morning` varchar(191) DEFAULT NULL,
  `to_evening` varchar(191) DEFAULT NULL,
  `from_evening` varchar(191) DEFAULT NULL,
  `patient_exposure` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `build_num` varchar(191) DEFAULT NULL,
  `unit_num` varchar(191) DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `extra_number` varchar(191) DEFAULT NULL,
  `tax_no` varchar(191) NOT NULL,
  `tax_rate` double(8,2) NOT NULL DEFAULT 0.00,
  `tax_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_transfer` tinyint(1) DEFAULT NULL,
  `capital` double(10,2) DEFAULT NULL,
  `new_invoice_form` tinyint(1) DEFAULT 0,
  `complaint` tinyint(1) DEFAULT 0,
  `installment_company_name` varchar(191) DEFAULT NULL,
  `installment_company_tax` double(8,2) DEFAULT NULL,
  `installment_company_min_amount_tax` double(8,2) DEFAULT NULL,
  `installment_company_max_amount_tax` double(8,2) DEFAULT NULL,
  `evening_status` tinyint(1) NOT NULL DEFAULT 1,
  `payment_gateways` tinyint(1) NOT NULL DEFAULT 0,
  `birthdate_type` enum('hijri','gregorian') NOT NULL DEFAULT 'gregorian',
  `activate_birthdate` tinyint(1) DEFAULT 0,
  `age_or_gender` varchar(191) DEFAULT NULL,
  `active_transfer_print` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES("1","Atheeb Clinic","http://127.0.0.1:8000/admin/settings","atheeb.clinic@gmail.com","","","open","","0599001818","open","Atheeb Clinic","0123454","Atheeb Clinic","13:00","17:00","23:00","20:00","","حي طويق","6624","4","14928","3034","310954677800003","15","1","2023-07-06 13:07:50","2023-07-12 14:56:56","","","0","0","","","","","1","0","gregorian","0","all","0");



DROP TABLE user_manuals;

CREATE TABLE `user_manuals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(191) NOT NULL,
  `answer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_en` varchar(191) DEFAULT NULL,
  `answer_en` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `type` enum('admin','dr','recep','accountant','lab','scan','company') NOT NULL DEFAULT 'recep',
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `salary` double(10,2) DEFAULT 0.00,
  `rate` double(8,2) DEFAULT 0.00,
  `rate_active` tinyint(1) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `show_department_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`show_department_products`)),
  `is_dentist` tinyint(1) DEFAULT NULL,
  `is_dermatologist` tinyint(1) DEFAULT NULL,
  `rate_type` varchar(191) DEFAULT NULL,
  `target` double(16,2) DEFAULT NULL,
  `session_duration` int(11) NOT NULL DEFAULT 30,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_department_id_foreign` (`department_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","admin","admin@admin.com","admin","","0","0","0","","$2y$10$uIavDZhp04NJkjdo.5YYvugCvUOblJ4Opx9q8D47iRzbMJop3R.Y2","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");
INSERT INTO users VALUES("2","استقبال","r@r.r","recep","","5","0","0","","$2y$10$xTFYkUzYb/Wra.yVJ.rD3ed/Y3QTA4eQ1m96iaPT3Q55MQ6nWhlZK","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");
INSERT INTO users VALUES("3","دكتور 1","d@d.d","dr","1","5","0","0","","$2y$10$nSMuwuKpU5XcrHxejwvx.OAtc6/T.B662xiwSMtGdze5WNf.ATCsa","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");
INSERT INTO users VALUES("4","محاسب","a@a.a","accountant","","5","0","0","","$2y$10$KZhZXJU4XC3zn/BALWUP6ukaXIY1P6JeYcYhf0PIM455TPpFbp5my","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");
INSERT INTO users VALUES("5","أشعة","s@s.s","scan","","5","0","0","","$2y$10$Leccgh7vp3I85rLMoj0tR.yiCxcI0ztzeejKqzaGMKO5o6b1RPcfu","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");
INSERT INTO users VALUES("6","مختبر","m@m.m","lab","","5","0","0","","$2y$10$UCLdFVf5fYJVh0/TVatcLO73M6IZWbxz5/opb8MSBh7VP3TV1LJVe","","2023-07-06 13:07:51","2023-07-06 13:07:51","","","","","","","30");



DROP TABLE vacation_requests;

CREATE TABLE `vacation_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `duration` varchar(191) DEFAULT 'day',
  `duration_time` varchar(191) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `status` enum('new','accepted','rejected') NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_reason` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vacation_requests_user_id_foreign` (`user_id`),
  CONSTRAINT `vacation_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




