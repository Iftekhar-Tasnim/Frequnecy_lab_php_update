<?php
/**
 * Contact Form Email Handler for Frequency Lab
 * 
 * This script processes contact form submissions and sends emails
 * to support@flabbd.com using the hosting SMTP service.
 * 
 * Security Features:
 * - Input validation and sanitization
 * - Header injection prevention
 * - Honeypot spam protection
 * - Rate limiting ready
 * - Database storage for all submissions
 * 
 * Note: Email sending is currently disabled. All messages are stored in the database.
 */

// Error reporting - disable in production
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set response header
header('Content-Type: application/json');

// Include database connection
require_once __DIR__ . '/config/db.php';

// Contact form processing only saves to database
// SMTP configuration removed

/**
 * Send JSON response and exit
 */
function sendResponse($success, $message, $data = []) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

/**
 * Validate email address
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Sanitize input to prevent XSS
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Check for email header injection attempts
 */
function hasHeaderInjection($string) {
    $patterns = ['/\r/', '/\n/', '/bcc:/i', '/cc:/i', '/to:/i', '/content-type:/i'];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $string)) {
            return true;
        }
    }
    return false;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method. Only POST requests are allowed.');
}

// Check for honeypot (spam protection)
if (!empty($_POST['website'])) {
    // Honeypot field should be empty - this is likely a bot
    sendResponse(false, 'Form submission failed. Please try again.');
}

// Retrieve and validate form data
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
$message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

// Validate required fields
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!isValidEmail($email)) {
    $errors[] = 'Invalid email address';
}

if (empty($subject)) {
    $errors[] = 'Subject is required';
}

if (empty($message)) {
    $errors[] = 'Message is required';
}

// Check for header injection attempts
if (hasHeaderInjection($name) || hasHeaderInjection($email) || hasHeaderInjection($subject)) {
    $errors[] = 'Invalid characters detected in form data';
}

// If validation fails, return errors
if (!empty($errors)) {
    sendResponse(false, 'Please correct the following errors:', ['errors' => $errors]);
}

// Save to database
try {
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (name, email, phone, subject, message, ip_address, user_agent) 
        VALUES (:name, :email, :phone, :subject, :message, :ip_address, :user_agent)
    ");
    
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':subject' => $subject,
        ':message' => $message,
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]);
    
    $message_id = $pdo->lastInsertId();
    
} catch (PDOException $e) {
    // Log database error but continue with email
    error_log("Database error in contact form: " . $e->getMessage());
    // Don't fail the submission if database save fails
}

// Email sending disabled - only saving to database
// Logic removed for clarity

// Return success if saved to database
if (isset($message_id)) {
    sendResponse(true, 'Thanks for contacting us! We have received your message.');
} else {
    // Fallback if DB failed and Email is disabled
    sendResponse(false, 'There was a system error. Please try again later.');
}
