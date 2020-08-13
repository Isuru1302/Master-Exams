<?php 
	require_once('../model/dao.php');
	$paperID = $_POST["p_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE paper SET paperStatus = '0' WHERE paperID = '$paperID'";
	$conn->query($updateSQL);
	$conn->close();
?>