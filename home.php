<?php
session_start();
require 'db.php';

// TODO C2-2: Set cookie flags
ini_set('session.cookie_secure', '1'); // Secure flag
ini_set('session.cookie_httponly', '1'); // HttpOnly flag
ini_set('session.cookie_samesite', 'Strict'); // SameSite flag

if (!isset($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['account_name']); // TODO C3-1: Escape output ?></h2>
<p><a href="profile.php?id=<?php echo htmlspecialchars($_SESSION['account_id']); ?>">Lihat Profil</a></p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>