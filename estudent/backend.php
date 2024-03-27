<?php

session_start();

// Check if user is logged in
if (isset($_SESSION['user'])) {
    // Redirect logged-in users to their respective dashboards
    if ($_SESSION['user']['role'] === 'faculty') {
        header('Location: faculty_dashboard.php');
        exit();
    } elseif ($_SESSION['user']['role'] === 'teacher') {
        header('Location: teacher_dashboard.php');
        exit();
    } else {
        header('Location: student_dashboard.php');
        exit();
    }
}

// Login Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sample user data (replace with database)
    $users = [
        ['id' => 1, 'username' => 'teacher123', 'password' => 'password', 'role' => 'teacher'],
        ['id' => 2, 'username' => 'student123', 'password' => 'password', 'role' => 'student'], // Example student ID
        ['id' => 3, 'username' => 'faculty123', 'password' => 'password', 'role' => 'faculty']
    ];

    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedIn = false;

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user'] = $user;
            $loggedIn = true;
            break;
        }
    }

    if ($loggedIn) {
        // Redirect to the appropriate dashboard based on user role
        if ($_SESSION['user']['role'] === 'faculty') {
            header('Location: faculty_dashboard.php');
            exit();
        } elseif ($_SESSION['user']['role'] === 'teacher') {
            header('Location: teacher_dashboard.php');
            exit();
        } else {
            header('Location: student_dashboard.php');
            exit();
        }
    } else {
        $message = 'Invalid username or password';
    }
}

// Logout Logic
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.html');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudent</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <div>
                <label for="username">Student ID:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($message)): ?>
            <div id="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
