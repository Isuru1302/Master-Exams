<?php 
	require_once('../model/dao.php');
	$ID = $_POST["img_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE mainBanner SET imageStatus = '1' WHERE id = '$ID'";
	$conn->query($updateSQL);
	$conn->close();
?>