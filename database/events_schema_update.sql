-- Table structure for table `gallery_events`

CREATE TABLE IF NOT EXISTS `gallery_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add event_id to gallery_images if it doesn't exist
-- Note: This is a safe way to add a column only if it's missing in MySQL via a procedure or just trying to run it and catching error in app code. 
-- For simplicity in this raw SQL script, we will use a separate ALTER statement which might fail if column exists, but that is acceptable for this dev env.

SET @dbname = DATABASE();
SET @tablename = "gallery_images";
SET @columnname = "event_id";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  "SELECT 1",
  "ALTER TABLE gallery_images ADD COLUMN event_id INT(11) DEFAULT NULL;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;
