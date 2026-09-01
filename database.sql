-- ============================================================
-- V P Singh Advocate - Complete Database Schema & Seed Data
-- Database: MySQL / MariaDB (utf8mb4)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';



-- ============================================================
-- 1. USERS TABLE
-- ============================================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(30) DEFAULT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('super_admin','editor') DEFAULT 'editor',
    `is_active` TINYINT(1) DEFAULT 1,
    `last_login` DATETIME DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_users_email` (`email`),
    UNIQUE KEY `uk_users_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 2. SITE SETTINGS TABLE
-- ============================================================
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `setting_key` VARCHAR(100) NOT NULL,
    `setting_value` TEXT DEFAULT NULL,
    `setting_group` VARCHAR(50) DEFAULT 'general',
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_settings_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 3. PAGES TABLE
-- ============================================================
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `content` LONGTEXT DEFAULT NULL,
    `excerpt` TEXT DEFAULT NULL,
    `template` VARCHAR(100) DEFAULT 'default',
    `featured_image` VARCHAR(500) DEFAULT NULL,
    `is_published` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `seo_title` VARCHAR(255) DEFAULT NULL,
    `seo_description` TEXT DEFAULT NULL,
    `seo_og_image` VARCHAR(500) DEFAULT NULL,
    `seo_canonical` VARCHAR(500) DEFAULT NULL,
    `seo_robots` VARCHAR(50) DEFAULT 'index, follow',
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_pages_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 4. PAGE SECTIONS TABLE
-- ============================================================
DROP TABLE IF EXISTS `page_sections`;
CREATE TABLE `page_sections` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `page_id` INT UNSIGNED NOT NULL,
    `section_key` VARCHAR(100) NOT NULL,
    `section_title` VARCHAR(255) DEFAULT NULL,
    `section_content` LONGTEXT DEFAULT NULL,
    `section_image` VARCHAR(500) DEFAULT NULL,
    `section_data` JSON DEFAULT NULL,
    `sort_order` INT DEFAULT 0,
    `is_visible` TINYINT(1) DEFAULT 1,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_page_sections_page_id` (`page_id`),
    CONSTRAINT `fk_page_sections_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 5. PRACTICE AREAS TABLE
-- ============================================================
DROP TABLE IF EXISTS `practice_areas`;
CREATE TABLE `practice_areas` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `short_description` TEXT DEFAULT NULL,
    `description` LONGTEXT DEFAULT NULL,
    `icon` VARCHAR(100) DEFAULT NULL,
    `image` VARCHAR(500) DEFAULT NULL,
    `cta_label` VARCHAR(100) DEFAULT 'Explore This Practice',
    `is_featured` TINYINT(1) DEFAULT 0,
    `is_published` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `seo_title` VARCHAR(255) DEFAULT NULL,
    `seo_description` TEXT DEFAULT NULL,
    `seo_og_image` VARCHAR(500) DEFAULT NULL,
    `seo_canonical` VARCHAR(500) DEFAULT NULL,
    `seo_robots` VARCHAR(50) DEFAULT 'index, follow',
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_practice_areas_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 6. ADVOCATE PROFILE TABLE
-- ============================================================
DROP TABLE IF EXISTS `advocate_profile`;
CREATE TABLE `advocate_profile` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `designation` VARCHAR(255) DEFAULT 'Advocate',
    `biography` LONGTEXT DEFAULT NULL,
    `profile_image` VARCHAR(500) DEFAULT NULL,
    `education` TEXT DEFAULT NULL,
    `experience` TEXT DEFAULT NULL,
    `court_info` TEXT DEFAULT NULL,
    `practice_area_ids` JSON DEFAULT NULL,
    `memberships` TEXT DEFAULT NULL,
    `credentials` TEXT DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 7. LOCATIONS TABLE
-- ============================================================
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `office_name` VARCHAR(255) NOT NULL,
    `address` TEXT DEFAULT NULL,
    `city` VARCHAR(100) NOT NULL,
    `state` VARCHAR(100) NOT NULL,
    `pin` VARCHAR(10) DEFAULT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `whatsapp` VARCHAR(20) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `google_maps_url` VARCHAR(500) DEFAULT NULL,
    `latitude` DECIMAL(10,8) DEFAULT NULL,
    `longitude` DECIMAL(11,8) DEFAULT NULL,
    `office_hours` TEXT DEFAULT NULL,
    `image` VARCHAR(500) DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 8. BLOG POSTS TABLE
-- ============================================================
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `excerpt` TEXT DEFAULT NULL,
    `content` LONGTEXT DEFAULT NULL,
    `featured_image` VARCHAR(500) DEFAULT NULL,
    `author_id` INT UNSIGNED NOT NULL,
    `category_id` INT UNSIGNED DEFAULT NULL,
    `status` ENUM('draft','published','scheduled') DEFAULT 'draft',
    `published_at` DATETIME DEFAULT NULL,
    `scheduled_at` DATETIME DEFAULT NULL,
    `view_count` INT DEFAULT 0,
    `seo_title` VARCHAR(255) DEFAULT NULL,
    `seo_description` TEXT DEFAULT NULL,
    `seo_og_image` VARCHAR(500) DEFAULT NULL,
    `seo_canonical` VARCHAR(500) DEFAULT NULL,
    `seo_robots` VARCHAR(50) DEFAULT 'index, follow',
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_blog_posts_slug` (`slug`),
    KEY `idx_blog_posts_category_id` (`category_id`),
    KEY `idx_blog_posts_author_id` (`author_id`),
    KEY `idx_blog_posts_status` (`status`),
    CONSTRAINT `fk_blog_posts_author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 9. BLOG CATEGORIES TABLE
