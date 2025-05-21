<?php
session_start();
require 'db.php';

// TODO C1-2: Use POST + CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';

    // TODO: Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('CSRF validation failed.');
    }

    // TODO C1-3: Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT id, password FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $res = $stmt->get_result();

    // TODO C1-6: Verify password using password_verify()
    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // TODO C2-1: Regenerate session ID
            session_regenerate_id();

            $_SESSION['account_loggedin'] = true;
            $_SESSION['account_id'] = $row['id'];
            $_SESSION['account_name'] = $user;

            header('Location: home.php');
            exit;
        }
    }

    // TODO C0-2: Implement brute-force limit
    echo 'Username / password salah';
} else {
    // Handle GET request or show login form
    echo 'Invalid request method.';
}
?>