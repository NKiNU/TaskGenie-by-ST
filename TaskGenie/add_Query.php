<?php
    // Include the file that establishes the database connection
    require_once 'db_conn.php';

    // Check if the form with the name 'add' has been submitted
    if (isset($_POST['add'])) {

        // Check if the 'task' field is not empty
        if ($_POST['task'] != "") {

            // Retrieve the value of the 'task' field from the form
            $task = $_POST['task'];
            $priority = $_POST['priority'];
            $deadline = date('Y-m-d', strtotime($_POST['deadline']));

            // Set default values for priority, status, and task completion
            $status = "to-do";
            $userID = $_SESSION['user_id'] ;

            // Insert the task into the 'task' table in the database
            $conn->query("INSERT INTO `task` VALUES('', '$task', '$priority','$deadline','$status','$userID')");

            // Redirect the user to the 'task2.php' page
            header('location:task.php');
        }
        else{
            echo "failed";
        }
    }
?>
