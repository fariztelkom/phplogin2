<?php
require 'db.php';
session_start();

if (isset($_POST['username'], $_POST['password'])) {
    // TODO C1-4: Validate input
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    if (empty($user) || empty($pass)) {
        die('Username and password are required.');
    }

    // TODO C1-5: Hash the password before storing
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    // TODO C1-4: Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO accounts (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $hashedPass);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        // TODO C4-2: Log error instead of displaying it
        error_log('Database error: ' . $stmt->error);
        die('Registration failed. Please try again.');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form method="POST">
    <label>Username:</label><input type="text" name="username" required><br>
    <label>Password:</label><input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
</body>
</html>