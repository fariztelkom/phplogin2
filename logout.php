<?php
session_start();

// TODO C2-3: Clear all session data before destroying the session
$_SESSION = [];

// TODO C2-4: Regenerate session ID to deactivate the old session
session_destroy();
session_start(); // Start a new session
session_regenerate_id(true); // Regenerate the session ID

header('Location: index.php');
exit;
?>