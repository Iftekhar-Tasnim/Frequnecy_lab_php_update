CREATE TABLE IF NOT EXISTS `publications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `type` ENUM('journal', 'conference', 'profile', 'article', 'thesis') NOT NULL DEFAULT 'article',
    `title` VARCHAR(255) NOT NULL,
    `abstract` TEXT NULL,
    `authors` VARCHAR(500) NULL,
    `publisher` VARCHAR(255) NULL,
    `publication_date` DATE NULL,
    `link` VARCHAR(500) NOT NULL,
    `pdf_url` VARCHAR(500) NULL,
    `image_url` VARCHAR(500) NULL,
    `tags` JSON NULL,
    `is_featured` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
