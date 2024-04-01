<?php
session_start();

// Check if user is logged in and is a teacher
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    // Redirect to login page if not logged in or not a teacher
    header('Location: login.php');
    exit();
}

// Include database connection and CRUD functions
require_once 'db.php'; // Assuming db.php contains your database connection and functions

// Example: Fetch student data from the database
$students = fetchStudents(); // Implement this function to fetch students from the database

// Example: Fetch curriculum data from the database
$curriculum = fetchCurriculum(); // Implement this function to fetch curriculum from the database
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
                <li><a href="teacher_dashboard.php">Manage Students</a></li>
                <li><a href="profile.php">View Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Manage Students</h2>
        <!-- Student Management Section -->
        <div>
            <!-- Add forms or tables for managing students -->
            <!-- Example: Display student data in a table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['name']; ?></td>
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Curriculum Management Section -->
        <h2>Manage Curriculum</h2>
        <div>
            <!-- Add forms or tables for managing curriculum -->
            <!-- Example: Display curriculum data in a list -->
            <ul>
                <?php foreach ($curriculum as $item): ?>
                    <li><?php echo $item['title']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Additional sections for managing curriculum, vacations, benefits, etc. -->
    </div>
</body>
</html>
