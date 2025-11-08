<?php
session_start();

function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireAdminAuth() {
    if (!isAdminLoggedIn()) {
        header('Location: ../login.html');
        exit;
    }
}

// Call this function at the top of any admin page
// requireAdminAuth();
?>