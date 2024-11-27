<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Prevent SQL injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Query to get the user by username
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();
    
    // Verify the password
    if (password_verify($pass, $row['password'])) {
        // Successful login
        echo "<h1>Welcome, $user!</h1>";
    } else {
        // Invalid password
        echo "<h1>Invalid username or password</h1>";
    }
} else {
    // Invalid username
    echo "<h1>Invalid username or password</h1>";
}

$conn->close();
?>
