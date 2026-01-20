<?php
/**
 * CacheManager - File-based caching system
 * 
 * Provides simple file-based caching with automatic expiration
 * and pattern-based invalidation for improved performance.
 */
class CacheManager {
    private $cacheDir;
    private $defaultTTL = 3600; // 1 hour default

    /**
     * Constructor
     * @param string $cacheDir Directory to store cache files
     */
    public function __construct($cacheDir = null) {
        if ($cacheDir === null) {
            // Default to cache directory in project root
            $cacheDir = dirname(__DIR__) . '/cache';
        }
        
        $this->cacheDir = rtrim($cacheDir, '/\\');
        
        // Create cache directory if it doesn't exist
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Generate cache file path from key
     * @param string $key Cache key
     * @return string Full path to cache file
     */
    private function getCacheFilePath($key) {
        // Sanitize key to prevent directory traversal
        $safeKey = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $key);
        return $this->cacheDir . '/' . $safeKey . '.cache';
    }

    /**
     * Get cached data
     * @param string $key Cache key
     * @return mixed|null Cached data or null if not found/expired
     */
    public function get($key) {
        $filePath = $this->getCacheFilePath($key);
        
        // Check if cache file exists
        if (!file_exists($filePath)) {
            return null;
        }

        // Read cache file
        $content = @file_get_contents($filePath);
        if ($content === false) {
            return null;
        }

        // Decode cache data
        $data = json_decode($content, true);
        if ($data === null) {
            // Invalid cache file, delete it
            @unlink($filePath);
            return null;
        }

        // Check expiration
        if (isset($data['expires']) && time() > $data['expires']) {
            // Cache expired, delete it
            @unlink($filePath);
            return null;
        }

        return $data['value'] ?? null;
    }

    /**
     * Store data in cache
     * @param string $key Cache key
     * @param mixed $value Data to cache
     * @param int $ttl Time to live in seconds (default: 1 hour)
     * @return bool Success status
     */
    public function set($key, $value, $ttl = null) {
        if ($ttl === null) {
            $ttl = $this->defaultTTL;
        }

        $filePath = $this->getCacheFilePath($key);
        
        $data = [
            'key' => $key,
            'value' => $value,
            'created' => time(),
            'expires' => time() + $ttl
        ];

        $content = json_encode($data, JSON_PRETTY_PRINT);
        
        // Write cache file
        $result = @file_put_contents($filePath, $content, LOCK_EX);
        
        return $result !== false;
    }

    /**
     * Delete specific cache entry
     * @param string $key Cache key
     * @return bool Success status
     */
    public function delete($key) {
        $filePath = $this->getCacheFilePath($key);
        
        if (file_exists($filePath)) {
            return @unlink($filePath);
        }
        
        return true; // Already deleted
    }

    /**
     * Clear cache by pattern
     * @param string $pattern Pattern to match (e.g., 'gallery_*')
     * @return int Number of files deleted
     */
    public function clear($pattern = '*') {
        $count = 0;
        
        // Convert pattern to regex
        $regex = '/^' . str_replace('*', '.*', preg_quote($pattern, '/')) . '\.cache$/';
        
        // Scan cache directory
        $files = @scandir($this->cacheDir);
        if ($files === false) {
            return 0;
        }

        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === '.htaccess' || $file === 'index.php') {
                continue;
            }

            if (preg_match($regex, $file)) {
                $filePath = $this->cacheDir . '/' . $file;
                if (@unlink($filePath)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * Clear all cache
     * @return int Number of files deleted
     */
    public function clearAll() {
        return $this->clear('*');
    }

    /**
     * Get cache statistics
     * @return array Statistics about cache
     */
    public function getStats() {
        $files = @scandir($this->cacheDir);
        if ($files === false) {
            return [
                'total_files' => 0,
                'total_size' => 0,
                'expired_files' => 0
            ];
        }

        $totalFiles = 0;
        $totalSize = 0;
        $expiredFiles = 0;

        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === '.htaccess' || $file === 'index.php') {
                continue;
            }

            $filePath = $this->cacheDir . '/' . $file;
            if (is_file($filePath) && pathinfo($file, PATHINFO_EXTENSION) === 'cache') {
                $totalFiles++;
                $totalSize += filesize($filePath);

                // Check if expired
                $content = @file_get_contents($filePath);
                if ($content !== false) {
                    $data = json_decode($content, true);
                    if (isset($data['expires']) && time() > $data['expires']) {
                        $expiredFiles++;
                    }
                }
            }
        }

        return [
            'total_files' => $totalFiles,
            'total_size' => $totalSize,
            'total_size_formatted' => $this->formatBytes($totalSize),
            'expired_files' => $expiredFiles
        ];
    }

    /**
     * Format bytes to human-readable format
     * @param int $bytes Number of bytes
     * @return string Formatted string
     */
    private function formatBytes($bytes) {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Clean up expired cache files
     * @return int Number of files deleted
     */
    public function cleanExpired() {
        $count = 0;
        $files = @scandir($this->cacheDir);
        
        if ($files === false) {
            return 0;
        }

        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === '.htaccess' || $file === 'index.php') {
                continue;
            }

            $filePath = $this->cacheDir . '/' . $file;
            if (is_file($filePath) && pathinfo($file, PATHINFO_EXTENSION) === 'cache') {
                $content = @file_get_contents($filePath);
                if ($content !== false) {
                    $data = json_decode($content, true);
                    if (isset($data['expires']) && time() > $data['expires']) {
                        if (@unlink($filePath)) {
                            $count++;
                        }
                    }
                }
            }
        }

        return $count;
    }
}
?>
