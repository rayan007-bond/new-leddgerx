<?php
session_start();
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', 'sql305.infinityfree.com');
define('DB_USER', 'if0_40349999');
define('DB_PASS', 'Fasihajan28');   // Enter your CP password here
define('DB_NAME', 'if0_40349999_ledgerx_blog');


// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Simple validation
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields']);
        exit;
    }
    
    // For demo purposes - in production, use proper password hashing
    // Default credentials: admin / admin123
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_role'] = 'admin';
        $_SESSION['login_time'] = time();
        
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>