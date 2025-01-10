<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in to cancel event registration.");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID and event ID
$user_id = $_SESSION['user_id'];
$event_id = intval($_POST['event_id']);

// Delete the registration from the database
$sql_delete = "DELETE FROM registrations WHERE user_id = ? AND event_id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("ii", $user_id, $event_id);

if ($stmt_delete->execute()) {
    $_SESSION['success_message'] = "Event registration cancelled successfully.";
} else {
    $_SESSION['error_message'] = "Failed to cancel event registration. Please try again later.";
}

$conn->close();

// Redirect back to the dashboard
header("Location: dashboard.php");
exit;
?>