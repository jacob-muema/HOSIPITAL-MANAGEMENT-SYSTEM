<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "hmisphp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM Users WHERE Username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        // Set session variables upon successful login
        $_SESSION['user'] = $username;
        echo "Login successful";
        // Redirect to the main page of the bookstore
        header("Location:backend/doc/index.html ");
    } 
    else {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: register.html");
    }
} else {
    $_SESSION['error'] = "Invalid username or password";
    header("Location: register.html");
}

$conn->close();
?>