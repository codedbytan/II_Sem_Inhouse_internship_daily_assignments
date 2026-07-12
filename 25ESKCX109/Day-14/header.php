<?php
// Shared header. Every page includes this so the session is always started
// and the navigation bar is consistent.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 14 - Login System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="brand">Student Portal</div>
    <div class="nav-links">
        <?php if (isset($_SESSION['username'])) : ?>
            <span>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else : ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="content">
