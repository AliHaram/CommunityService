<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header("Location: login.php?error=Please login to access the dashboard.");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's details
$user_id = $_SESSION['user_id'];
$user_name = htmlspecialchars($_SESSION['user_name']);

// Fetch registered events for the user
$sql = "SELECT events.id, events.title, events.description, events.location, events.start_date, events.start_time, events.end_time 
        FROM events 
        INNER JOIN registrations ON events.id = registrations.event_id 
        WHERE registrations.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Menu</h2>
            <nav>
                <ul>
                    <li><a href="events.html">Explore Events</a></li>
                    <li><a href="my_events.html">My Events</a></li>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Welcome back, <?php echo $user_name; ?>!</h1>
                <p>Discover your dashboard insights below.</p>
            </header>

            <!-- Dashboard Cards -->
            <section class="dashboard-cards">
                <div class="card">
                    <h3>Upcoming Events</h3>
                    <p>Check out the events you've registered for.</p>
                    <a href="events.html">View Events</a>
                </div>
                <div class="card">
                    <h3>Create an Event</h3>
                    <p>Host a new event for the community.</p>
                    <a href="create_event.php">Create Now</a>
                </div>
                <div class="card">
                    <h3>Manage Profile</h3>
                    <p>Update your personal details and preferences.</p>
                    <a href="profile.html">Edit Profile</a>
                </div>
            </section>

            <!-- Events Section -->
            <section class="events-section" id="events-section">
                <h2>Registered Events</h2>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="event-card">
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($row['start_date']); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($row['start_time']); ?> - <?php echo htmlspecialchars($row['end_time']); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-events">You have not registered for any events yet.</p>
                <?php endif; ?>
            </section>
        <!-- Cancel Event Section -->
        <section class="cancel-event-section">
            <h2>Cancel Event Registration</h2>
            <form action="cancel_event.php" method="post">
                    <label for="event_id">Select Event to Cancel:</label>
                    <select name="event_id" id="event_id" required>
                        <?php
                        // Fetch registered events for the dropdown
                        $result->data_seek(0); // Reset result pointer to the beginning
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['title']) . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit">Cancel Registration</button>
                </form>
        </section>

        
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
