<?php
$phpPath = "C:\\xampp\\php\\php.exe"; // Update this with the path to your PHP executable

// Set the correct PHP executable path
ini_set('php_path', $phpPath);

session_start();

// Database connection
$servername = "localhost"; // Change this if your database is on a different server
$username = "your_username"; // Change this to your MySQL username
$password = "your_password"; // Change this to your MySQL password
$dbname = "database"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    $user = validateUser($conn, $username, $password);

    if ($user) {
        // Set session data for the authenticated user
        $_SESSION['user'] = $user;
        // Redirect to the appropriate dashboard based on the user's role
        switch ($user['role']) {
            case 'teacher':
                header('Location: teacher_dashboard.php');
                exit();
                break;
            case 'student':
                header('Location: student_dashboard.php');
                exit();
                break;
            case 'faculty':
                header('Location: faculty_dashboard.php');
                exit();
                break;
        }
    } else {
        $message = 'Invalid username or password';
    }
}

function validateUser($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <div>
                <label for="username">Username:</label>
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
