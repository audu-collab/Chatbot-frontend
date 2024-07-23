<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ...

$email = $_POST['email'];
$inputPassword = $_POST['password'];

// Retrieve the hashed password associated with the provided email from the database
$sql = "SELECT password FROM sign_up WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Verify if the input password matches the stored hashed password
    if (password_verify($inputPassword, $hashedPassword)) {
        // Login successful
        echo "Login successful...";
        header("Location: index.html");
        echo "<script>alert('Welcome to the health connection')</script>";
        echo "<script>window.open('index.html')</script>";
    } else {
        // Login failed (password doesn't match)
        $message = "Invalid email or password";
        header("Location: login.html?message=" . urlencode($message));
    }
} else {
    // Login failed (email not found)
    $message = "Invalid email or password";
    header("Location: login.html?message=" . urlencode($message));
}

?>