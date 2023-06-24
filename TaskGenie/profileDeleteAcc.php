<?php
// Assuming you have established a database connection
include_once("db_connection.php");

// Start or resume the session
session_start();

// Check if the user is logged in and the user ID is set in the session
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id']; 

    // Begin a database transaction
    mysqli_autocommit($conn, false); // Turn off autocommit

    try {
        // Delete data from the "task" table that references the user ID
        $deleteTasksQuery = "DELETE FROM task WHERE userid = ?";
        $deleteTasksStmt = $conn->prepare($deleteTasksQuery);
        $deleteTasksStmt->bind_param('i', $userID);
        $deleteTasksStmt->execute();

        // Delete the user from the "user" table
        $deleteUserQuery = "DELETE FROM user WHERE userid = ?";
        $deleteUserStmt = $conn->prepare($deleteUserQuery);
        $deleteUserStmt->bind_param('i', $userID);
        $deleteUserStmt->execute();

        // Check if the deletion was successful
        $deletionSuccessful = ($deleteTasksStmt->affected_rows > 0) && ($deleteUserStmt->affected_rows > 0);

        if ($deletionSuccessful) {
            // Commit the transaction if all queries are executed successfully
            mysqli_commit($conn);

            // Destroy the session and redirect the user to a logged-out page
            
            header("Location: landingPage.html");
            exit();
        } else {
            echo "Deletion failed.";
        }
    } catch (Exception $e) {
        // Rollback the transaction on any error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }

    // Re-enable autocommit
    mysqli_autocommit($conn, true);
} else {
    echo "User is not logged in.";
}

// Close the database connection
$conn->close();
?>
