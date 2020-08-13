<?php
	
	require_once('../model/dao.php');
	$con = dbConnection();

	if(isset($_POST['user_name'])){
		$userName = $_POST['user_name'];
		$checkuNameSql = "SELECT * FROM students WHERE stuUserName = '$userName'";
		$checkuNameResults = mysqli_query($con,$checkuNameSql);
		if(mysqli_num_rows($checkuNameResults)>0){
			echo 'Username already exists';
		}else{
			echo 'Username is available';
		}
		exit();
	}
	
?>