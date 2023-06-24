<?php
// Include the database connection file
include_once("db_connection.php");

// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

// Check if the email already exists in the members table
$checkQuery = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, registration failed
    echo "<script>alert('Email already exists. Please sign up again or login.');</script>";
    echo "<script>window.location.href='login.php';</script>";

} else {
    // Email is new, registration successful

    // Insert a new record into the members table
    $insertQuery = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        // Registration is successful
        echo "<script>alert('Registration successful. Please login.');</script>";
        echo "<script>window.location.href='login.php';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Registration failed. Please try again.');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}

// Free resources and close the database connection
$stmt->close();
$conn->close();
?>