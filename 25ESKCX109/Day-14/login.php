<?php
// Day 14 - Login: verify credentials and start a session
include("db_connect.php");

$message = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Please enter username and password";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        // password_verify checks the typed password against the stored hash
        if ($user && password_verify($password, $user['password'])) {
            // Start the session and remember who is logged in
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Invalid username or password";
        }
    }
}

include("header.php");
?>

<div class="card">
    <h1>Login</h1>

    <?php if ($message !== "") : ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your username">

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password">

        <button type="submit" name="submit">Login</button>
        <a class="link" href="register.php">New here? Create an account</a>
    </form>
</div>

<?php include("footer.php"); ?>
