CREATE TABLE `course_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_hours` int(11) NOT NULL,
  `faculty` bigint(20) unsigned NOT NULL,
  `course_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_sections_faculty_foreign` (`faculty`),
  KEY `course_sections_course_id_foreign` (`course_id`),
  CONSTRAINT `course_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `course_sections_faculty_foreign` FOREIGN KEY (`faculty`) REFERENCES `people` (`university_id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;