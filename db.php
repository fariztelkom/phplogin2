<?php
// TODO C4-1: Use minimum privilege database user before deploying
$con = mysqli_connect('localhost', 'your_db_user', 'your_secure_password', 'phplogin');

if (!$con) {
    error_log('Koneksi MySQL gagal: ' . mysqli_connect_error());
    die('Database connection failed.'); // Do not expose detailed errors to users
}
?>