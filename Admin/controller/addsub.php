<?php 
	require_once('../model/dao.php');
	$subID = $_POST["sub_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE subcategory SET subSubStatus = '1' WHERE subSubID = '$subID'";
	$conn->query($updateSQL);
	$conn->close();
?>