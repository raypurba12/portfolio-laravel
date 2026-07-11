-- ============================================
-- DATABASE LENGKAP untuk Portfolio Laravel
-- ============================================

-- 1. USERS
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. PASSWORD RESET TOKENS
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. SESSIONS
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id`),
  INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. CACHE
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  INDEX `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. CACHE LOCKS
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  INDEX `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. JOBS
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. JOB BATCHES
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. FAILED JOBS
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL UNIQUE,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. PERMISSIONS
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. ROLES
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. MODEL HAS PERMISSIONS
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  INDEX `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. MODEL HAS ROLES
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  INDEX `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 13. ROLE HAS PERMISSIONS
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 14. HEROES
CREATE TABLE IF NOT EXISTS `heroes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `typing_text` text NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `background_path` varchar(255) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `whatsapp_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `heroes_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 15. ABOUTS
CREATE TABLE IF NOT EXISTS `abouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `birth_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `hobbies` text NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 16. SKILL CATEGORIES
CREATE TABLE IF NOT EXISTS `skill_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 17. SKILLS
CREATE TABLE IF NOT EXISTS `skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `skill_category_id` bigint unsigned NOT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `percentage` int NOT NULL DEFAULT '0',
  `color` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `skills_skill_category_id_index` (`skill_category_id`),
  INDEX `skills_featured_index` (`featured`),
  INDEX `skills_order_index` (`order`),
  CONSTRAINT `skills_skill_category_id_foreign` FOREIGN KEY (`skill_category_id`) REFERENCES `skill_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 18. PROJECT CATEGORIES
CREATE TABLE IF NOT EXISTS `project_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 19. PROJECTS
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `project_category_id` bigint unsigned DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `description` text,
  `technology_stack` text,
  `github_url` varchar(255) DEFAULT NULL,
  `live_demo_url` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `client` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `projects_project_category_id_index` (`project_category_id`),
  INDEX `projects_status_index` (`status`),
  INDEX `projects_featured_index` (`featured`),
  CONSTRAINT `projects_project_category_id_foreign` FOREIGN KEY (`project_category_id`) REFERENCES `project_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 20. PROJECT IMAGES
CREATE TABLE IF NOT EXISTS `project_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `project_images_project_id_index` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 21. EXPERIENCES
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '0',
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `experiences_is_current_index` (`is_current`),
  INDEX `experiences_order_index` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 22. EDUCATIONS
CREATE TABLE IF NOT EXISTS `educations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `institution` varchar(255) NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `description` text,
  `logo_path` varchar(255) DEFAULT NULL,
  `start_year` year NOT NULL,
  `end_year` year DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '0',
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `educations_is_current_index` (`is_current`),
  INDEX `educations_order_index` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 23. CERTIFICATES
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `issuer` varchar(255) NOT NULL,
  `issued_at` date NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `credential_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 24. SERVICES
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `short_description` text NOT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `services_is_active_index` (`is_active`),
  INDEX `services_order_index` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 25. CONTACTS
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') NOT NULL DEFAULT 'unread',
  `reply` text,
  `replied_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `contacts_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 26. SOCIAL MEDIA
CREATE TABLE IF NOT EXISTS `social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `social_media_is_active_index` (`is_active`),
  INDEX `social_media_order_index` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 27. SETTINGS
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 28. HERO BACKGROUNDS
CREATE TABLE IF NOT EXISTS `hero_backgrounds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'image',
  `url` varchar(255) NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- SEED DATA
-- ============================================

-- SETTINGS
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('site_title', 'Portfolio Ray Purba', NOW(), NOW()),
('site_description', 'Full Stack Web Developer portfolio built with Laravel and Tailwind CSS.', NOW(), NOW()),
('site_email', 'ray@email.com', NOW(), NOW()),
('site_address', 'Indonesia', NOW(), NOW()),
('site_phone', '+62 812-3456-7890', NOW(), NOW()),
('site_footer', 'Built with ♥ Laravel', NOW(), NOW()),
('google_analytics', NULL, NOW(), NOW()),
('google_maps_embed', NULL, NOW(), NOW()),
('logo_path', NULL, NOW(), NOW()),
('favicon_path', NULL, NOW(), NOW());

-- SKILL CATEGORIES
INSERT INTO `skill_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Frontend', 'frontend', NOW(), NOW()),
(2, 'Backend', 'backend', NOW(), NOW()),
(3, 'Database', 'database', NOW(), NOW()),
(4, 'DevOps', 'devops', NOW(), NOW()),
(5, 'Cloud', 'cloud', NOW(), NOW()),
(6, 'AI', 'ai', NOW(), NOW());

-- SKILLS
INSERT INTO `skills` (`name`, `skill_category_id`, `logo_path`, `percentage`, `featured`, `order`, `created_at`, `updated_at`) VALUES
('React', 1, 'https://cdn.simpleicons.org/react', 95, 1, 0, NOW(), NOW()),
('Vue.js', 1, 'https://cdn.simpleicons.org/vuedotjs', 90, 1, 0, NOW(), NOW()),
('Tailwind CSS', 1, 'https://cdn.simpleicons.org/tailwindcss', 98, 1, 0, NOW(), NOW()),
('Laravel', 2, 'https://cdn.simpleicons.org/laravel', 98, 1, 0, NOW(), NOW()),
('Node.js', 2, 'https://cdn.simpleicons.org/nodedotjs', 85, 1, 0, NOW(), NOW()),
('MySQL', 3, 'https://cdn.simpleicons.org/mysql', 92, 1, 0, NOW(), NOW()),
('Docker', 4, 'https://cdn.simpleicons.org/docker', 80, 1, 0, NOW(), NOW()),
('AWS', 5, 'https://cdn.simpleicons.org/amazonwebservices', 75, 1, 0, NOW(), NOW()),
('TensorFlow', 6, 'https://cdn.simpleicons.org/tensorflow', 70, 1, 0, NOW(), NOW());

-- PERMISSIONS & ROLES
INSERT INTO `permissions` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('admin-access', 'web', NOW(), NOW());

INSERT INTO `roles` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES
('admin', 'web', NOW(), NOW());

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES (1, 1);

-- ADMIN USER (password: rahasia123)
INSERT INTO `users` (`name`, `email`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@email.com', '$2y$12$LJ3m4ys3Lk0TSwHn5VOKOOeFf0EtqFEvM3NEaTvT7GqVqfq5pH4kO', NOW(), NOW(), NOW());

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- PROJECT CATEGORIES
INSERT INTO `project_categories` (`name`, `slug`, `created_at`, `updated_at`) VALUES
('Web App', 'web-app', NOW(), NOW()),
('Mobile', 'mobile', NOW(), NOW()),
('API', 'api', NOW(), NOW());
