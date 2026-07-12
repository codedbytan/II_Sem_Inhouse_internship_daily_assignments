<?php
// Day 13 - part 2 of UPDATE: save the edited student back to the database
include("db_connect.php");

if (isset($_POST['update'])) {
    $id     = (int) $_POST['id'];
    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $roll   = trim($_POST['roll']);
    $mobile = trim($_POST['mobile']);
    $branch = trim($_POST['branch']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE students SET name = ?, email = ?, roll = ?, mobile = ?, branch = ? WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $roll, $mobile, $branch, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?msg=Student updated successfully");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
} else {
    // Someone opened update.php directly without submitting the form
    header("Location: index.php");
    exit;
}
?>
