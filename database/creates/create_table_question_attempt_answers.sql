CREATE TABLE `question_attempt_answers` (
  `question_option_id` bigint(20) unsigned NOT NULL,
  `exam_attempt_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `question_attempt_answers_question_option_id_foreign` (`question_option_id`),
  KEY `question_attempt_answers_exam_attempt_id_foreign` (`exam_attempt_id`),
  CONSTRAINT `question_attempt_answers_exam_attempt_id_foreign` FOREIGN KEY (`exam_attempt_id`) REFERENCES `exam_attempts` (`id`),
  CONSTRAINT `question_attempt_answers_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;