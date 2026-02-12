<?php
session_start();

// saari session values clear
$_SESSION = [];

// session cookie bhi remove (optional but best)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// session destroy
session_destroy();

// redirect back
header("Location: index.php");
exit;
