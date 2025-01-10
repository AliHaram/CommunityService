<?php
// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = "";     // Default password for XAMPP
$dbname = "events_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize messages
$success_message = "";
$error_message = "";

// Check for a success message from the registration page
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user record
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password matches; start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name']; // Store the user's name
            $_SESSION['email'] = $user['email'];
            $redirectPage = isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard.php';
header("Location: $redirectPage");
            exit;
        } else {
            // Password doesn't match
            $error_message = "Invalid email or password. Please try again.";
        }
    } else {
        // Email not found
        $error_message = "Invalid email or password. Please try again.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <video autoplay muted loop playsinline>
        <source src="loginVid.mp4" type="video/mp4">
        Your browser does not support the video.
    </video>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h2>Login</h2>

            <!-- Display success message dynamically -->
            <?php if (!empty($success_message)): ?>
                <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>

            <!-- Display error message dynamically -->
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <div class="input-field">
                <input type="email" name="email" required>
                <label>Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Enter your password</label>
            </div>
            <label id="signup" style = "color: white;">Don't have an account? <a id="signupButton" href="register.php" style = "color: white;">Sign Up</a></label>

            <button type="submit">Log In</button>
        </form>
    </div>
</body>

</html>
