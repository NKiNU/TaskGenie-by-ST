<?php
    	require_once 'db_conn.php';
     
		if(ISSET($_POST['updateTask'])){
			$task_desc = $_POST['taskDesc'];
			$deadline = $_POST['deadline'];
			$task_id = $_POST['task_id'];

	
			$conn->query("UPDATE task SET taskname='$task_desc' , dateline = '$deadline' WHERE taskid ='$task_id' AND userid='".$_SESSION['user_id']."'");
    		header('location: task.php');
    	}
    ?>