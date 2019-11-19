CREATE TABLE `course_registrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midterm_exam_grade` int(11) NOT NULL,
  `final_exam_grade` int(11) NOT NULL,
  `final_course_grade` int(11) NOT NULL,
  `participation_grade` int(11) NOT NULL,
  `attendance_grade` int(11) NOT NULL,
  `registrant_university_id` bigint(20) unsigned NOT NULL,
  `course_section_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_registrations_registrant_university_id_foreign` (`registrant_university_id`),
  KEY `course_registrations_course_section_id_foreign` (`course_section_id`),
  CONSTRAINT `course_registrations_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_sections` (`id`),
  CONSTRAINT `course_registrations_registrant_university_id_foreign` FOREIGN KEY (`registrant_university_id`) REFERENCES `people` (`university_id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;