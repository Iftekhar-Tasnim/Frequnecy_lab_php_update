-- Create Publications Table
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

-- Seed Data using logical idempotency (INSERT IF NOT EXISTS)

-- Profiles
INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'profile', 'IEEE Author Profile', 'https://ieeexplore.ieee.org/author/37087127618', NULL, 1
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'IEEE Author Profile');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'profile', 'Tahmidul Kabir – Extracurricular Activities Profile', 'https://sites.google.com/view/tahmidul-kabir/extracurricular-activities?authuser=0', NULL, 1
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Tahmidul Kabir – Extracurricular Activities Profile');

-- Journals
INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'Asian Journal of Contemporary Technology – Article 1', 'https://www.asianssr.org/index.php/ajct/article/view/1143', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Asian Journal of Contemporary Technology – Article 1');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'Asian Journal of Contemporary Technology – Article 2', 'https://www.asianssr.org/index.php/ajct/article/view/1144', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Asian Journal of Contemporary Technology – Article 2');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'International Journal of Informatics and Communication Technology (IJICT)', 'https://ijict.iaescore.com/index.php/IJICT/article/view/20404', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'International Journal of Informatics and Communication Technology (IJICT)');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'International Journal of Reconfigurable and Embedded Systems (IJRES)', 'https://ijres.iaescore.com/index.php/IJRES/article/view/20545', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'International Journal of Reconfigurable and Embedded Systems (IJRES)');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'International Journal of Electrical and Computer Engineering (IJEECS)', 'https://ijeecs.iaescore.com/index.php/IJEECS/article/view/29384', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'International Journal of Electrical and Computer Engineering (IJEECS)');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'journal', 'International Journal of Public Health Science (IJPHS)', 'https://ijphs.iaescore.com/index.php/IJPHS/article/view/22577', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'International Journal of Public Health Science (IJPHS)');

-- Articles
INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'A deep learning and machine learning approach to predict neonatal death in the context of São Paulo', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2024-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'A deep learning and machine learning approach to predict neonatal death in the context of São Paulo');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'An intelligent wind turbine with yaw mechanism using machine learning to reduce high-cost sensors quantity', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2023-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'An intelligent wind turbine with yaw mechanism using machine learning to reduce high-cost sensors quantity');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Smart vehicle management by using sensors and an IoT based black box', 'https://www.researchgate.net/profile/A-Z-M-Kabir', NULL, 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Smart vehicle management by using sensors and an IoT based black box');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Smart vehicle management system for accident reduction by using sensors and an IoT based black box', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2021-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Smart vehicle management system for accident reduction by using sensors and an IoT based black box');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'A review on notification sending methods to the recipients in different technology-based women safety solutions', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2022-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'A review on notification sending methods to the recipients in different technology-based women safety solutions');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'An IoT Based Intelligent Parking System for the Unutilized Parking Area With Real-Time Monitoring Using Mobile and Web Application', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2021-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'An IoT Based Intelligent Parking System for the Unutilized Parking Area With Real-Time Monitoring Using Mobile and Web Application');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Data Augmentation Technique to Expand Road Dataset Using Mask RCNN and Image Inpainting', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2021-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Data Augmentation Technique to Expand Road Dataset Using Mask RCNN and Image Inpainting');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'IoT Based Smart Home Automation and Security System Using Mobile App With Assistant Robot for Developing Countries', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2021-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'IoT Based Smart Home Automation and Security System Using Mobile App With Assistant Robot for Developing Countries');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'A Comprehensive Smart IoT Tracker for the Children, Elder, and Luggage With the Assistance of Mobile App', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2020-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'A Comprehensive Smart IoT Tracker for the Children, Elder, and Luggage With the Assistance of Mobile App');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Safety Solution for Women Using Smart Band and CWS App', 'https://www.researchgate.net/publication/342887095_Safety_Solution_for_Women_Using_Smart_Band_and_CWS_App', '2020-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Safety Solution for Women Using Smart Band and CWS App');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'IoT Based Low Cost Smart Indoor Farming Management System Using an Assistant Robot and Mobile App', 'https://www.researchgate.net/profile/A-Z-M-Kabir', '2020-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'IoT Based Low Cost Smart Indoor Farming Management System Using an Assistant Robot and Mobile App');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Automated Parking System with Fee Management Using Arduino', 'https://aiub.academia.edu/AZMTahmidulKabir', '2019-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Automated Parking System with Fee Management Using Arduino');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Six Tier Multipurpose Security Locker System Based on Arduino', 'https://aiub.academia.edu/AZMTahmidulKabir', '2019-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Six Tier Multipurpose Security Locker System Based on Arduino');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'An Intelligent Street Light System Based on Piezoelectricity Generator with Noticeable Zebra Crossing Point and Bus Stand', 'https://aiub.academia.edu/AZMTahmidulKabir', '2019-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'An Intelligent Street Light System Based on Piezoelectricity Generator with Noticeable Zebra Crossing Point and Bus Stand');

INSERT INTO `publications` (`type`, `title`, `link`, `publication_date`, `is_featured`)
SELECT 'article', 'Intelligent Path-Finder for The Blind', 'https://aiub.academia.edu/AZMTahmidulKabir', '2019-01-01', 0
WHERE NOT EXISTS (SELECT 1 FROM `publications` WHERE `title` = 'Intelligent Path-Finder for The Blind');
