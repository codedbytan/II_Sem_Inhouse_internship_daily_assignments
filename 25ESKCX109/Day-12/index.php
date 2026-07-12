<?php
include("db_connect.php");

$message = "";
$class = "";

if (isset($_POST['submit'])) {
    // Read and trim inputs
    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $roll   = trim($_POST['roll']);
    $mobile = trim($_POST['mobile']);
    $branch = trim($_POST['branch']);

    // Server-side validation
    if (empty($name) || empty($email) || empty($roll) || empty($mobile) || empty($branch)) {
        $message = "All fields are required";
        $class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address";
        $class = "error";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $message = "Mobile number must be 10 digits";
        $class = "error";
    } else {
        // Prepared statement prevents SQL injection
        $check = mysqli_prepare($conn, "SELECT id FROM students WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $message = "This email is already registered";
            $class = "error";
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO students (name, email, roll, mobile, branch) VALUES (?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $roll, $mobile, $branch);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Registration successful!";
                $class = "success";
            } else {
                $message = "Database error: " . mysqli_error($conn);
                $class = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 12 - Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>STUDENT REGISTRATION FORM</h1>

<div class="container">

    <?php if ($message !== "") : ?>
        <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter your full name">

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email">

        <label>Roll Number</label>
        <input type="text" name="roll" placeholder="e.g. 25ESKCX109">

        <label>Mobile Number</label>
        <input type="tel" name="mobile" placeholder="10-digit mobile number">

        <label>Branch</label>
        <select name="branch">
            <option value="">Select Branch</option>
            <option>Data Science (DS)</option>
            <option>Computer Science (CS)</option>
            <option>IT</option>
            <option>ECE</option>
        </select>

        <button type="submit" name="submit">Register</button>
    </form>

</div>

</body>
</html>
