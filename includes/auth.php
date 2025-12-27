<?php
session_start();
require_once __DIR__ . '/../config/db.php';

class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Login Function
    public function login($username_or_email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username_or_email, $username_or_email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Set Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }

        return false;
    }

    // Logout Function
    public function logout() {
        session_unset();
        session_destroy();
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Check Role Middleware
    public function checkRole($requiredRole = null) {
        if (!$this->isLoggedIn()) {
            return false;
        }

        if ($requiredRole === 'admin' && $_SESSION['role'] !== 'admin') {
            return false;
        }

        return true;
    }

    // Redirect if not authenticated
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: ../admin/login.php');
            exit;
        }
    }
}

// Initialize Auth
$auth = new Auth($pdo);
