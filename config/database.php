<?php
define('DB_HOST', 'sql305.infinityfree.com');
define('DB_USER', 'if0_40349999');
define('DB_PASS', 'Fasihajan28');   // Enter your CP password here
define('DB_NAME', 'if0_40349999_ledgerx_blog');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>