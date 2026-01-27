-- Migration: Add indexes to gallery_images table for performance optimization
-- Created: 2026-01-27
-- Purpose: Improve query performance for gallery filtering and pagination

-- Add index on programme_id for faster JOIN operations
ALTER TABLE gallery_images 
ADD INDEX idx_programme_id (programme_id);

-- Add index on upload_date for faster ORDER BY operations
ALTER TABLE gallery_images 
ADD INDEX idx_upload_date (upload_date DESC);

-- Add composite index for combined filtering and sorting
-- This is used when filtering by programme AND sorting by date
ALTER TABLE gallery_images 
ADD INDEX idx_programme_date (programme_id, upload_date DESC);

-- Note: Primary key is already defined in table creation (001_initial_schema.sql)
-- No need to add it again here
