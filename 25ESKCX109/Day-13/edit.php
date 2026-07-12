<?php
// Day 13 - part 1 of UPDATE: show the edit form pre-filled with the student's data
include("db_connect.php");

// We need an id in the URL, e.g. edit.php?id=5
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

// If no such student, go back
if (!$student) {
    header("Location: index.php?msg=Student not found");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 13 - Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-page">
    <h1>Edit Student</h1>

    <form method="POST" action="update.php">
        <!-- Hidden id tells update.php which row to change -->
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

        <label>Full Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>">

        <label>Email Address</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>">

        <label>Roll Number</label>
        <input type="text" name="roll" value="<?php echo htmlspecialchars($student['roll']); ?>">

        <label>Mobile Number</label>
        <input type="tel" name="mobile" value="<?php echo htmlspecialchars($student['mobile']); ?>">

        <label>Branch</label>
        <select name="branch">
            <?php
            $branches = ["Data Science (DS)", "Computer Science (CS)", "IT", "ECE"];
            foreach ($branches as $b) {
                // Pre-select the student's current branch
                $selected = ($student['branch'] === $b) ? "selected" : "";
                echo "<option $selected>$b</option>";
            }
            ?>
        </select>

        <button type="submit" name="update">Update</button>
        <a class="back" href="index.php">Cancel</a>
    </form>
</div>

</body>
</html>
