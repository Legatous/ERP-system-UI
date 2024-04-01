<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    // Redirect to login page if not logged in or not a student
    header('Location: login.php');
    exit();
}

// Include database connection and functions to fetch assignments and materials
require_once 'db.php'; // Assuming db.php contains your database connection and functions

// Example: Fetch assignments assigned to the logged-in student from the database
$assignments = fetchAssignments($_SESSION['user']['id']); // Implement this function to fetch assignments for the student

// Example: Fetch materials assigned to the logged-in student from the database
$materials = fetchMaterials($_SESSION['user']['id']); // Implement this function to fetch materials for the student
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
                <li><a href="student_dashboard.php">Curriculum</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="grades.php">Grades</a></li>
                <li><a href="school.php">School</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Curriculum</h2>
        <!-- Display curriculum content here -->
        <p>This is the curriculum content that only students can view.</p>
        
        <h2>Assignments</h2>
        <ul>
            <?php foreach ($assignments as $assignment): ?>
                <li><?php echo $assignment['title']; ?></li>
                <!-- Display more details of the assignment if needed -->
            <?php endforeach; ?>
        </ul>
        
        <h2>Materials</h2>
        <ul>
            <?php foreach ($materials as $material): ?>
                <li><?php echo $material['title']; ?></li>
                <!-- Display more details of the material if needed -->
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
