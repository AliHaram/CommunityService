<?php
session_start();

// Include the database connection
include 'db_connection.php'; // Adjust the path if saved in a subfolder like 'includes/'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['eventTitle'];
    $description = $_POST['eventDescription'];
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];
    $start_time = $_POST['startTime'];
    $end_time = $_POST['endTime'];
    $location = $_POST['location'];
    $max_participants = $_POST['maxParticipants'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO events (title, description, start_date, end_date, start_time, end_time, location, max_participants) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssi", $title, $description, $start_date, $end_date, $start_time, $end_time, $location, $max_participants);

        if ($stmt->execute()) {
            // Redirect to the events page with a success message
            header('Location: create_event.php?success=1');
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
