CREATE TABLE `people` (
  `university_id_number` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A university member''s first name',
  `preferred_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A university member''s first name',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A university member''s last name',
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Denotes whether student, staff, faculty, etc.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`university_id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;