-- ============================================================
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_blog_categories_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 10. BLOG TAGS TABLE
-- ============================================================
DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE `blog_tags` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL,
    `created_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_blog_tags_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 11. BLOG POST TAGS (PIVOT) TABLE
-- ============================================================
DROP TABLE IF EXISTS `blog_post_tags`;
CREATE TABLE `blog_post_tags` (
    `post_id` INT UNSIGNED NOT NULL,
    `tag_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`post_id`, `tag_id`),
    CONSTRAINT `fk_bpt_post_id` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_bpt_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 12. FAQS TABLE
-- ============================================================
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(500) NOT NULL,
    `answer` LONGTEXT NOT NULL,
    `assignable_type` VARCHAR(50) DEFAULT NULL COMMENT 'page, practice_area, blog_post, or global',
    `assignable_id` INT UNSIGNED DEFAULT NULL,
    `is_published` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_faqs_assignable` (`assignable_type`, `assignable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 13. TESTIMONIALS TABLE
-- ============================================================
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `client_name` VARCHAR(255) NOT NULL,
    `review` TEXT NOT NULL,
    `rating` TINYINT(1) DEFAULT 5,
    `location` VARCHAR(255) DEFAULT NULL,
    `image` VARCHAR(500) DEFAULT NULL,
    `source` VARCHAR(100) DEFAULT NULL,
    `is_published` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 14. CONSULTATIONS TABLE
-- ============================================================
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE `consultations` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `booking_id` VARCHAR(20) NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `mobile` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `city` VARCHAR(100) DEFAULT NULL,
    `legal_matter` VARCHAR(255) DEFAULT NULL,
    `consultation_mode` ENUM('online','offline') DEFAULT 'online',
    `preferred_date` DATE DEFAULT NULL,
    `preferred_time` VARCHAR(20) DEFAULT NULL,
    `description` TEXT DEFAULT NULL,
    `amount` DECIMAL(10,2) DEFAULT 2100.00,
    `payment_status` ENUM('awaiting','submitted','verified','rejected','refunded') DEFAULT 'awaiting',
    `booking_status` ENUM('pending','confirmed','completed','cancelled') DEFAULT 'pending',
    `notes` TEXT DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_consultations_booking_id` (`booking_id`),
    KEY `idx_consultations_payment_status` (`payment_status`),
    KEY `idx_consultations_booking_status` (`booking_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 15. PAYMENTS TABLE
