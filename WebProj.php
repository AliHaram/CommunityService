<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="styles.css?v=1.0">
<?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Events</title>
    
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<style>
    #events{
        text-decoration: none;
        color: black;
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

                <li><a href="create_event.php">Create Event</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <video autoplay muted loop playsinline>
            <source src="20241225_1448_Community Spirit in Action_simple_compose_01jfytbmzhea6sz32ggkeb5g31.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content-overlay">
            <h1>Welcome to Community Events</h1>
            <p>Empowering individuals to create a positive impact through community service.</p>
            <a href="events.html" class="cta-button">Get Started</a>
        </div>
    </main>

    

    <section id="featured-events">
        <h2 style = "color: #0056b3">Upcoming Events</h2>
        <div class="events-grid">
            <a href = "events.html" id = "events">
            <div>
                <h3>Wayfarer Program</h3>
                <p>Assist in serving daily hot meals to 350-400 individuals in need at Alisar's headquarters in Amman.</p>
            </div>
                </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>Educate the Youth Program</h3>
                <p>Join Diddyucation Inc.'s summer programs to empower youth with knowledge about preparing for the future.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>Medical Volunteer Opportunities</h3>
                <p>Mentor aspiring healthcare providers by helping with MCAT/USMLE prep, resume building, and more.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>Grenzenlos Program</h3>
                <p>Support children and communities in refugee camps through JHASi Jordan's impactful initiatives.</p>
            </div> </a>
        </div>
    </section>

    <section id="explore-events">
        <h2 style="text-align: center; color: #0056b3;">Explore Events</h2>
        <div class="events-grid">
        <a href = "events.html" id = "events">
            <div>
                <h3>Save the Ocean Program</h3>
                <p>Volunteer with Masri Co. to clean the ocean floors in Aqaba and contribute to marine conservation.</p>
            </div>
                </a>
                <a href = "events.html" id = "events">
            <div>
                <h3>Field Visits Program</h3>
                <p>Participate with Faris United in field visits, learning about agricultural practices and providing food aid.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>Sama Albadia</h3>
                <p>Assist youth in challenging backgrounds through after-school programs with International Volunteer HQ in Amman.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>King Hussein Cancer Foundation</h3>
                <p>Support the fight against cancer by joining the Siwar Al Hussein Volunteering Program.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>The Children's Museum</h3>
                <p>Enhance your professional and social skills through one of Jordan's best volunteering experiences.</p>
            </div> </a>
            <a href = "events.html" id = "events">
            <div>
                <h3>SOS Children's Villages Jordan</h3>
                <p>Advocate for children's rights and provide them with the love and support they deserve.</p>
            </div></a>
        </div>
    </section>

    <section id="contact" class="contact_us">
        <div class="bigContainer">
            <div class="image-container">
                <!-- Lottie Animation -->
                <lottie-player
    src="Newsletter.json"
    background="transparent"
    speed="1"
    loop
    autoplay>
</lottie-player>


            </div>
            <div class="form-container">
                <h2 class="heading">Get in Touch</h2>
                <form class="formTable" id="contact-form">
                    <div class="firstRow">
                        <div class="fullNameArea">
                            <label for="fullName" class="cardHead">Full Name</label>
                            <input class="fullName" id="fullName" name="fullName" type="text" placeholder="Enter your name" required>
                        </div>
                        <div class="emailArea">
                            <label for="email" class="cardHead">Email Address</label>
                            <input class="email" id="email" name="email" type="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="messageArea">
                        <label for="message" class="cardHead">Message</label>
                        <textarea class="message" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="submit-button">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Ali Haram. All rights reserved.</p>
    </footer>

</body>

</html>
