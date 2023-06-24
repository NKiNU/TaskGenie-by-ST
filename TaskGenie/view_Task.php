<?php
    // Include the file that establishes the database connection
    require_once 'db_conn.php';

    function connect(){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db =  "taskgenie";
        $mysqli = new mysqli($hostname,$username,$password,$db);
        if($mysqli->connect_errno != 0){
            return $mysqli->connect_error;
         }else{
            $mysqli->set_charset("utf8mb4");	
         }
         return $mysqli;
    }

	function getAllProducts(){
        $mysqli = connect();
        $res = $mysqli->query("SELECT * FROM task WHERE userid='".$_SESSION['user_id']."' ORDER BY dateline DESC");
        while($row = $res->fetch_assoc()){
           $products[] = $row;
        }
        return $products;
     }


     function getProductsByCategory($category){
        $mysqli = connect();
        $res = $mysqli->query("SELECT * FROM task WHERE priority = '$category' and userid='".$_SESSION['user_id']."'");
        while($row = $res->fetch_assoc()){
           $products[] = $row;
        }
        return $products;
     }
?>
