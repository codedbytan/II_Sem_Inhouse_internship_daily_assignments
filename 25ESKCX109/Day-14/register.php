<?php
// Day 14 - Sign up: create a user account
include("db_connect.php");

$message = "";
$class = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required";
        $class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address";
        $class = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters";
        $class = "error";
    } else {
        // Never store plain passwords - hash them
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Account created! You can now log in.";
            $class = "success";
        } elseif (mysqli_errno($conn) == 1062) {
            $message = "Username or email already exists";
            $class = "error";
        } else {
            $message = "Database error: " . mysqli_error($conn);
            $class = "error";
        }
    }
}

include("header.php");
?>

<div class="card">
    <h1>Create Account</h1>

    <?php if ($message !== "") : ?>
        <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <label>Username</label>
        <input type="text" name="username" placeholder="Choose a username">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimum 6 characters">

        <button type="submit" name="submit">Register</button>
        <a class="link" href="login.php">Already have an account? Login</a>
    </form>
</div>

<?php include("footer.php"); ?>
