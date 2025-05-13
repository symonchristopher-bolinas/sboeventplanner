<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Event Sync - Sign Up</title>
  <style>
    /* Basic page structure and styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
    }
    .left-panel {
        background: linear-gradient(to right, #0b0b3b, #3a3a52);
        color: white;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
    }
    .left-panel img {
        width: 200px;
        margin-bottom: 2rem;
    }
    .left-panel h1 {
      font-weight: bold;
    }
    .left-panel h1 span {
      color: #1e4dd8;
    }
    .signup-form-container {
        background: #ffffff;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
    }
    .form-box {
      width: 100%;
      max-width: 400px;
    }
    .form-box h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
    }
    form input, form select {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
    }
    .terms {
      margin-top: 10px;
      font-size: 14px;
    }
    .terms input {
      margin-right: 5px;
    }
    .terms a {
      color: #1e4dd8;
      text-decoration: none;
    }
    .signup-button {
      width: 100%;
      background-color: #004080;
      color: white;
      padding: 12px;
      font-size: 18px;
      border: none;
      border-radius: 12px;
      margin-top: 20px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .signup-button:hover {
      background-color: #003366;
    }
    .close-button {
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 30px;
      text-decoration: none;
      color: black;
    }
  </style>
</head>
<body>

<div class="left-panel">
  <img src="../images/logo.png" alt="University Logo">
  <h1>EVENT <span>SYNC</span></h1>
</div>

<div class="signup-form-container">
  <a href="login.php" class="close-button">&times;</a>
  <div class="form-box">
    <h2>Add Venue</h2>
    <?php if (isset($_GET['error'])): ?>
  <p class="error" style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
  <script>
    alert("Venue added successfully!");
  </script>
<?php endif; ?>

    <form method="POST" action="process_venue.php">
      <input type="organization" name="organization" placeholder="Organizer" required>
      <input type="email" name="email" placeholder="Email" required>
      <select name="status" required>
          <option value="">Status</option>
          <option value="active">Active</option>
          <option value="offline">Offline</option>
      </select>
      <input type="venue" name="venue" placeholder="Venue" required>



      <button type="submit" class="signup-button">ADD VENUE</button>
    </form>
  </div>
</div>
<?php if (isset($_GET['success'])): ?>
  <script>
    alert("Venue added successfully!");
    window.location.href = "admin_dashboard.php"; // Redirect after alert
  </script>
<?php endif; ?>


</body>
</html>
