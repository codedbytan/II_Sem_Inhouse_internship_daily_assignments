<?php
// Day 13 - DELETE: remove a student by id
include("db_connect.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php?msg=Student deleted successfully");
    exit;
} else {
    echo "Delete failed: " . mysqli_error($conn);
}
?>
