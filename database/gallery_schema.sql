-- Table structure for table `gallery_images`

CREATE TABLE IF NOT EXISTS gallery_images (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `event_category` varchar(50) NOT NULL, -- workshops, events, community, competitions
  `description` text,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
