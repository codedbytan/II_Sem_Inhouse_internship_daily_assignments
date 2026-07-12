<?php
// Day 14 - Dashboard: a protected page only logged-in users can see
session_start();

// Guard: if there is no active session, kick the visitor to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include("header.php");
?>

<div class="card">
    <h1>Dashboard</h1>
    <p class="welcome">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
    <p>You are logged in. This page is protected and cannot be opened without logging in.</p>

    <div class="dash-grid">
        <div class="tile">Profile</div>
        <div class="tile">My Courses</div>
        <div class="tile">Settings</div>
    </div>

    <a class="logout-btn" href="logout.php">Logout</a>
</div>

<?php include("footer.php"); ?>
