<?php
// Include the database connection file
include_once("db_connection.php");

// Start a new session
session_start();

// Retrieve form data
$email = $_POST["loginEmail"];
$password = $_POST["loginPassword"];

// Validate the login
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Email exists, check password
    $row = $result->fetch_assoc();
    $storedPassword = $row["password"];

    // Verify the password
    if ($password === $storedPassword) {
        // Password is correct, login successful

        // Register session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row['userid'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_username'] = $row['name'];
        


        // Set success message in session variable
        $_SESSION['login_message'] = 'Login successful!';

        // Redirect to dashboard.php with login_success status
        header("Location: dashboard.php");
        exit();
    } else {
        // Password is incorrect

        // Set error message in session variable
        $_SESSION['login_message'] = 'Incorrect password. Please try again.';

        // Redirect to login.php with login_failed status
        header("Location: login.php?action=login_failed");
        exit();
    }
} else {
    // Email does not exist

    // Set error message in session variable
    $_SESSION['login_message'] = 'Email does not exist. Please sign up for an account.';

    // Redirect to login.php with email_not_exist status
    header("Location: login.php?action=email_not_exist");
    exit();
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
