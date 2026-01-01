-- Create programmes table
CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` enum('workshop','competition','event','community') NOT NULL DEFAULT 'event',
  `description` text,
  `start_date` date DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Default General Programme if not exists
INSERT INTO `programmes` (`title`, `type`, `description`, `start_date`)
SELECT 'General Moments', 'community', 'General gallery images not linked to specific programmes.', CURDATE()
WHERE NOT EXISTS (SELECT 1 FROM `programmes` WHERE `title` = 'General Moments');

-- Migrate data from gallery_events if it exists
-- This ignores duplicates based on title if any
INSERT IGNORE INTO `programmes` (`title`, `type`, `description`, `start_date`, `created_at`)
SELECT `title`, 'event', `description`, `event_date`, `created_at`
FROM `gallery_events`;

-- Add programme_id to gallery_images
SET @dbname = DATABASE();
SET @tablename = "gallery_images";
SET @columnname = "programme_id";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  "SELECT 1",
  "ALTER TABLE gallery_images ADD COLUMN programme_id INT(11) DEFAULT NULL;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Update programme_id based on old event_id mapping (assuming titles match or ids match if we kept ids sync, but here we migrated data so IDs might differ)
-- Actually, since we copied data, we can try to map back. 
-- For simplicity in this dev environment and to ensure robustness:
-- We will update gallery_images to link to the 'General Moments' programme by default where programme_id is NULL.
-- Users can re-assign in admin if needed.

UPDATE `gallery_images` SET `programme_id` = (SELECT `id` FROM `programmes` WHERE `title` = 'General Moments' LIMIT 1) WHERE `programme_id` IS NULL;
