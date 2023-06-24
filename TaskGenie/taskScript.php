<?php 
	   require "functions.php";
	 
	   if(isset($_POST['category'])){
	      $category = $_POST['category']; //will store selected item ,low medium, high
	 
	      if($category === ""){
	         $products = getAllProducts();
	      }else{
	         $products = getProductsByCategory($category);
	      }
	      echo json_encode($products);
	   }