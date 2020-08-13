<?php
	require_once('../model/dao.php');
	require_once('Bcrypt.php');

	$conn = dbConnection();


	$stuID = $_POST["stuID"];
	$newPW = $_POST["newPw"];
	$hasedPW = Bcrypt::hashPassword($newPW, PASSWORD_DEFAULT);

	$upSQL = "UPDATE students SET stuPassword = '$hasedPW' WHERE stuID = '$stuID'"; 


	if($conn->query($upSQL)){
		echo "success";
	}else{
		echo "error";
	}
	$conn->close();

?>