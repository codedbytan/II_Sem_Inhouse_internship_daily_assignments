<?php
// Day 13 - CREATE: add a new student
include("db_connect.php");

$message = "";
$class = "";

if (isset($_POST['submit'])) {
    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $roll   = trim($_POST['roll']);
    $mobile = trim($_POST['mobile']);
    $branch = trim($_POST['branch']);

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
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO students (name, email, roll, mobile, branch) VALUES (?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $roll, $mobile, $branch);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the list with a success message
            header("Location: index.php?msg=Student added successfully");
            exit;
        } else {
            // Error 1062 = duplicate entry (email is UNIQUE)
            if (mysqli_errno($conn) == 1062) {
                $message = "This email is already registered";
            } else {
                $message = "Database error: " . mysqli_error($conn);
            }
            $class = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 13 - Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-page">
    <h1>Add Student</h1>

    <?php if ($message !== "") : ?>
        <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter full name">

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter email">

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

        <button type="submit" name="submit">Save</button>
        <a class="back" href="index.php">Back to list</a>
    </form>
</div>

</body>
</html>
