<?php

// Database configuration
$servername = 'localhost';
$username = 'root';
$password = "";
$dbname = 'new';


// Connect to the database
$conn = mysqli_connect($servername, $username,$password,$dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define the user details
$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$mobile = $_POST['mobile'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO sign_up(firstname,lastname,email,password,mobile) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword','$mobile')";

    if (mysqli_query($conn, $sql)) {
        echo "New user created successfully";
        header("Location:login.html");
        echo"<script>alert('Welcome to health connection')</script>";
        echo"<script>window.open('login.html')</script>";
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   
    if (mysqli_affected_rows($conn) > 0) {
        echo "Data inserted successfully";
    } else {
        echo "Data not inserted";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die("Connection failed: " . mysqli_connect_error());
    }
// Close the database connection
mysqli_close($conn);
?>