<?php 
	require_once('../model/dao.php');
	$paperID = $_POST["p_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE paper SET paperStatus = '1' WHERE paperID = '$paperID'";
	$conn->query($updateSQL);
	$conn->close();
?>