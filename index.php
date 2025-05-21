<?php
session_start();

// TODO C0-1: Redirect all traffic to HTTPS
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit;
}

// Generate a CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="POST" action="authenticate.php"> <!-- TODO C1-1: Changed GET to POST -->
  <label>Username:</label><input type="text" name="username" required><br>
  <label>Password:</label><input type="password" name="password" required><br>
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"> <!-- CSRF token -->
  <button type="submit">Login</button>
</form>
<p>Belum punya akun? <a href="register.php">Register di sini</a></p>
</body>
</html>