-- ============================================================
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `consultation_id` INT UNSIGNED NOT NULL,
    `client_name` VARCHAR(255) NOT NULL,
    `mobile` VARCHAR(20) NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `payment_method` ENUM('upi','bank_transfer') DEFAULT 'upi',
    `utr_number` VARCHAR(100) DEFAULT NULL,
    `screenshot` VARCHAR(500) DEFAULT NULL,
    `status` ENUM('awaiting','submitted','verified','rejected','refunded') DEFAULT 'awaiting',
    `admin_notes` TEXT DEFAULT NULL,
    `verified_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_payments_consultation_id` (`consultation_id`),
    KEY `idx_payments_status` (`status`),
    CONSTRAINT `fk_payments_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 16. PAYMENT METHODS TABLE
-- ============================================================
DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `method_type` ENUM('qr','bank') NOT NULL,
    `label` VARCHAR(255) NOT NULL,
    `qr_image` VARCHAR(500) DEFAULT NULL,
    `upi_id` VARCHAR(255) DEFAULT NULL,
    `account_holder` VARCHAR(255) DEFAULT NULL,
    `bank_name` VARCHAR(255) DEFAULT NULL,
    `account_number` VARCHAR(50) DEFAULT NULL,
    `ifsc` VARCHAR(20) DEFAULT NULL,
    `branch` VARCHAR(255) DEFAULT NULL,
    `account_type` VARCHAR(50) DEFAULT NULL,
    `instructions` TEXT DEFAULT NULL,
    `is_enabled` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 17. ENQUIRIES TABLE
-- ============================================================
DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `city` VARCHAR(100) DEFAULT NULL,
    `subject` VARCHAR(255) DEFAULT NULL,
    `legal_matter` VARCHAR(255) DEFAULT NULL,
    `message` TEXT NOT NULL,
    `source_page` VARCHAR(255) DEFAULT NULL,
    `status` ENUM('new','contacted','consultation_booked','converted','closed') DEFAULT 'new',
    `admin_notes` TEXT DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_enquiries_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 18. MEDIA TABLE
-- ============================================================
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `file_name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_type` VARCHAR(100) NOT NULL,
    `file_size` INT DEFAULT 0,
    `alt_text` VARCHAR(255) DEFAULT NULL,
    `width` INT DEFAULT NULL,
    `height` INT DEFAULT NULL,
    `folder` VARCHAR(100) DEFAULT 'uploads',
    `uploaded_by` INT UNSIGNED DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_media_folder` (`folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 19. ANNOUNCEMENTS TABLE
-- ============================================================
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `text` VARCHAR(500) NOT NULL,
    `cta_label` VARCHAR(100) DEFAULT NULL,
    `cta_url` VARCHAR(500) DEFAULT NULL,
    `start_date` DATE DEFAULT NULL,
    `end_date` DATE DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 20. MENUS TABLE
-- ============================================================
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `location` VARCHAR(50) NOT NULL COMMENT 'header, footer, sidebar',
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 21. MENU ITEMS TABLE
-- ============================================================
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `menu_id` INT UNSIGNED NOT NULL,
    `parent_id` INT UNSIGNED DEFAULT NULL,
    `label` VARCHAR(100) NOT NULL,
    `url` VARCHAR(500) NOT NULL,
    `target` VARCHAR(20) DEFAULT '_self',
    `is_active` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `css_class` VARCHAR(100) DEFAULT NULL,
    `is_cta` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_menu_items_menu_id` (`menu_id`),
    CONSTRAINT `fk_menu_items_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 22. SEO METADATA TABLE
-- ============================================================
DROP TABLE IF EXISTS `seo_metadata`;
CREATE TABLE `seo_metadata` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `metaable_type` VARCHAR(50) NOT NULL,
    `metaable_id` INT UNSIGNED NOT NULL,
    `seo_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `og_title` VARCHAR(255) DEFAULT NULL,
    `og_description` TEXT DEFAULT NULL,
    `og_image` VARCHAR(500) DEFAULT NULL,
    `canonical_url` VARCHAR(500) DEFAULT NULL,
    `robots` VARCHAR(50) DEFAULT 'index, follow',
    `schema_markup` JSON DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================================================
-- SEED DATA
-- ============================================================

SET @now = NOW();

-- ============================================================
-- USERS
-- ============================================================
INSERT INTO `users` (`email`, `username`, `password_hash`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
('admin@vpsinghadvocate.com', 'admin', '$2y$10$nmGEAlXqN8ieO0AviVKk0uiSQuhWAxep3bX09KyLz5pCH7PGb44Le', 'super_admin', 1, @now, @now),
('editor@vpsinghadvocate.com', 'editor', '$2y$10$nmGEAlXqN8ieO0AviVKk0uiSQuhWAxep3bX09KyLz5pCH7PGb44Le', 'editor', 1, @now, @now);

-- Default password for both: Admin@123

-- ============================================================
-- SITE SETTINGS
-- ============================================================
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_group`, `created_at`, `updated_at`) VALUES
-- General
('site_name', 'V P Singh Advocate', 'general', @now, @now),
('tagline', 'Professional Legal Counsel & Representation', 'general', @now, @now),
('logo', '', 'general', @now, @now),
('favicon', '', 'general', @now, @now),
('phone', '', 'general', @now, @now),
('whatsapp', '', 'general', @now, @now),
('email', '', 'general', @now, @now),
('address', 'Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India', 'general', @now, @now),
('consultation_fee', '2100', 'general', @now, @now),
('business_hours', 'Monday - Saturday: 9:00 AM - 6:00 PM', 'general', @now, @now),
('disclaimer', 'The information provided on this website is for general informational purposes only and should not be treated as legal advice. Viewing this website or contacting the office does not by itself create an advocate-client relationship.', 'general', @now, @now),
('copyright', '© 2026 V P Singh Advocate. All rights reserved.', 'general', @now, @now),
-- Social
('social_instagram', '', 'social', @now, @now),
('social_facebook', '', 'social', @now, @now),
('social_linkedin', '', 'social', @now, @now),
('social_youtube', '', 'social', @now, @now),
-- Hero
('hero_eyebrow', 'ADVOCATE • LEGAL CONSULTATION • REPRESENTATION', 'hero', @now, @now),
('hero_heading', 'Clear legal guidance. Strategic representation.', 'hero', @now, @now),
('hero_description', 'Professional legal consultation and representation for individuals, families and businesses in Mohammadi Kheri, Lakhimpur Kheri and surrounding areas.', 'hero', @now, @now),
('hero_image', '', 'hero', @now, @now),
('hero_image_position', 'right', 'hero', @now, @now),
('hero_cta_label', 'Book Consultation', 'hero', @now, @now),
('hero_cta_url', '/book-consultation', 'hero', @now, @now),
('hero_secondary_cta_label', 'Talk on WhatsApp', 'hero', @now, @now),
('hero_secondary_cta_url', '', 'hero', @now, @now),
('hero_location', 'Mohammadi Kheri · Lakhimpur Kheri · Uttar Pradesh', 'hero', @now, @now),
('hero_visible', '1', 'hero', @now, @now),
-- Trust
('trust_items', '[{\"icon\":\"scale\",\"text\":\"Professional Legal Counsel\"},{\"icon\":\"users\",\"text\":\"Personal Consultation\"},{\"icon\":\"map-pin\",\"text\":\"Local Legal Representation\"},{\"icon\":\"monitor\",\"text\":\"Online & Offline Consultation\"}]', 'trust', @now, @now),
-- Intro
('intro_heading', 'A considered approach to every legal matter.', 'intro', @now, @now),
('intro_content', '<p>Every legal matter deserves careful attention and a clear understanding of the facts. We take the time to understand your situation, explain your legal options, and develop an appropriate strategy.</p><p>Professional representation begins with clear communication. We ensure you understand each step of the process and remain informed throughout.</p><p>Confidentiality is fundamental to the attorney-client relationship. Your information is handled with the utmost care and discretion.</p>', 'intro', @now, @now),
('intro_cta_label', 'About V P Singh', 'intro', @now, @now),
('intro_cta_url', '/about', 'intro', @now, @now),
('intro_visible', '1', 'intro', @now, @now),
-- Why Choose
('why_items', '[{\"icon\":\"message-circle\",\"title\":\"Clear Communication\",\"description\":\"Explain legal matters in straightforward language so you can make informed decisions.\"},{\"icon\":\"target\",\"title\":\"Strategic Approach\",\"description\":\"Understand facts and available legal options before determining the appropriate course of action.\"},{\"icon\":\"heart\",\"title\":\"Personal Attention\",\"description\":\"Client-focused consultation and representation tailored to your specific needs.\"},{\"icon\":\"shield\",\"title\":\"Professional Confidentiality\",\"description\":\"Handle client information with appropriate care and discretion.\"}]', 'why_choose', @now, @now),
-- How It Works
('how_it_works', '[{\"number\":\"01\",\"title\":\"Share Your Legal Matter\",\"description\":\"Tell us about your legal situation through our consultation form or direct contact.\",\"icon\":\"file-text\"},{\"number\":\"02\",\"title\":\"Book a Consultation\",\"description\":\"Schedule an online or offline consultation at a time that works for you.\",\"icon\":\"calendar\"},{\"number\":\"03\",\"title\":\"Understand Your Options\",\"description\":\"Receive clear explanation of your legal position and available options.\",\"icon\":\"lightbulb\"},{\"number\":\"04\",\"title\":\"Decide the Next Step\",\"description\":\"Make an informed decision about how to proceed with your legal matter.\",\"icon\":\"arrow-right\"}]', 'how_it_works', @now, @now);

-- ============================================================
-- PRACTICE AREAS
-- ============================================================
INSERT INTO `practice_areas` (`title`, `slug`, `short_description`, `description`, `icon`, `image`, `cta_label`, `is_featured`, `is_published`, `sort_order`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
('Criminal Law', 'criminal-lawyer-lakhimpur-kheri', 'Bail, FIR matters, criminal defence, trials, appeals and related proceedings.', '<p>Our criminal law practice covers bail applications, FIR matters, criminal defence, trials, appeals, and related proceedings. We provide dedicated legal representation to protect your rights throughout the criminal justice process.</p>', 'shield', '', 'Explore This Practice', 1, 1, 1, 'Criminal Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Expert criminal law services in Lakhimpur Kheri. Bail, FIR matters, criminal defence, trials and appeals by V P Singh Advocate.', @now, @now),
('Family Law', 'family-lawyer-lakhimpur-kheri', 'Divorce, matrimonial disputes, maintenance, domestic violence, child custody and related matters.', '<p>Family law matters require sensitivity and professional guidance. Our practice covers divorce, matrimonial disputes, maintenance, domestic violence, child custody, and related matters.</p>', 'heart', '', 'Explore This Practice', 0, 1, 2, 'Family Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Professional family law services in Lakhimpur Kheri. Divorce, custody, maintenance and domestic violence matters.', @now, @now),
('Civil Law', 'civil-lawyer-lakhimpur-kheri', 'Property disputes, recovery, injunctions, possession, contracts and civil proceedings.', '<p>Our civil law practice handles property disputes, recovery suits, injunctions, possession matters, contract disputes, and various civil proceedings.</p>', 'book-open', '', 'Explore This Practice', 0, 1, 3, 'Civil Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Civil law services in Lakhimpur Kheri. Property disputes, recovery, injunctions and civil proceedings.', @now, @now),
('Cyber Law', 'cyber-lawyer-lakhimpur-kheri', 'Online fraud, cybercrime, digital offences, identity theft and technology-related disputes.', '<p>Our cyber law practice addresses online fraud, cybercrime, digital offences, identity theft, and technology-related disputes in the digital age.</p>', 'monitor', '', 'Explore This Practice', 0, 1, 4, 'Cyber Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Cyber law services in Lakhimpur Kheri. Online fraud, cybercrime, digital offences and technology disputes.', @now, @now),
('Corporate & Commercial Law', 'corporate-lawyer-lakhimpur-kheri', 'Contracts, business disputes, commercial matters, legal notices and corporate legal support.', '<p>Our corporate and commercial law practice covers contracts, business disputes, commercial matters, legal notices, and comprehensive corporate legal support.</p>', 'briefcase', '', 'Explore This Practice', 0, 1, 5, 'Corporate Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Corporate and commercial law services in Lakhimpur Kheri. Contracts, business disputes and legal support.', @now, @now),
('Drugs & Cosmetics Law', 'drugs-cosmetics-lawyer-lakhimpur-kheri', 'Regulatory matters, licensing and proceedings under applicable legislation.', '<p>Our drugs and cosmetics law practice handles regulatory matters, licensing, and proceedings under applicable legislation governing pharmaceutical and cosmetic products.</p>', 'activity', '', 'Explore This Practice', 0, 1, 6, 'Drugs & Cosmetics Lawyer in Lakhimpur Kheri | V P Singh Advocate', 'Drugs and cosmetics law services in Lakhimpur Kheri. Regulatory matters, licensing and proceedings.', @now, @now);

-- ============================================================
-- ADVOCATE PROFILE
-- ============================================================
INSERT INTO `advocate_profile` (`name`, `designation`, `biography`, `profile_image`, `education`, `experience`, `court_info`, `practice_area_ids`, `memberships`, `credentials`, `created_at`, `updated_at`) VALUES
('V P Singh', 'Advocate', '<p>V P Singh is a legal professional based in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, providing legal consultation and representation across multiple areas of law.</p><p>With a commitment to clear communication and client-focused service, V P Singh assists individuals, families, and businesses with their legal matters.</p>', '', '', '', '', '[]', '', '', @now, @now);

-- ============================================================
-- LOCATIONS
-- ============================================================
INSERT INTO `locations` (`office_name`, `address`, `city`, `state`, `pin`, `phone`, `whatsapp`, `email`, `google_maps_url`, `latitude`, `longitude`, `office_hours`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
('V P Singh Advocate Office', 'Mohammadi Kheri', 'Lakhimpur Kheri', 'Uttar Pradesh', '', '', '', '', '', NULL, NULL, 'Monday - Saturday: 9:00 AM - 6:00 PM', '', 1, 1, @now, @now);

-- ============================================================
-- MENUS
-- ============================================================
INSERT INTO `menus` (`name`, `location`, `created_at`, `updated_at`) VALUES
('Main Navigation', 'header', @now, @now),
('Footer Navigation', 'footer', @now, @now);

-- Header Menu Items (menu_id = 1)
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `label`, `url`, `target`, `is_active`, `sort_order`, `css_class`, `is_cta`, `created_at`, `updated_at`) VALUES
(1, NULL, 'About', '/about', '_self', 1, 1, NULL, 0, @now, @now),
(1, NULL, 'Practice Areas', '/practice-areas', '_self', 1, 2, NULL, 0, @now, @now),
(1, NULL, 'Insights', '/blog', '_self', 1, 3, NULL, 0, @now, @now),
(1, NULL, 'Contact', '/contact', '_self', 1, 4, NULL, 0, @now, @now),
(1, NULL, 'Book Consultation', '/book-consultation', '_self', 1, 5, NULL, 1, @now, @now);

-- Footer Menu Items (menu_id = 2)
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `label`, `url`, `target`, `is_active`, `sort_order`, `css_class`, `is_cta`, `created_at`, `updated_at`) VALUES
(2, NULL, 'About', '/about', '_self', 1, 1, NULL, 0, @now, @now),
(2, NULL, 'Practice Areas', '/practice-areas', '_self', 1, 2, NULL, 0, @now, @now),
(2, NULL, 'Blog', '/blog', '_self', 1, 3, NULL, 0, @now, @now),
(2, NULL, 'Contact', '/contact', '_self', 1, 4, NULL, 0, @now, @now),
(2, NULL, 'Book Consultation', '/book-consultation', '_self', 1, 5, NULL, 0, @now, @now),
(2, NULL, 'Privacy Policy', '/privacy-policy', '_self', 1, 6, NULL, 0, @now, @now),
(2, NULL, 'Terms & Conditions', '/terms-conditions', '_self', 1, 7, NULL, 0, @now, @now),
(2, NULL, 'Legal Disclaimer', '/legal-disclaimer', '_self', 1, 8, NULL, 0, @now, @now),
(2, NULL, 'Refund Policy', '/refund-cancellation-policy', '_self', 1, 9, NULL, 0, @now, @now),
(2, NULL, 'Cookie Policy', '/cookie-policy', '_self', 1, 10, NULL, 0, @now, @now);

-- ============================================================
-- PAGES (Legal Pages)
-- ============================================================
INSERT INTO `pages` (`title`, `slug`, `content`, `template`, `is_published`, `sort_order`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES

-- 1. Privacy Policy
('Privacy Policy', 'privacy-policy', '<p>This Privacy Policy describes how V P Singh Advocate ("we", "our", or "us") collects, uses, stores, and protects your personal information when you visit our website or use our services. By accessing or using our website, you agree to the practices described in this policy.</p>

<h3>1. Information We Collect</h3>
<p>We may collect the following types of personal information:</p>
<ul>
<li><strong>Personal Identification Information:</strong> Name, email address, phone number, city, and other contact details you provide when submitting a contact form, booking a consultation, or communicating with us.</li>
<li><strong>Legal Matter Details:</strong> Information about your legal situation, case type, and related details you voluntarily share during consultations or enquiries.</li>
<li><strong>Payment Information:</strong> Transaction details such as UTR numbers and payment confirmation screenshots when you make a payment for consultation services.</li>
<li><strong>Technical Information:</strong> IP address, browser type, operating system, referring URLs, and pages visited, collected automatically through server logs and cookies.</li>
</ul>

<h3>2. How We Use Your Information</h3>
<p>We use the collected information for the following purposes:</p>
<ul>
<li>To provide legal consultation services and respond to your enquiries.</li>
<li>To process and manage your consultation bookings and payments.</li>
<li>To communicate regarding your legal matters, appointments, and service updates.</li>
<li>To improve our website, services, and user experience.</li>
<li>To comply with legal obligations and professional regulatory requirements.</li>
</ul>

<h3>3. Confidentiality</h3>
<p>All communications and information shared with V P Singh Advocate are treated as strictly confidential in accordance with the Advocates Act, 1961 and the Bar Council of India Rules. We do not disclose your personal information or case details to any third party without your explicit consent, except as required by law or court order.</p>

<h3>4. Data Security</h3>
<p>We implement appropriate technical and organisational security measures to protect your personal information against unauthorised access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>

<h3>5. Data Retention</h3>
<p>We retain your personal information only for as long as necessary to fulfil the purposes for which it was collected, or as required by applicable law and professional regulations. Consultation records may be retained for a period as mandated by the Bar Council of India.</p>

<h3>6. Third-Party Services</h3>
<p>Our website may use third-party services such as payment gateways (Razorpay) for processing transactions. These third parties have their own privacy policies governing the use of your information. We encourage you to review their privacy policies.</p>

<h3>7. Your Rights</h3>
<p>You have the right to:</p>
<ul>
<li>Access the personal information we hold about you.</li>
<li>Request correction of inaccurate or incomplete information.</li>
<li>Request deletion of your personal information, subject to legal and professional retention requirements.</li>
<li>Withdraw consent for data processing at any time.</li>
</ul>

<h3>8. Cookies</h3>
<p>Our website uses cookies to enhance your browsing experience and maintain session functionality. For detailed information, please refer to our <a href="/cookie-policy" class="text-bronze hover:underline">Cookie Policy</a>.</p>

<h3>9. Changes to This Policy</h3>
<p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. We encourage you to review this policy periodically.</p>

<h3>10. Contact Us</h3>
<p>If you have any questions about this Privacy Policy or wish to exercise your data rights, please contact us at:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>', 'default', 1, 10, 'Privacy Policy | V P Singh Advocate', 'Privacy policy of V P Singh Advocate. Learn how we collect, use, and protect your personal information.', @now, @now),

-- 2. Terms & Conditions
('Terms & Conditions', 'terms-conditions', '<p>By accessing and using the V P Singh Advocate website ("Website"), you agree to be bound by the following Terms and Conditions. If you do not agree with any part of these terms, please do not use this Website.</p>

<h3>1. About Us</h3>
<p>V P Singh Advocate is a legal practice based in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India, providing legal consultation and representation across multiple areas of law.</p>

<h3>2. Website Usage</h3>
<ul>
<li>The content on this Website is for general informational purposes only. It does not constitute legal advice.</li>
<li>You may not use this Website for any unlawful or unauthorised purpose.</li>
<li>You may not attempt to gain unauthorised access to any part of this Website, its servers, or any connected databases or systems.</li>
<li>We reserve the right to restrict access to certain areas of this Website at our discretion.</li>
</ul>

<h3>3. Intellectual Property</h3>
<p>All content on this Website, including text, graphics, logos, images, and layout, is the property of V P Singh Advocate and is protected under applicable intellectual property laws. You may not reproduce, distribute, modify, or create derivative works from any content without prior written consent.</p>

<h3>4. Consultation Services</h3>
<ul>
<li>Booking a consultation through this Website does not guarantee any specific outcome for your legal matter.</li>
<li>Legal matters are subject to various factors beyond the control of any legal practitioner.</li>
<li>An advocate-client relationship is established only upon formal engagement through a signed engagement letter or written agreement, not merely by visiting this Website or submitting a consultation form.</li>
<li>Information shared during consultations is treated as confidential in accordance with professional legal standards.</li>
</ul>

<h3>5. Payments</h3>
<ul>
<li>Consultation fees must be paid as per the published rates at the time of booking.</li>
<li>Payment does not guarantee a specific outcome of the legal matter.</li>
<li>Refunds are subject to our Refund and Cancellation Policy.</li>
<li>All payments are processed through secure payment gateways. We do not store your banking or card details.</li>
</ul>

<h3>6. Limitation of Liability</h3>
<p>To the maximum extent permitted by law:</p>
<ul>
<li>V P Singh Advocate shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of this Website.</li>
<li>We do not warrant that this Website will be available at all times, error-free, or free from viruses or other harmful components.</li>
<li>Any reliance you place on information from this Website is strictly at your own risk.</li>
</ul>

<h3>7. External Links</h3>
<p>This Website may contain links to third-party websites. We are not responsible for the content, privacy practices, or accuracy of any third-party websites.</p>

<h3>8. Governing Law</h3>
<p>These Terms and Conditions are governed by and construed in accordance with the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in Lakhimpur Kheri, Uttar Pradesh.</p>

<h3>9. Changes to These Terms</h3>
<p>We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on this page. Your continued use of this Website after any changes constitutes acceptance of the revised terms.</p>

<h3>10. Contact</h3>
<p>For questions regarding these Terms and Conditions, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>', 'default', 1, 11, 'Terms & Conditions | V P Singh Advocate', 'Terms and conditions for using the V P Singh Advocate website and consultation services.', @now, @now),

-- 3. Legal Disclaimer
('Legal Disclaimer', 'legal-disclaimer', '<p><strong>Important Notice — Please Read Carefully</strong></p>

<h3>1. No Legal Advice</h3>
<p>The information provided on this Website is for general informational and educational purposes only. It should not be treated as, or relied upon as, legal advice. No advocate-client relationship is created by viewing this Website, reading its content, or contacting us through this Website.</p>

<h3>2. No Advocate-Client Relationship</h3>
<p>Use of this Website, including the submission of contact forms, enquiry forms, or consultation booking forms, does not establish an advocate-client relationship. An advocate-client relationship is established only through a formal written engagement agreement signed by both parties.</p>
<p>Do not send confidential or sensitive information through contact forms or email until a formal advocate-client relationship has been established.</p>

<h3>3. Accuracy of Information</h3>
<p>While we make reasonable efforts to ensure that the information on this Website is accurate and up to date, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, or availability of the information, services, or related graphics contained on this Website.</p>

<h3>4. Legal Developments</h3>
<p>The information on this Website may not reflect the most current legal developments, judgments, verdicts, settlements, or legislation. Laws and legal interpretations are subject to change, and the information presented may become outdated.</p>

<h3>5. No Guarantee of Outcomes</h3>
<p>Any descriptions of past results, case studies, or practice area information on this Website do not guarantee or predict similar outcomes in future cases. Every legal matter is unique and depends on its specific facts and circumstances.</p>

<h3>6. Jurisdictional Limitations</h3>
<p>The legal information provided on this Website is primarily relevant to the jurisdiction of India, and specifically Uttar Pradesh. Laws vary by jurisdiction, and the information may not be applicable to your particular situation or location.</p>

<h3>7. Professional Standards</h3>
<p>V P Singh Advocate is registered with the Bar Council of India and adheres to the Advocates Act, 1961 and the Bar Council of India Rules of Professional Conduct and Etiquette.</p>

<h3>8. External Links</h3>
<p>This Website may contain links to external websites for reference purposes. We do not endorse, and are not responsible for, the content of any linked websites.</p>

<h3>9. Limitation of Liability</h3>
<p>V P Singh Advocate shall not be liable for any loss or damage, including without limitation, indirect or consequential loss or damage, arising from the use of this Website or reliance on any information provided herein.</p>

<h3>10. Contact for Legal Advice</h3>
<p>For specific legal advice regarding your situation, please schedule a consultation with V P Singh Advocate:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Phone: <a href="tel:+919876543210" class="text-bronze hover:underline">+91 98765 43210</a><br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>', 'default', 1, 12, 'Legal Disclaimer | V P Singh Advocate', 'Legal disclaimer for V P Singh Advocate website. No legal advice, no advocate-client relationship.', @now, @now),

-- 4. Refund & Cancellation Policy (NEW)
('Refund & Cancellation Policy', 'refund-cancellation-policy', '<p>This Refund and Cancellation Policy outlines the terms governing refunds and cancellations for consultation services provided by V P Singh Advocate.</p>

<h3>1. Consultation Booking</h3>
<p>When you book a consultation through our Website, you are required to pay the consultation fee as displayed at the time of booking. Payment confirms your consultation booking and secures your scheduled time slot.</p>

<h3>2. Cancellation by Client</h3>
<ul>
<li><strong>More than 24 hours before the scheduled consultation:</strong> You may request a cancellation by contacting us at least 24 hours before your scheduled consultation time. A full refund will be processed within 5-7 business days.</li>
<li><strong>Less than 24 hours before the scheduled consultation:</strong> Cancellations made less than 24 hours before the scheduled time may be subject to a cancellation fee of 50% of the consultation fee.</li>
<li><strong>No-show:</strong> If you fail to attend the scheduled consultation without prior notice, the consultation fee will not be refunded.</li>
</ul>

<h3>3. Rescheduling</h3>
<p>You may request to reschedule your consultation at no additional cost if the request is made at least 12 hours before the scheduled time. Rescheduling is subject to availability.</p>

<h3>4. Cancellation by V P Singh Advocate</h3>
<p>In the event that V P Singh Advocate needs to cancel or reschedule a consultation due to unforeseen circumstances, you will be offered a full refund or the option to reschedule at your convenience, at no additional cost.</p>

<h3>5. Refund Process</h3>
<ul>
li>Refund requests should be submitted via email to <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a> with your booking ID and reason for the refund request.</li>
<li>Refunds will be processed within 5-7 business days from the date of approval.</li>
<li>Refunds will be made to the original payment method. In case of UPI or bank transfer payments, refunds will be processed to the same account.</li>
</ul>

<h3>6. Non-Refundable Situations</h3>
<p>The following are not eligible for refunds:</p>
<ul>
li>Consultation fees after the consultation has been completed.</li>
li>Fees for additional follow-up consultations unless cancelled in accordance with this policy.</li>
<li>Fees for representation in court or any other legal proceedings (governed by separate engagement terms).</li>
</ul>

<h3>7. Disputes</h3>
<p>If you have any concerns about a charge or refund, please contact us within 7 days of the transaction. We will review your case and respond within 3 business days.</p>

<h3>8. Changes to This Policy</h3>
<p>We reserve the right to update this Refund and Cancellation Policy at any time. Changes will be posted on this page with an updated effective date.</p>

<h3>9. Contact</h3>
<p>For refund or cancellation requests, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>', 'default', 1, 13, 'Refund & Cancellation Policy | V P Singh Advocate', 'Refund and cancellation policy for V P Singh Advocate consultation services.', @now, @now),

-- 5. Cookie Policy (NEW)
('Cookie Policy', 'cookie-policy', '<p>This Cookie Policy explains how V P Singh Advocate ("we", "our", or "us") uses cookies and similar technologies when you visit our website. This policy helps you understand what cookies are, how we use them, and how you can manage your cookie preferences.</p>

<h3>1. What Are Cookies?</h3>
<p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work efficiently, provide a better user experience, and supply information to the website owners.</p>

<h3>2. How We Use Cookies</h3>
<p>We use cookies for the following purposes:</p>
<ul>
<li><strong>Essential Cookies:</strong> These are necessary for the Website to function properly. They enable core features such as session management, security (CSRF protection), and form submissions. Without these cookies, the Website cannot function correctly.</li>
<li><strong>Session Cookies:</strong> These temporary cookies exist only while you browse the Website. They are used to maintain your session state and are automatically deleted when you close your browser.</li>
<li><strong>Functional Cookies:</strong> These cookies remember your preferences and settings to provide a personalised experience.</li>
</ul>

<h3>3. Specific Cookies We Use</h3>
<table class="w-full text-sm border-collapse">
<thead>
<tr class="border-b border-charcoal/10">
<th class="text-left py-3 pr-4 font-medium">Cookie Name</th>
<th class="text-left py-3 pr-4 font-medium">Purpose</th>
<th class="text-left py-3 font-medium">Duration</th>
</tr>
</thead>
<tbody>
<tr class="border-b border-charcoal/5">
<td class="py-3 pr-4">ci_session</td>
<td class="py-3 pr-4">Maintains your session state across page requests</td>
<td class="py-3">Session</td>
</tr>
<tr class="border-b border-charcoal/5">
<td class="py-3 pr-4">csrf_cookie_name</td>
<td class="py-3 pr-4">Protects against Cross-Site Request Forgery attacks</td>
<td class="py-3">2 hours</td>
</tr>
</tbody>
</table>

<h3>4. Third-Party Cookies</h3>
<p>We may use third-party services that set their own cookies:</p>
<ul>
<li><strong>Google Fonts:</strong> Used to load custom fonts. Google may set cookies to serve fonts efficiently.</li>
<li><strong>Razorpay:</strong> If you make a payment, Razorpay may set cookies for payment processing and fraud prevention.</li>
</ul>
<p>We do not control third-party cookies. Please refer to the respective third-party privacy policies for more information.</p>

<h3>5. Managing Cookies</h3>
<p>You can control and manage cookies through your browser settings. Most browsers allow you to:</p>
<ul>
<li>View what cookies are set and delete them individually.</li>
<li>Block third-party cookies.</li>
<li>Block all cookies (this may affect Website functionality).</li>
<li>Delete all cookies when you close your browser.</li>
</ul>
<p>For instructions on managing cookies in popular browsers, visit:</p>
<ul>
<li><a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-bronze hover:underline">Google Chrome</a></li>
<li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" class="text-bronze hover:underline">Mozilla Firefox</a></li>
<li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" class="text-bronze hover:underline">Apple Safari</a></li>
<li><a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" class="text-bronze hover:underline">Microsoft Edge</a></li>
</ul>

<h3>6. Impact of Disabling Cookies</h3>
<p>If you disable or reject cookies, some parts of this Website may not function properly. Specifically:</p>
<ul>
li>You may not be able to log in to the admin panel.</li>
li>Form submissions may not work correctly.</li>
li>Your session may not persist across pages.</li>
</ul>

<h3>7. Changes to This Policy</h3>
<p>We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated effective date.</p>

<h3>8. Contact</h3>
<p>If you have questions about our use of cookies, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>', 'default', 1, 14, 'Cookie Policy | V P Singh Advocate', 'Cookie policy for V P Singh Advocate website. Learn about cookies we use and how to manage them.', @now, @now),

-- 6. Homepage
('Homepage', 'home', NULL, 'home', 1, 0, 'V P Singh Advocate | Legal Consultation & Representation | Lakhimpur Kheri', 'Professional legal consultation and representation by V P Singh Advocate in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh.', @now, @now);

-- ============================================================
-- PAGE SECTIONS (Homepage)
-- ============================================================
INSERT INTO `page_sections` (`page_id`, `section_key`, `section_title`, `section_content`, `sort_order`, `is_visible`, `created_at`, `updated_at`) VALUES
(4, 'featured_practice_area', 'Featured Practice Area', '{"practice_area_id":1,"description":"Expert criminal law services including bail applications, FIR matters, criminal defence, trials, and appeals."}', 1, 1, @now, @now),
(4, 'why_choose', 'Why Choose V P Singh', NULL, 2, 1, @now, @now),
(4, 'how_it_works', 'How It Works', NULL, 3, 1, @now, @now),
(4, 'testimonials', 'What Clients Say', NULL, 4, 1, @now, @now),
(4, 'cta_banner', 'Need Legal Assistance?', '{"heading":"Schedule a Legal Consultation","description":"Professional legal guidance for your specific matter.","cta_label":"Book Consultation","cta_url":"/book-consultation"}', 5, 1, @now, @now);

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- SETUP COMPLETE
-- ============================================================
-- Default Admin Login:
--   Email: admin@vpsinghadvocate.com
--   Password: Admin@123
--
-- Default Editor Login:
--   Email: editor@vpsinghadvocate.com
--   Password: Admin@123
-- ============================================================
