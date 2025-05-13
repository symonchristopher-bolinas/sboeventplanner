<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventSync</title>
    <link rel="stylesheet" href="style/adminstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> 
</head>
<body>
    <header class="navbar">
        <div class="logo">Event<span style="color:blue;">Sync</span></div>
        <nav>
    <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="calendar1.php">Calendar</a></li>
        
        <!-- Only show user dropdown if admin or client is logged in -->
        <?php if (isset($_SESSION['admin_logged_in']) || isset($_SESSION['client_logged_in'])): ?>
            <li>
    <div class="admin-info">
        <i class="icon-calendar"></i>
        <i class="icon-bell"></i>

        <!-- Display role if set -->
        <?php if (isset($_SESSION['role'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['role']); ?></span>
        <?php endif; ?>

        <!-- Display client email if set -->
        <?php if (isset($_SESSION['client_email'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['client_email']); ?></span>
        <?php endif; ?>

        <!-- User Dropdown -->
        <div class="user-dropdown" id="userDropdown">
            <i class="fa-solid fa-user dropdown-toggle" onclick="toggleDropdown()"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'superadmin'): ?>
                    <a href="account/admin_dashboard.php">Admin Dashboard</a>
                <?php endif; ?>
                <a href="account/logout.php">Logout</a>
            </div>
        </div>
    </div>
</li>

        <?php else: ?>
            <!-- Show sign in only if no one is logged in -->
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
    <!-- Dropdown Script -->
<script>
function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

document.addEventListener("click", function(event) {
    const dropdown = document.getElementById("userDropdown");
    const menu = document.getElementById("dropdownMenu");
    if (!dropdown.contains(event.target)) {
        menu.style.display = "none";
    }
});
</script>
</body>
</html>
