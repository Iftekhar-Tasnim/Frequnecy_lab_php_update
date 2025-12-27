-- Database Schema for Frequency Lab

-- Users Table (Admin & Staff)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL DEFAULT 'staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Team Members Table
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    designation VARCHAR(100) NOT NULL COMMENT 'e.g. CEO, Advisor',
    category ENUM('board', 'advisor', 'executive') NOT NULL,
    bio TEXT,
    image_path VARCHAR(255),
    social_links JSON COMMENT '{"linkedin": "url", "email": "url"}',
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed Initial Admin User (Default Password: password123)
-- Note: Replace hash with generated one in production
INSERT INTO users (username, password_hash, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
