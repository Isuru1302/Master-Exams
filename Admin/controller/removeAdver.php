<?php 
	require_once('../model/dao.php');
	$ID = $_POST["img_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE adver SET adStatus = '0' WHERE adID = '$ID'";
	$conn->query($updateSQL);
	$conn->close();
?>