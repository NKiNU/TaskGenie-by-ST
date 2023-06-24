<?php
    	require_once 'db_conn.php';
     
// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($conn, "DELETE FROM task WHERE taskid='$id'");
	header('location: task.php');
}

?>