<?php
/**
 * Cache Manager Test Script
 * Run this script to verify the caching system is working correctly
 * 
 * Usage: php test_cache.php
 */

require_once 'includes/CacheManager.php';

echo "==============================================\n";
echo "Cache Manager Test Script\n";
echo "==============================================\n\n";

$cache = new CacheManager();
$passed = 0;
$failed = 0;

// Test 1: Set and Get
echo "[Test 1] Set and Get Cache...\n";
$testData = ['message' => 'Hello, Cache!', 'timestamp' => time()];
$cache->set('test_key', $testData, 60);
$result = $cache->get('test_key');

if ($result !== null && $result['message'] === 'Hello, Cache!') {
    echo "✓ PASSED: Cache set and retrieved successfully\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Could not retrieve cached data\n\n";
    $failed++;
}

// Test 2: Cache Expiration
echo "[Test 2] Cache Expiration...\n";
$cache->set('expire_test', 'This will expire', 1);
echo "Waiting 2 seconds for cache to expire...\n";
sleep(2);
$result = $cache->get('expire_test');

if ($result === null) {
    echo "✓ PASSED: Cache expired correctly\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Cache did not expire\n\n";
    $failed++;
}

// Test 3: Delete Cache
echo "[Test 3] Delete Cache...\n";
$cache->set('delete_test', 'Delete me', 60);
$cache->delete('delete_test');
$result = $cache->get('delete_test');

if ($result === null) {
    echo "✓ PASSED: Cache deleted successfully\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Cache was not deleted\n\n";
    $failed++;
}

// Test 4: Pattern Clear
echo "[Test 4] Pattern Clear...\n";
$cache->set('gallery_page1', 'data1', 60);
$cache->set('gallery_page2', 'data2', 60);
$cache->set('other_data', 'data3', 60);
$count = $cache->clear('gallery_*');

$result1 = $cache->get('gallery_page1');
$result2 = $cache->get('gallery_page2');
$result3 = $cache->get('other_data');

if ($result1 === null && $result2 === null && $result3 !== null && $count === 2) {
    echo "✓ PASSED: Pattern clear worked correctly ($count files cleared)\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Pattern clear did not work as expected\n\n";
    $failed++;
}

// Test 5: Cache Statistics
echo "[Test 5] Cache Statistics...\n";
$cache->set('stats_test1', 'data', 60);
$cache->set('stats_test2', 'data', 60);
$stats = $cache->getStats();

if (isset($stats['total_files']) && $stats['total_files'] >= 2) {
    echo "✓ PASSED: Cache statistics retrieved\n";
    echo "  - Total Files: {$stats['total_files']}\n";
    echo "  - Total Size: {$stats['total_size_formatted']}\n";
    echo "  - Expired Files: {$stats['expired_files']}\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Could not retrieve cache statistics\n\n";
    $failed++;
}

// Test 6: Complex Data Types
echo "[Test 6] Complex Data Types...\n";
$complexData = [
    'array' => [1, 2, 3],
    'nested' => ['key' => 'value'],
    'number' => 42,
    'boolean' => true,
    'null' => null
];
$cache->set('complex_test', $complexData, 60);
$result = $cache->get('complex_test');

if ($result !== null && 
    $result['array'] === [1, 2, 3] && 
    $result['nested']['key'] === 'value' &&
    $result['number'] === 42 &&
    $result['boolean'] === true) {
    echo "✓ PASSED: Complex data types cached correctly\n\n";
    $passed++;
} else {
    echo "✗ FAILED: Complex data types not cached correctly\n\n";
    $failed++;
}

// Cleanup
echo "[Cleanup] Clearing all test cache...\n";
$cache->clearAll();
echo "✓ Test cache cleared\n\n";

// Summary
echo "==============================================\n";
echo "Test Summary\n";
echo "==============================================\n";
echo "Passed: $passed\n";
echo "Failed: $failed\n";
echo "Total:  " . ($passed + $failed) . "\n\n";

if ($failed === 0) {
    echo "✓ ALL TESTS PASSED! Cache system is working correctly.\n";
    exit(0);
} else {
    echo "✗ SOME TESTS FAILED! Please check the cache system.\n";
    exit(1);
}
?>
