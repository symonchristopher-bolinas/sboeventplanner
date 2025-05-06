<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventplanner";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$enteredOtp = $_POST['otp'] ?? '';

if (empty($email) || empty($enteredOtp)) {
    echo "<script>alert('Missing data.'); window.location.href='signup.php';</script>";
    exit();
}

// Check OTP from database
$sql = "SELECT verification_code FROM client_account WHERE clientemail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($dbOtp);
$stmt->fetch();
$stmt->close();

if ($enteredOtp === $dbOtp) {
    // OTP is correct, but do not clear the verification code
    echo "<script>alert('OTP verified successfully!'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Incorrect OTP.'); window.location.href='signup.php';</script>";
}
exit();
