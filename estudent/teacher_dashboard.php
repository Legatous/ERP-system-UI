<?php
session_start();

// Check if user is logged in and is a teacher
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    // Redirect to login page if not logged in or not a teacher
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
        <nav>
            <ul>
                <li><a href="teacher_dashboard.php">Curriculum</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Curriculum Management</h2>
        <!-- Add curriculum management options for teachers -->
        <p>As a teacher, you can edit, add, and delete curriculum items here.</p>
    </div>
</body>
</html>
