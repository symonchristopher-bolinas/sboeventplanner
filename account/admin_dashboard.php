<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/dashboard_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
</head>
<body>

<header class="topbar">
    <div class="logo">EVENT ADMIN PORTAL</div>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../contactus.php">Contact Us</a>
        <a href="../aboutus.php">About Us</a>
        <a href="../calendar1.php">Calendar</a>
        <div class="admin-info">
            <i class="icon-calendar"></i>
            <i class="icon-bell"></i>
            <span><?php echo htmlspecialchars($_SESSION['role']); ?></span>

            <!-- User Dropdown -->
            <div class="user-dropdown" id="userDropdown">
                <i class="fa-solid fa-user dropdown-toggle" onclick="toggleDropdown()"></i>
                <div class="dropdown-menu" id="dropdownMenu">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'superadmin'): ?>
                        <a href="admin_dashboard.php">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>



<aside class="sidebar">
    <div class="toggle-btn">&#9776;</div>
    <ul>
        <li id="dashboardTab" class="active">Dashboard</li>
        <li id="userManagementTab">User Management</li>
        <li>Event Monitoring</li>
        <li>Budget Analytics</li>
        <li id="venueTab">Venue</li>
    </ul>
</aside>

<!-- Dashboard Content -->
<div id="dashboardContent">
<main class="content">
    <h1>Dashboard</h1>
    <p>Welcome back! Here's what's happening today.</p>

    <div class="cards">
        <div class="card">
            <h3>Events</h3>
            <p>3 <span class="positive">+1%</span></p>
            <small>1 new today</small>
        </div>
        <div class="card">
            <h3>Budget</h3>
            <p>₱ 20,000.00 <span class="positive">+2%</span></p>
            <small>1 this month</small>
        </div>
        <div class="card">
            <h3>Active Users</h3>
            <p>6 <span class="positive">+1%</span></p>
            <small>2 online now</small>
        </div>
        <div class="card">
            <h3>Support Ticket</h3>
            <p>1 <span class="negative">-2%</span></p>
            <small>1 unresolved</small>
        </div>
    </div>

    <div class="charts">
        <canvas id="eventsChart" width="400" height="200"></canvas>

        <div class="calendar">
            <h3>APRIL 2025</h3>
            <img src="calendar_image.png" alt="Calendar" width="300">
            <div class="legend">
                <span class="green"></span> Available Schedule
                <span class="red"></span> Not Available
                <span class="orange"></span> Pending
            </div>
        </div>
    </div>
</main>
</div>

<!-- User Management Content -->
<div id="userManagementContent" style="display:none;">
    <main class="content" >
        <h1 style="margin-bottom: 0;">User Management</h1>
        <p style="margin-top: 5px; color: #666;">Manage user department and accounts</p>
        <div>
            <a href="signup.php" class="add-user-btn" style="background-color: #28a745; color: white; padding: 8px 16px; border: none; border-radius: 20px; float: right; cursor: pointer;" >+ Add User</a>
        </div>
        <div style="margin: 20px 0; clear: both;">
      <input type="text" placeholder="Search User..." style="width: 50%; padding: 8px; border-radius: 20px; border: 1px solid #ccc;">
    </div>
        <table  style="width: 100%; border-collapse: collapse;" width="100%" id="userTable">
            <thead>
                <tr style="background-color: #003366; color: white; padding: 10px;">
                    <th>Email</th>
                    <th>Department</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">
                <!-- Filled dynamically -->
            </tbody>
        </table>
    </main>
</div>


<!-- Venue Content -->
<div id="venueContent" style="display:none;">
    <main class="content" >
        <h1 style="margin-bottom: 0;">Venue Management</h1>
        <div>
            <a href="venue.php" class="add-user-btn" style="background-color: #28a745; color: white; padding: 8px 16px; border: none; border-radius: 20px; float: right; cursor: pointer;" >+ Add Venue</a>
        </div>
        <div style="margin: 20px 0; clear: both;">
      <input type="text" placeholder="Search User..." style="width: 50%; padding: 8px; border-radius: 20px; border: 1px solid #ccc;">
    </div>
        <table style="width: 100%; border-collapse: collapse;" width="100%" id="venueTable">
            <thead>
                <tr style="background-color: #003366; color: white; padding: 10px;">
                    <th>Organizer</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Venue</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody style="text-align: center; padding: 10px; border-bottom: 1px solid #ddd;">
                <!-- Filled dynamically -->
            </tbody>
        </table>
    </main>
</div>

<!-- Chart Script -->
<script>
const ctx = document.getElementById('eventsChart').getContext('2d');
const eventsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            label: 'Number of Events',
            data: [4, 3, 9, 1, 2, 4, 2],
            backgroundColor: 'blue'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<!-- Tab Switching & User Fetching Script -->
<script>
document.getElementById("dashboardTab").addEventListener("click", function () {
    document.getElementById("dashboardContent").style.display = "block";
    document.getElementById("userManagementContent").style.display = "none";
    document.getElementById("venueContent").style.display = "none";
    this.classList.add("active");
    document.getElementById("venueTab").classList.remove("active");
    document.getElementById("userManagementTab").classList.remove("active");
});

document.getElementById("userManagementTab").addEventListener("click", function () {
    document.getElementById("dashboardContent").style.display = "none";
    document.getElementById("venueContent").style.display = "none";
    document.getElementById("userManagementContent").style.display = "block";
    this.classList.add("active");
    document.getElementById("venueTab").classList.remove("active");
    document.getElementById("dashboardTab").classList.remove("active");

    // Fetch users
    fetch("get_users.php")
        .then(response => response.json())
        .then(users => {
            const tbody = document.querySelector("#userTable tbody");
            tbody.innerHTML = "";
            users.forEach(user => {
                const row = `<tr>
                    <td>${user.clientemail}</td>
                    <td>${user.department}</td>
                    <td>${user.organization}</td>
                    <td>${user.verification_code ? "Verified" : "Unverified"}</td>
                    <td><button onclick="deleteUser('${user.id}')">Delete</button></td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(err => console.error("Error loading users:", err));
});

function deleteUser(id) {
    if (confirm("Delete this user?")) {
        fetch(`delete_user.php?id=${id}`)
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                document.getElementById("userManagementTab").click(); // refresh
            });
    }
}
</script>
<script>
document.getElementById("venueTab").addEventListener("click", function () {
    document.getElementById("dashboardContent").style.display = "none";
    document.getElementById("userManagementContent").style.display = "none";
    document.getElementById("venueContent").style.display = "block";
    this.classList.add("active");
    document.getElementById("dashboardTab").classList.remove("active");
    document.getElementById("userManagementTab").classList.remove("active");

    // Fetch users
    fetch("get_venues.php")
        .then(response => response.json())
        .then(venues => {
            const tbody = document.querySelector("#venueTable tbody");
            tbody.innerHTML = "";
            venues.forEach(user => {
                const row = `<tr>
                    <td>${user.organizer}</td>
                    <td>${user.email}</td>
                    <td>${user.status}</td>
                    <td>${user.venue}</td>
                    <td><button onclick="deleteUser('${user.id}')">Delete</button></td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(err => console.error("Error loading users:", err));
});

function deleteUser(id) {
    if (confirm("Delete this venue?")) {
        fetch(`delete_user.php?id=${id}`)
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                document.getElementById("venueTab").click(); // refresh
            });
    }
}
</script>
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
