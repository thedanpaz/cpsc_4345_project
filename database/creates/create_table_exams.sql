CREATE TABLE `exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_type` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Denotes what type of exam the record is.',
  `course_section_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exams_course_section_id_foreign` (`course_section_id`),
  CONSTRAINT `exams_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;