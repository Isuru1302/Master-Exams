<?php
	
	require_once('../model/dao.php');
	$con = dbConnection();

	if(isset($_POST['user_email'])){
		$userEmail = $_POST['user_email'];
		$userEmailSql = "SELECT * FROM students WHERE stuEmail = '$userEmail'";
		$userEmailResults = mysqli_query($con,$userEmailSql);
		if(mysqli_num_rows($userEmailResults)>0){
			echo 'Email already exists';
		}else{
			echo 'Email is available';
		}
		exit();
	}
	
?>