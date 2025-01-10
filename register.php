<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = "";     // Default password for XAMPP
$dbname = "events_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Set success message and redirect to login page
            $_SESSION['success_message'] = "Registration successful! Please log in.";
            header("Location: login.php");
            exit;
        } else {
            $error_message = "Something went wrong! Please try again.";
        }
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
    <title>Signup</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <video autoplay muted loop playsinline>
        <source src="loginVid.mp4" type="video/mp4">
        Your browser does not support the video.
    </video>
    <div class="wrapper">
        <!-- Display error message if exists -->
        <?php if (!empty($error_message)): ?>
            <div class="banner error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <h2>Signup</h2>
            <div class="input-field">
                <input type="text" name="name" required>
                <label>Enter your name</label>
            </div>
            <div class="input-field">
                <input type="email" name="email" required>
                <label>Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Create your password</label>
            </div>
            <div class="input-field">
                <input type="password" name="confirm_password" required>
                <label>Re-enter your password</label>
            </div>
            <button type="submit">Sign Up</button>
        </form> <br>
        <div class="signin-link">
    <p style = "color: white;">Already have an account? <a href="login.php" style = "color: white;">Sign in</a></p>
</div>
    </div>
</body>

</html>
