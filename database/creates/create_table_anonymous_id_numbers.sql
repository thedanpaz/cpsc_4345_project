CREATE TABLE `anonymous_id_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uin` bigint(20) unsigned NOT NULL,
  `exam_type` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Denotes what type of exam an anonymous id number is meant for.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anonymous_id_numbers_uin_foreign` (`uin`),
  CONSTRAINT `anonymous_id_numbers_uin_foreign` FOREIGN KEY (`uin`) REFERENCES `people` (`university_id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;