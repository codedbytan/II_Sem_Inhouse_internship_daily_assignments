<?php
// Day 13 - READ: list all registered students
include("db_connect.php");

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 13 - Student Records (CRUD)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page">
    <div class="topbar">
        <h1>Student Records</h1>
        <a class="btn" href="register.php">+ Add Student</a>
    </div>

    <?php if (isset($_GET['msg'])) : ?>
        <div class="notice"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roll No</th>
            <th>Mobile</th>
            <th>Branch</th>
            <th>Actions</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['roll']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['branch']); ?></td>
                    <td class="actions">
                        <a class="edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr><td colspan="7" class="empty">No students registered yet.</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
