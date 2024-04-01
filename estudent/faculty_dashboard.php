<?php
session_start();

// Check if user is logged in and is a faculty
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'faculty') {
    // Redirect to login page if not logged in or not a faculty
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
        <nav>
            <ul>
                <li><a href="faculty_dashboard.php">Management</a></li>
                <li><a href="index.html">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Management and Notifications</h2>
        <h3>Teacher Profiles</h3>
        <p>Manage teacher profiles, including salary, benefits, and other details:</p>
        <!-- Add form or table for managing teacher profiles -->

        <h3>Notifications</h3>
        <ul>
            <li><strong>Teacher Notifications:</strong> Receive updates about teacher schedules, events, and school announcements.</li>
            <li><strong>School Notifications:</strong> Stay informed about school-wide policies, events, and important announcements.</li>
        </ul>
    </div>
</body>
</html>
