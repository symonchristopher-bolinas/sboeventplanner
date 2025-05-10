<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventSync</title>
    <link rel="stylesheet" href="style/adminstyle.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">Event<span style="color:blue;">Sync</span></div>
        <nav>
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><a href="aboutus.php">About Us</a></li>

                <?php if (isset($_SESSION['client_logged_in'])): ?>
                    <li><?php echo htmlspecialchars($_SESSION['client_email']); ?></li>
                    <li><a href="account/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="account/login.php">Sign In</a></li>
                <?php endif; ?>
                
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="overlay">
            <h1>WELCOME TO <span style="color:black;">Event</span><span style="color:blue;">Sync</span></h1>
            <p>LET'S START A PLAN</p>
            <div class="buttons">
                <a href="#" class="btn propose">PROPOSE PLAN</a>
                <a href="#" class="btn read">Read more</a>
            </div>
        </div>
    </section>
</body>
</html>
