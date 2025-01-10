<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in

    // Check if there's a success parameter in the URL
    $success = isset($_GET['success']) && $_GET['success'] === '1';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="styles.css?v=1.0">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        /* Centering Styles */
        .bigContainer {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: flex-start; /* Align form to the top */
    min-height: 50vh; /* Minimum height of 50% of the viewport */
    padding: 20px; /* Add padding to avoid cramped layout */
    box-sizing: border-box; /* Ensure padding doesn't affect width calculations */
    margin-top: 20px;
}


        .success-animation p {
            text-align: center;
            font-size: 1.2rem;
            color: green;
        }

        .success-animation .cta-button {
            display: block;
            text-align: center;
            margin: 20px auto;
        }

        .centered {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Community Events</div>
        <nav>
            <ul>
                <li><a href="index.html">Welcome</a></li>
                <li><a href="events.html">Explore Events</a></li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="dashboard.php">My Dashboard</a>
                    <?php else: ?>
                        <a href="javascript:void(0)" onclick="redirectToLogin('dashboard.php')">My Dashboard</a>
                    <?php endif; ?>
                </li>
                <li><a href="gallery.html">Gallery</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
                   
    <main>
        <section>
        <video autoplay muted loop playsinline style="width: 100%; height: 200vh; object-fit: cover; display: block;">
            <source src="community2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content-overlay">
            <h1>Welcome to Community Events</h1>
            <p>Empowering individuals to create a positive impact through community service.</p>
            <a href="events.html" class="cta-button">Get Started</a>
        </div>
                </section> 
    </main>
    
        <section class="contact_us">
            <div class="bigContainer">
                <?php if ($success): ?>
                    <!-- Success Animation -->
                    <div class="success-animation">
                        <div class="center-container">
                        <lottie-player 
                            src="success.json" 
                            background="transparent" 
                            speed="1" 
                            autoplay 
                            loop 
                            style="width: 200px; height: 200px;">
                        </lottie-player>
                    </div>
                        <p style="text-align: center; font-size: 1.2rem; color: green;">Event created successfully!</p>
                        <a href="events.html" class="cta-button" style="display: block; text-align: center; margin: 20px auto;">Go to Events</a>
                    </div>

                <?php elseif (!$isLoggedIn): ?>
                    <!-- Prompt Login -->
                    <div class="alert">
                        <p>Please <a href="login.php">log in</a> to create an event.</p>
                    </div>
                <?php else: ?>
                    <!-- Event Creation Form -->
                    <div class="form-container">
                        <h2 class="heading">Create an Event</h2>
                        <form id="create-event-form" method="POST" action="submit_event.php">
                            <div class="fullNameArea">
                                <label for="eventTitle" class="cardHead">Event Title</label>
                                <input id="eventTitle" name="eventTitle" type="text" placeholder="Enter event title" required>
                            </div>

                            <div class="emailArea">
                                <label for="eventDescription" class="cardHead">Event Description</label>
                                <textarea id="eventDescription" name="eventDescription" rows="5" placeholder="Describe your event" required></textarea>
                            </div>

                            <div class="firstRow">
                                <div class="dateArea">
                                    <label for="startDate" class="cardHead">Start Date</label>
                                    <input id="startDate" name="startDate" type="date" required>
                                </div>
                                <div class="dateArea">
                                    <label for="endDate" class="cardHead">End Date</label>
                                    <input id="endDate" name="endDate" type="date" required>
                                </div>
                            </div>

                            <div class="firstRow">
                                <div class="timeArea">
                                    <label for="startTime" class="cardHead">Start Time</label>
                                    <input id="startTime" name="startTime" type="time" required>
                                </div>
                                <div class="timeArea">
                                    <label for="endTime" class="cardHead">End Time</label>
                                    <input id="endTime" name="endTime" type="time" required>
                                </div>
                            </div>

                            <div class="fullNameArea">
                                <label for="location" class="cardHead">Location</label>
                                <input id="location" name="location" type="text" placeholder="Enter event location" required>
                            </div>

                            <div class="fullNameArea">
                                <label for="maxParticipants" class="cardHead">Maximum Participants</label>
                                <input id="maxParticipants" name="maxParticipants" type="number" min="1" placeholder="Enter max participants" required>
                            </div>

                            <div class = "centered" ><button type="submit" class="submit-button">Create Event</button> </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    

    <footer>
        <p>&copy; Ali Haram 20220861. All rights reserved.</p>
    </footer>
</body>

</html>
