<?php
// Database connection
$servername = "localhost";
$username = "root"; // Adjust if needed
$password = ""; // Adjust if needed
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];
$confirmPass = $_POST['confirm-password'];

// Prevent SQL injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Check if passwords match
if ($pass !== $confirmPass) {
    die("Passwords do not match.");
}

// Hash the password for security
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

// Check if username already exists
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Username already taken, please choose a different one.</h1>";
} else {
    // Insert the new user
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashedPass')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Registration successful! <a href='login.html'>Login</a></h1>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>