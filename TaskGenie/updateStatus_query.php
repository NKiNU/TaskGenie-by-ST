<?php
    	require_once 'db_conn.php';
     
		if(ISSET($_POST['updateStatus'])){
			$status=$_POST['names'];
			$task_id = $_POST['task_id'];

	
			$conn->query("UPDATE task SET status ='$status'  WHERE taskid = '$task_id' AND userid='".$_SESSION['user_id']."'");
    		header('location: task.php');
    	}
    ?>