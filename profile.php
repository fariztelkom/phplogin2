<?php
require 'db.php';
session_start();

// Ensure the user is logged in and only viewing their own profile
if (!isset($_SESSION['account_loggedin']) || !isset($_GET['id']) || $_GET['id'] != $_SESSION['account_id']) {
    header('Location: home.php');
    exit;
}

$id = $_SESSION['account_id']; // Use the session ID for the query

// TODO C1-7: Use prepared statement to prevent SQL injection
$stmt = $con->prepare("SELECT fullname, email FROM accounts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
<h2>Profil Pengguna</h2>
<p>Nama Lengkap: <?php echo htmlspecialchars($row['fullname']); // TODO C3-3: Escape output ?></p>
<p>Email: <?php echo htmlspecialchars($row['email']); // TODO C3-4: Escape output ?></p>
<p><a href="home.php">Kembali</a></p>
</body>
</html>
<?php
} else {
    echo 'Profil tidak ditemukan.';
}
?>